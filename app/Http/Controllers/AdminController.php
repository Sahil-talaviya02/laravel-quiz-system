<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Categorie;
use App\Models\Quizze;
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
        $categories = Categorie::get();
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
        $category = new Categorie();
        $category->name = $request->category;
        $category->creator = $admin->name;

        if ($category->save()) {
            Session::flash('categories',"$request->category category Added");
        }

        return redirect()->route('adminCategory');
    }

    function deleteCategories($id) {
        $isDelete = Categorie::find($id)->delete();

        if ($isDelete) {
            Session::flash('categories',"Success: category Deleted");
        } else {
            Session::flash('categories',"Error: category not Deleted");
        }

        return redirect()->route('adminCategory');
    }

    function addQuiz() {
        $categories = Categorie::get();
        $admin = Session::get('admin');
        if ($admin) {
            $quizName = request('quiz');
            $qcategoryId = request('category_id');

            if ($quizName && $qcategoryId && !Session::has('quizDetails')) {
                $quiz = new Quizze();
                $quiz->name = $quizName;
                $quiz->category_id = $qcategoryId;

                if ($quiz->save()) {
                    Session::put('quizDetails',$quiz);
                }
            }
            return view('add-quiz', ['name' => $admin->name,'categories' => $categories]);
        } else {
            return redirect()->route('adminLogin');
        }
    }
}