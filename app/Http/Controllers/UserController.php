<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Mcq;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
            return redirect($url);
        }

        // Default → dashboard/home
        return redirect()->route('home');
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

        // Redirect to login page (NO AUTO LOGIN)
        return redirect()->route('loginPage')
            ->with('success', 'Registration successful! Please login.')
            ->with('email', $request->email);
    }

    function userLogout() {
        Session::forget('user');
        return redirect()->route('home');
    }
}