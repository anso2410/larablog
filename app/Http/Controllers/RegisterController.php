<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index() //formulaire d'inscription
    {
        $data = [
            'title'=>'Inscription - '.config('app.name'),
            'description'=>'Inscription sur le site '.config('app.name'),
        ];

        return view('auth.register', $data );
    }
}
