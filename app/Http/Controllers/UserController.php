<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function profile(User $user)
    {
        return 'Je suis un utilisateur et mon nom est '.$user->name;
        
    }
}
