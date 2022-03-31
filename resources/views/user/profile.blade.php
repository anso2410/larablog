@extends('layouts.main')

@section('content')

    <div class="row">
        <div class="col-lg-3">
            @include('includes.sidebar')
        </div>
        <!-- /.col-lg-3 -->
        <div class="col-lg-9">

            <h2 class="text-muted mt-3">Profil de {{$user->name  }}</h2>

            @if($user->avatar)
            <a href="{{ $user->avatar->url }}" target="blank">
                <img src="{{ $user->avatar->thumb_url }}" width="200" height="200" alt="image de {{ $user->name }}">
            </a>
            @endif

            {{-- début du post --}}

            @forelse ($articles as $article)
                <div class="card mt-4">

                    <div class="card-body">
                        <h2 class="card-title">
                            <a
                                href="{{ route('articles.show', ['article' => $article->slug]) }}">{{ $article->title }}</a>
                        </h2>
                        {{-- pour interpreter le script= non echappées = {!! '<script>alert("ok")</script> <p>Laravel trop cool !</p>' !!} --}
                        {{--pour ne pas interpreter par ex: ce qui vient du user( évite script malicieux) = {{ '<script>alert("ok")</script> <p>Laravel trop cool !</p>' }} --}}
                        <p class="card-text">{{ Str::words($article->content, 5) }}</p>

                        <span class="auhtor">Par <a
                                href="{{ route('user.profile', ['user' => $article->user->id]) }}">{{ $article->user->name }}</a>
                            inscrit le {{ $article->user->created_at->format('d/m/y') }}</span> <br>
                        <span class="time">posté {{ $article->created_at->diffForHumans() }}</span>
                        {{-- isoFormat('LLL') --}}

                        <div class="text-right">{{ $article->comments_count }} Commentaire(s)</div>

                        @if (Auth::check() && Auth::user()->id == $article->user_id)
                            <div class="author mt-4">
                                <a class="btn btn-info"
                                    href="{{ route('articles.edit', ['article' => $article->slug]) }}">Modifier</a>
                                &nbsp;
                                <form style="display:inline" class="mt-4"
                                    action="{{ route('articles.destroy', ['article' => $article->slug]) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="card mt-4">
                    <div class="card-body">
                        <p>Aucun article</p>
                    </div>
                </div>
            @endforelse

            {{-- fin du post --}}

            {{-- pagination --}}

            <div class="pagination mt-4">
                {{ $articles->links() }}
            </div>
            {{-- fin pagination --}}

            <!-- /.card -->

            <!-- /.card -->


        </div>
        <!-- /.col-lg-9 -->
    </div>

@stop
