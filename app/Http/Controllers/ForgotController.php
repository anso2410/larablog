<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\PasswordResetNotification;
use App\Models\User;
use  Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ForgotController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index() //formulaire d'oublie de mot de passe 
    {
        $data = [
            'title' => $description = 'Oublie mot de passe -' . config('app.name'),
            'description' => $description,
        ];

        return view('auth.forgot', $data);
    }


    public function store() //verification des data et envoie de lien par mail 
    {
        request()->validate([
            'email'=>'required|email|exists:users',
        ]);

        $token = Str::uuid();

         DB::table('password_resets')->insert([
        'email'=>request('email'),
        'token'=>$token,
         'created_at'=>now(),
         ]);

        //envoi de notification avec un lien sécurisé
         // $user correspond à l'email
        $user = User::whereEmail(request('email'))->firstOrFail();

        $user->notify(new PasswordResetNotification($token));

        $success = 'vérifier votre boite mail et suivez les instructions.';
        return back()->withSuccess($success);
    }
}
