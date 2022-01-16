<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() // formulaire de connexion 
    {
        $data = [
            'title' => 'Login -'.config('app.name'),
            'description' => 'Connexion à votre comptre -'.config('app.name'),
        ];

        return view('auth.login', $data);
    }

    public function login() // traitement du login 
    {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    }
}
