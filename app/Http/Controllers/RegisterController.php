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

    public function register(Request $request) // traitement du formulaire inscription
    {
      dd( $request->all());
    } 


}
