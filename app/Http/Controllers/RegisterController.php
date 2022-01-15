<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //formulaire d'inscription

    public function index()
    {
        $data = [
            'title' => 'Inscription - ' . config('app.name'),
            'description' => 'Inscription sur le site ' . config('app.name'),
        ];

        return view('auth.register', $data);
    }

    public function register() // traitement du formulaire inscription
    {
      request()->validate([
            'name'=>'required|min:3|max:20|unique:users',
            'email'=>'required|email|unique:users',
            'password'=>'required|between:9,20',
      ]);
    } 


}
