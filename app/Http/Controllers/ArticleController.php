<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\{
    Article,
    Category,
};


class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    protected $perPage = 12;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderByDesc('id')->paginate($this->perPage);


        $data = [
            'title' => 'Les articles du blog - ' . config('app.name'),
            'description' => 'Retrouvez tous les articles de ' . config('app.name'),
            'articles' => $articles,
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
        $categories = Category::get();

        $data = [
            'title' => $description = 'Ajouter un nouveau post',
            'description' => $description,
            'categories' => $categories,
        ];
        return view('article.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //sauvegarde d'un nouvel article
        dd(request()->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $data = [
            'title' => $article->title . ' - ' . config('app.name'),
            'description' => $article->title . '. ' . Str::words($article->content, 10),
            'article' => $article,
        ];
        return view('article.show', $data);
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
