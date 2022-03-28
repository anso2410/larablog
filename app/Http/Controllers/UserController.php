<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

use App\Models\User;

use Storage, Image;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('profile');
    }
    
    public function profile(User $user)
    {
        return 'Je suis un utilisateur et mon nom est '.$user->name;
    }

    public function edit()
    {
        $user = auth()->user();
        $data = [
            'title' => $description = 'Editer mon profil',
            'description' => $description,
            'user' => $user,
        ];
        return view('user.edit', $data);
    }

    public function store()
    {   
        $user = auth()->user();
        request()->validate([
            'name' => ['required', 'min:3', 'max:20', Rule::unique('users')->ignore($user)],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user)],
            'avatar' => ['sometimes', 'nullable', 'image', 'file', 'mimes:jpeg,png'],
        ]);

        if(request()->hasFile('avatar') && request()->file('avatar')->isValid())
        {   
            $ext = request()->file('avatar')->extension();
            $filename = Str::slug($user->name).'.'.$ext;
            dd($filename);
            $path = request()->file('avatar')->store('avatars/'.$user->id);
            dd($path);
        }
    }
}
