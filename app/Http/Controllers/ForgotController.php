<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForgotController extends Controller
{
   
    public function index () //formulaire d'oublie de mot de passe 
 {
     $data = [
        'title' => $description = 'Oublie mot de passe -'.config('app.name'),
        'description' => $description,
     ];

     return view('auth.forgot', $data);

 }
 
 
    public function store() //verification des data et envoie de lien par mail 
    {

    }

}
