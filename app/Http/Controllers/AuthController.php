<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {   
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $loginType = filter_var($request->email, FILTER_VALIDATE_EMAIL )
            ? 'email'
            : 'username';

        $account = User::where($loginType, $request->email)->first();

        if(!$account) {
            return back()->withErrors([
                'error' => 'Data akun tidak ditemukan',
            ])->withInput();
        }

        if(Auth::attempt([$loginType => $request->email, 'password' => $request->password])){ 
            return redirect()->route('dashboard');
        } 

        return back()->withErrors([
            'error' => 'Email atau password salah',
        ])->withInput();
    }

    public function logout()
    {
       Auth::logout();
       return redirect()->route('login.index');
    }
}
