<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ResetController extends Controller
{
    public function index(string $token) //formulaire de réinitialisation de mdp
    {
        $password_reset = DB::table('password_resets')->where('token', $token)->first();
        dd($password_reset);
    } 
}
