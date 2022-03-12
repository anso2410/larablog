<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest as RequestsCommentRequest;

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

        $article->comments()->create($validatedData);

    }
}
