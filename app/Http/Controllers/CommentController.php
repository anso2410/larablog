<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest as RequestsCommentRequest;
use App\Events\CommentWasCreate;


use App\Models\{
    Comment,
    Article
};
//use App\Htpp\Requests\CommentRequest;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function store(RequestsCommentRequest $request, Article $article)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->id();

        $comment =  $article->comments()->create($validatedData);

        if (auth()->id() !== $article->user_id) // si le commentateur n'est l'auteur de l'article
        {   
            event(new CommentWasCreate($comment));
        }

        $success = 'Commentaire ajouté avec succès.';

        return back()->withSuccess($success);
    }
}
