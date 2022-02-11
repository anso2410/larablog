<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;;

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

    }
}
