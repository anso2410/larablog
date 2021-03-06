<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    Article,
    Category,
};
use App\Http\Requests\ArticleRequest;




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
            'title' => $description = 'Ajouter une publication',
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
    public function store(ArticleRequest $request)
    {

        $validatedData = $request->validated();
        $validatedData['category_id'] = request('category', null);

        Auth::user()->articles()->create($validatedData);

        $success = 'Article ajout??.';

        return back()->withSuccess($success); 
    }

        // $article = Auth::user()->articles()->create(request()->validate([
        // 'title' => ['required', 'max:20', 'unique:articles,title'],
        // 'content' => ['required'],
        // 'category' => ['sometimes', 'nullable', 'exists:categories,id'],
        // ]));

        // $article->category_id = request('category', null);
        // $article->save();


        // [ personalisation du message de validation
        // 'title.required' => 'Y a pas de titre ahahhah!',
        // 'title.max' => 'Trop long'
        // ]);

        //sauvegarde d'un nouvel article

        // $article = Article::create([
        // 'user_id'=>auth()->id(),
        // 'title'=>request('title'),
        // 'slug'=>Str::slug(request('title')),
        // 'content'=>request('content'),
        // 'category_id'=>request('category', null ),
        // ]);


        // $article = new Article;
        // $article->user_id = auth()->id();
        // $article->category_id = request('category', null);
        // $article->title = request('title');
        // $article->slug = Str::slug($article->title);
        // $article->content = request('content');
        // $article->save();

       

       
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
            'comments' => $article->comments()->orderByDesc('created_at')->get(),
        ];

        return view('article.show', $data);
    }






    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //user authentifi??, editer/modifier son article via un formulaire
        abort_if(auth()->id() != $article->user_id, 403);

        $data = [
            'title' => $description = 'Mise ?? jour de ' . $article->title,
            'description' => $description,
            'article' => $article,
            'categories' => Category::get(),
        ];

        return view('article.edit', $data);
    }





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        abort_if(auth()->id() != $article->user_id, 403);
        //validation des donn??es
        $validatedData = $request->validated();
        $validatedData['category_id'] = request('category', null);
    
        // mise ?? jour de l'article en database
        $article = Auth::user()->articles()->updateOrCreate(['id' => $article->id], $validatedData);

        $success = 'Publication modifi??e';

        return redirect()->route('articles.edit', ['article' => $article->slug])->withSuccess($success);
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        abort_if(auth()->id() != $article->user_id, 403);
        
        // user peut supprim?? l'article r??cuperer en base de donn??es via l'identifiant pass??e dans l'URL
        $article->delete();

        $success = 'Publication supprim??e.';

        return back()->withSuccess($success);
        
    }
}
