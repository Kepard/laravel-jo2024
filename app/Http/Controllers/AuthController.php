<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    
    public function login()
    {   
        return view('auth.login');
    }
    
    public function doLogin (LoginRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials))
            {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.competition.index'))->with('success', 'Vous etes maintenant connecte');
            };


        return back()->withErrors([
            'email' => 'Identifiants incorrects'
        ])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();
        return to_route('login')->with('success', 'Vous etes maintenant deconnecte');
    }
}
