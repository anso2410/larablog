<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LogoutController extends Controller
{
    public function logout() //deconnexion 
    {
        Auth::logout();
        return redirect()->route('login');

    }

}
