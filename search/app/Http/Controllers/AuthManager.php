<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthManager extends Controller
{

    function register(){
        if (Auth::check()){
            return redirect(route('home'));
        }
        return view('auth.register');
    }
    function registerPost(Request $request){
        $request->validate([
           'name'=>'required',
           'email'=>'required|email|unique:users',
           'password'=>'required'
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['role_id'] = 2;

        $user = User::create($data);
        if (!$user){
            return redirect(route('register'))->with('error','Registration failed, try again!');
        }
        return redirect(route('login'))->with('success','Registration success, Login to access the app');
    }



    function login(){
        if (Auth::check()){
            return redirect(route('home'));
        }
        return view('auth.login');
    }

    function loginPost(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);


        $credentials = $request->only('email','password');
        if (Auth::attempt($credentials)){
            $user = Auth::user();
            if ($request->has('remember_token') && $request->input('remember_token') == 1) {
                if(!$user->remember_token || $user->remember_token !== 1) {
                    $user->remember_token = Str::random(60);
                    $user->save();
                }
            } else {
                $user->remember_token = null; // Or any default value you want
                $user->save();
            }
            return redirect()->intended(route('home'));
        }
        return redirect(route('login'))->with('error','Login details are not valid!');

    }


    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
