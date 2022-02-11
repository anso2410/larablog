<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResetController extends Controller
{
    public function index(string $token) //formulaire de réinitialisation de mdp
    {
        $password_reset = DB::table('password_resets')->where('token', $token)->first();

        abort_if(!$password_reset, 403);
        
        $data = [
            'title' => $description = 'réinitialisation de mot de passe - '.config('app.name'),
            'description' => $description,
            'password_reset' => $password_reset,
        ];
        return view('auth.reset', $data);
    }

    public function reset() //traitement de reinitialisation du mot de passe
    {
       request()->validate([
            'email'=>'required|email',
            'token'=>'required',
            'password'=>'required|between:9,20|confirmed',

       ]);

        //vérification des entrées dans la table password reset
       if(!DB::table('password_resets')
       ->where('email', request('email'))
       ->where('token', request('token'))->count()
       ){
           $error = 'Aucun email ne correspond, vérifiez votre adresse email.';
           return back()->withError($error)->withInput();
           
       }

    }
}
