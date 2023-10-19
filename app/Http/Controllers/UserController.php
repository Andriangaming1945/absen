<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    protected function userLogout($with_message = null){
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        if($with_message){
            return redirect('/')->with('error', $with_message);
        }

        return redirect('/');
    }

    public function login(){
        return view('user.login', [
            'title' => 'Login'
        ]);
    }
    public function loginRequest(Request $request){
        $validate = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($validate)){
            $request->session()->regenerate();

            if(Auth::user()->hasRole("Guru Full Time") || Auth::user()->hasRole("Guru Part Time")){
                return redirect()->intended('/tasks');
            } else if(Auth::user()->hasRole("TPA Full Time") || Auth::user()->hasRole("TPA Part Time")){
                return redirect()->intended('/permits');
            } else if(Auth::user()->hasRole('Super Admin')){
                return redirect()->intended('/user-managements');
            } else if(Auth::user()->hasRole('Admin')){
                return redirect()->intended('/presences');
            } else if(Auth::user()->hasRole('Wakasek')){
                return redirect()->intended('/permits');
            } else {
                return $this->userLogout("There is something in your account, contact Super Admin");
            }
        }

        return back()->with('error', 'Incorrect username or password');
    }

    public function logout(Request $request){
        return $this->userLogout();
    }

    public function setting(){
        return view('user.setting', [
            'title' => 'Setting'
        ]);
    }

    public function changePassword(){
        return view('user.change-password', [
            'title' => 'Setting'
        ]);
    }
}
