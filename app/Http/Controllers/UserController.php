<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

use App\Models\User;;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('profile');
    }

    public function profile(User $user)
    {
        return 'Je suis un utilisateur et mon nom est ' . $user->name;
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
       $user = $user->updateOrCreate(['id'=>$user->id],
        request()->validate([
            'name' => ['required', 'min:3', 'max:20', Rule::unique('users')->ignore($user)],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user)],
            'avatar' => ['sometimes', 'nullable', 'image', 'file', 'mimes:jpeg,png', 'dimensions:min_width=200,min_height=200'],
        ]));
        

        if (request()->hasFile('avatar') && request()->file('avatar')->isValid()) {
            $ext = request()->file('avatar')->extension();
            $filename = Str::slug($user->name) . '-' . $user->id . '.' . $ext;

            $path = request()->file('avatar')->storeAs('avatars/' . $user->id, $filename);

            $thumbnailImage = Image::make(request()->file('avatar'))->fit(200, 200, function ($constraint) {

                $constraint->upsize();
            })->encode($ext, 50);

            $thumbnailPath = 'avatars/' . $user->id . '/thumbnail/' . $filename;

            Storage::put($thumbnailPath, $thumbnailImage);
        }
    }
}
