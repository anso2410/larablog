<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $articles = Article::orderByDesc('id')->get();

        $data = [
            'title'=>'Les articles du blog - '.config('app.name'),
            'description'=>'Retrouvez tous les articles de '.config('app.name'),
            'articles'=>$articles,
        ];

        return view('article.index', $data);

        //$count = Article::count();
        //dd($count);
        //$articles = Article::orderByDesc('id')->take(15)->get();
        //$article = Article::where('title', 'Debitis illum omnis sunt.')->firstOrFail();
        //dd($article);
       
        // foreach ($articles as $article) {
        //    dump($article->id, $article->title); /**$article->slug, $article->content, $article->created_at->diffForHumans());*/
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'Formulaire de creation';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //sauvegarde d'un nouvel article
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'Je suis l\'article avec l\'id '.$id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //user authentifié, editer/modifier son article via un formulaire
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // mise à jour de l'article en database
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // user peut supprimé l'article récuperer en base de données via l'identifiant passée dans l'URL
    }
}
