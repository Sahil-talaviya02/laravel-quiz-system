<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Mcq;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

    public function login(Request $request) {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $user = Admin::where([
            ['name',"=", $request->name],
            ['password',"=", $request->password]
            ])->first();

        if (!$user) {
            return back()->withErrors([
                'name' => 'User not found',
                'password' => 'password not found',
            ])->withInput();
        }

        Session::put('admin', $user);
        return redirect()->route('dashboard');
    }

    function dashboard() {
        $admin = Session::get('admin');
        if ($admin) {
            return view('admin', ['name' => $admin->name]);
        } else {
            return redirect()->route('adminLogin');
        }
    }

    function categories() {
        $categories = Category::get();
        $admin = Session::get('admin');
        if ($admin) {
            return view('categories', ['name' => $admin->name,'categories' => $categories]);
        } else {
            return redirect()->route('adminLogin');
        }
    }

    function logout() {
        Session::forget('admin');
        return redirect()->route('adminLogin');
    }

    function addCategories(Request $request) {

        $request->validate([
            'category' => 'required | min:2 | unique:categories,name'
        ]);

        $admin = Session::get('admin');
        $category = new Category();
        $category->name = $request->category;
        $category->creator = $admin->name;

        if ($category->save()) {
            Session::flash('categories',"$request->category category Added");
        }

        return redirect()->route('adminCategory');
    }

    function deleteCategories($id) {
        $isDelete = Category::find($id)->delete();

        if ($isDelete) {
            Session::flash('categories',"Success: category Deleted");
        } else {
            Session::flash('categories',"Error: category not Deleted");
        }

        return redirect()->route('adminCategory');
    }

    function addQuiz() {
        $categories = Category::get();
        $admin = Session::get('admin');
        $totalMcq = 0;


        if ($admin) {
            $quizName = request('quiz');
            $qcategoryId = request('category_id');

            if ($quizName && $qcategoryId && !Session::has('quizDetails')) {
                $quiz = new Quiz();
                $quiz->name = $quizName;
                $quiz->category_id = $qcategoryId;

                if ($quiz->save()) {
                    Session::put('quizDetails',$quiz);
                }
            } else {
                $quizs = Session::get('quizDetails');
                $totalMcq = $quizs && Mcq::where('quiz_id', $quizs->id)->count();
            }
            return view('add-quiz', ['name' => $admin->name,'categories' => $categories, "totalMcq" => $totalMcq]);
        } else {
            return redirect()->route('adminLogin');
        }
    }

    function addMcqs(Request $request) {
        if ($request->submit == "close") {
            Session::forget('quizDetails');
            return redirect()->route('addQuiz');
        } else {
            $request->validate([
                'addQuestion' => 'required | min:5 | max:300',
                'optionA' => 'required | max:300',
                'optionB' => 'required | max:300',
                'optionC' => 'required | max:300',
                'optionD' => 'required | max:300',
                'correct_ans' => 'required',
            ]);

            $mcq = new Mcq();
            $admin = Session::get('admin');
            $quiz = Session::get('quizDetails');

            $mcq->question = $request->addQuestion;
            $mcq->a = $request->optionA;
            $mcq->b = $request->optionB;
            $mcq->c = $request->optionC;
            $mcq->d = $request->optionD;
            $mcq->correct_ans = $request->correct_ans;
            if (!$admin || !$quiz) {
                    return redirect()->route('dashboard')->with('error', 'Session expired');
            }

            $mcq->admin_id = $admin->id;
            $mcq->quiz_id = $quiz->id;
            $mcq->category_id = $quiz->category_id;

            if ($mcq->save()) {
                if ($request->submit == "addMore") {
                    return redirect()->to(url()->previous());
                } else {
                    Session::forget('quizDetails');
                    return redirect()->route('dashboard');
                }
            }
        }
    }

    function showQuiz($id, $quizName) {
        $admin = Session::get('admin');
        $mcqs = Mcq::where('quiz_id', $id)->get();
        if ($admin) {
            return view('show-quiz', ['name' => $admin->name,'mcqs' => $mcqs, 'quizName' => $quizName]);
        } else {
            return redirect()->route('adminLogin');
        }
    }

    function quizList($id, $category) {
        $admin = Session::get('admin');

        if ($admin) {
            $quizData = Quiz::where('category_id', $id)->get();
            return view('quiz-list', ['name' => $admin->name,'quizData' => $quizData, 'category' => $category]);
        } else {
            return redirect()->route('adminLogin');
        }
    }
}