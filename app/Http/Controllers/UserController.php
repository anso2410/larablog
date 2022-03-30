<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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

    public function store() //sauvegarde des infos user
    {
        $user = auth()->user();

        DB::beginTransaction();

        try 
        {
            $user = $user->updateOrCreate(
                ['id' => $user->id],
                request()->validate([
                    'name' => ['required', 'min:3', 'max:20', Rule::unique('users')->ignore($user)],
                    'email' => ['required', 'email', Rule::unique('users')->ignore($user)],
                    'avatar' => ['sometimes', 'nullable', 'image', 'file', 'mimes:jpeg,png', 'dimensions:min_width=200,min_height=200'],
                ])
            );
            if (request()->hasFile('avatar') && request()->file('avatar')->isValid()) {
                if(Storage::exists('avatars/'.$user->id))
                {
                    Storage::deleteDirectory('avatars/'.$user->id);
                }
                
                $ext = request()->file('avatar')->extension();
                $filename = Str::slug($user->name) . '-' . $user->id . '.' . $ext;
                $path = request()->file('avatar')->storeAs('avatars/' . $user->id, $filename);
                $thumbnailImage = Image::make(request()->file('avatar'))->fit(200, 200, function ($constraint) {
                    $constraint->upsize();
                })->encode($ext, 50);
                $thumbnailPath = 'avatars/' . $user->id . '/thumbnail/' . $filename;
                Storage::put($thumbnailPath, $thumbnailImage);
                $user->avatar()->updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'filename' => $filename,
                        'url' => Storage::url($path),
                        'path' => $path,
                        'thumb_url' => Storage::url($thumbnailPath),
                        'thumb_path' => $thumbnailPath,
                    ]
                );
            }
        }
        catch(ValidationException $e)
        {
            DB::rollBack();
            dd($e->getErrors());
        }

        DB::commit();

        $success = 'Informations mises à jour.';
        return back()->withSuccess($success);
    }
}
