<?php

namespace App\Http\Controllers;

use App\Mail\UserForgetPassword;
use App\Mail\VerifyUser;
use App\Models\Category;
use App\Models\Mcq;
use App\Models\MCQ_Record;
use App\Models\Quiz;
use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    function welcome() {
        $categories = Category::withCount('quizzes')->get();
        return view("welcome", compact('categories'));
    }

    function userQuizList($id, $category) {
        $quizData = Quiz::withCount('mcq')->where('category_id', $id)->get();
        return view('user-quiz-list', compact('quizData', 'category'));
    }

    function startQuiz($id, $name) {
        $quizCount = Mcq::where('quiz_id',$id)->count();
        $mcq = Mcq::where('quiz_id',$id)->get();
        Session::put('firstMcq', $mcq[0]);
        return view('start-quiz', [
            'quizCount'=>$quizCount,
            'quizName'=>$name,
            'quizId'=>$id
        ]);
    }

    // Show login page
    function userLoginQuiz() {
        // Only store previous URL if it's NOT login/signup page
        $previous = url()->previous();

        if (!str_contains($previous, 'login') && !str_contains($previous, 'signup')) {
            Session::put('quiz-url', $previous);
        }

        return view('user-login');
    }

    // Login
    function userLogin(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Invalid email or password']);
        }

        Session::put('user', $user);

        // Redirect logic
        if (Session::has('quiz-url')) {
            $url = Session::get('quiz-url');
            Session::forget('quiz-url');
            return redirect($url)->with('success', 'Login successful!');
        }

        // Default → dashboard/home
        return redirect()->route('home')->with('success', 'Login successful!');
    }

    // Signup
    function userSignUp(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $link = Crypt::encryptString($request->email);
        $link = url('/verify-user/'.$link);

        Mail::to($request->email)->send(new VerifyUser($link));

        // Redirect to login page (NO AUTO LOGIN)
        return redirect()->route('loginPage')
            ->with('success', 'Registration successful! Please login and check email to verify account')
            ->with('email', $request->email);
    }

    //user-logOut
    function userLogout() {
        Session::forget('user');
        return redirect()->route('home');
    }

    function mcq($id, $name) {
        $record = new Record();
        $record->user_id = Session::get('user')->id;
        $record->quiz_id = Session::get('firstMcq')->quiz_id;
        $record->status = 1;

        if ($record->save()) {

            $currentQuiz = [
                'totalMcq' => Mcq::where('quiz_id', Session::get('firstMcq')->quiz_id)->count(),
                'currentMcq' => 1,
                'quizName' => $name,
                'quizId' => Session::get('firstMcq')->quiz_id,
                'recordId' => $record->id
            ];

            Session::put('currentQuiz', $currentQuiz);

            $mcqData = Mcq::find($id);
            $selected = null;
            $quizName = $name;

            return view('mcq-page', compact('mcqData', 'quizName', 'selected'));
        }
        return "Something went wrong";
    }

    function submitNext(Request $request, $id) {
        $currentQuiz = Session::get('currentQuiz');

        // Save OR Update answer
        $mcq_records = MCQ_Record::where([
            ['record_id', '=', $currentQuiz['recordId']],
            ['mcq_id', '=', $request->id],
        ])->first();

        if (!$mcq_records) {
            $mcq_records = new MCQ_Record();
            $mcq_records->record_id = $currentQuiz['recordId'];
            $mcq_records->user_id = Session::get('user')->id;
            $mcq_records->mcq_id = $request->id;
        }

        $mcq_records->select_answer = $request->answer;
        $mcq_records->is_correct = ($request->answer == Mcq::find($request->id)->correct_ans) ? 1 : 0;
        $mcq_records->save();

        // 👉 NEXT BUTTON LOGIC
        $nextMcq = Mcq::where([
            ['id', '>', $id],
            ['quiz_id', '=', $currentQuiz['quizId']],
        ])->first();

        if ($nextMcq) {
            $currentQuiz['currentMcq']++;
            Session::put('currentQuiz', $currentQuiz);

            $selected = MCQ_Record::where([
                ['record_id', $currentQuiz['recordId']],
                ['mcq_id', $nextMcq->id]
            ])->value('select_answer');

            return view('mcq-page', [
                'quizName' => $currentQuiz['quizName'],
                'mcqData' => $nextMcq,
                'selected' => $selected
            ]);
        }

        // RESULT PAGE
        $resultData = MCQ_Record::withMCQ()
            ->where('record_id', $currentQuiz['recordId'])
            ->get();

        $record = Record::find($currentQuiz['recordId']);
        if ($record) {
            $record->status = 2;
            $record->update();
        }
        return view('quiz_result', compact('resultData'));
    }

    function tabChange(Request $request) {
        $currentQuiz = Session::get('currentQuiz');

        if (!$currentQuiz) {
            return response()->json(['status' => 'no-session']);
        }

        $recordId = $currentQuiz['recordId'];
        $mcqs = Mcq::where('quiz_id', $currentQuiz['quizId'])->get();

        foreach ($mcqs as $mcq) {
            $exists = MCQ_Record::where([
                ['record_id', $recordId],
                ['mcq_id', $mcq->id]
            ])->first();

            if (!$exists) {
                MCQ_Record::create([
                    'record_id' => $recordId,
                    'user_id' => Session::get('user')->id,
                    'mcq_id' => $mcq->id,
                    'select_answer' => null,
                    'is_correct' => 0
                ]);
            }
        }
        return response()->json(['status' => 'done']);
    }

    function forceResult() {
        $currentQuiz = Session::get('currentQuiz');

        if (!$currentQuiz) {
            return redirect()->route('home');
        }

        $resultData = MCQ_Record::withMCQ()
            ->where('record_id', $currentQuiz['recordId'])
            ->get();

        // 🧹 clear quiz session
        Session::forget('currentQuiz');

        return view('quiz_result', compact('resultData'));
    }

    //user attempts quiz details
    function userDetails() {
        $quizRecord = Record::WithQuiz()->where('user_id', Session::get('user')->id)->get();
        return view('user-details',['quizRecord' => $quizRecord]);
    }

    //verify email
    function verifyUser($email) {
        $orgEmail = Crypt::decryptString($email);
        $user = User::where('email', $orgEmail)->first();

        if ($user) {
            $user->active = 2;
            
            if ($user->save()) {
                return redirect()->route('home');
            }
        }
    }

    function userforgetPassword(Request $request) {
        $request->validate([
            'email' => 'required|email',
        ]);
        
        $link = Crypt::encryptString($request->email);
        $link = url('/userResetForgetPassword/'.$link);

        Mail::to($request->email)->send(new UserForgetPassword($link));
        return redirect()->route('home');
    }

    function userResetForgetPassword($email) {
        $orgEmail = Crypt::decryptString($email);
        return view('user-set-forget-password',['email' => $orgEmail]);
    }

    function userSetForgetPassword(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6'
        ]);

        $user= User::where('email', $request->email)->first();
        if ($user) {
            $user->password = Hash::make($request->password);
            if ($user->save()) {
                return redirect()->route('loginPage');
            }
        }
        return $request;
    }
 
}    