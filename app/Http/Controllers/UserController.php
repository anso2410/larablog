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
        $articles = $user->articles()->latest()->paginate(2);
        
        $data = [
            'title' => 'Profil de ' . $user->name,
            'description' => $user->name . ' est inscrit depuis le : ' . $user->created_at->isoFormat('LL') . ' et a posté ' . $user->articles()->count() . ' article(s)',
            'user' => $user,
            'articles' => $articles,
        ];

        return view('user.profil', $data);
        
    }



    public function password() // formulaire de changement de mot de passe
    {
        $data = [
            'title' => $description = 'modifier mon mot de passe',
            'description' => $description,
            'user' => auth()->user(),
        ];
        return view('user.password', $data);
    }



    public function updatePassword() //mise à jour du mot de passe
    {
        request()->validate([
            'current' => 'required|password',
            'password' => 'required|between:9,20|confirmed',
        ]);

        $user = auth()->user();

        $user->password = bcrypt(request('password'));

        $user->save();

        $succes = 'Mot de passe mise à jour';
        return back()->withSuccess($succes);
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

        try {
            $user = $user->updateOrCreate(
                ['id' => $user->id],
                request()->validate([
                    'name' => ['required', 'min:3', 'max:20', Rule::unique('users')->ignore($user)],
                    'email' => ['required', 'email', Rule::unique('users')->ignore($user)],
                    'avatar' => ['sometimes', 'nullable', 'image', 'file', 'mimes:jpeg,jpg, png', 'dimensions:min_width=200,min_height=200'],
                ])
            );
            if (request()->hasFile('avatar') && request()->file('avatar')->isValid()) {
                if (Storage::exists('avatars/' . $user->id)) {
                    Storage::deleteDirectory('avatars/' . $user->id);
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
        } catch (ValidationException $e) {
            DB::rollBack();
            dd($e->getErrors());
        }

        DB::commit();

        $success = 'Informations mises à jour.';
        return back()->withSuccess($success);
    }
}
