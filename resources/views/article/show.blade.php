@extends('layouts.main')

@section('content')

    <div class="row">
        <div class="col-lg-3">
            @include('includes.sidebar')
        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

            @if (session('success'))
                <div class="alert alert-success mt-3 text-center">
                    {{ session('success') }}
                </div>
            @endif

            {{-- début du post --}}

            <div class="card mt-4">

                <div class="card-body">
                    <h1 class="card-title">{{ $article->title }}</h1>
                    {{-- pour interpreter le script= non echappées = {!! '<script>alert("ok")</script> <p>Laravel trop cool !</p>' !!} --}
                    {{-- pour ne pas interpreter par ex: ce qui vient du user( évite script malicieux) = {{ '<script>alert("ok")</script> <p>Laravel trop cool !</p>' }} --}}
                    <p class="card-text">{{ $article->content }}</p>

                    <span class="auhtor">Par <a
                            href="{{ route('user.profile', ['user' => $article->user->id]) }}">{{ $article->user->name }}</a>
                        inscrit le {{ $article->user->created_at->format('d/m/y') }}</span><br>
                    <span class="time">
                        posté {{ $article->created_at->diffForHumans() }}</span> {{-- isoFormat('LLL') --}}
                </div>
            </div>

            {{-- fin du post --}}

            <!-- /.card -->

            <div class="card card-outline-secondary my-4">
                <div class="card-header">
                    Commentaires
                </div>
                <div class="card-body">
                    {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, --}}
                    {{-- similique necessitatibus neque non! Doloribus, modi sapiente --}}
                    {{-- laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p> --}}
                    {{-- <small class="text-muted">Jean le 25 Janvier à 19h02</small> --}}
                    {{-- <hr> --}}
                    @auth
                        <form action="{{ route('post.comment', ['article' => $article->slug]) }}" method="post">

                            @csrf

                            <div class="form-group">
                                <label for="content">Laisser un commentaire</label>
                                <textarea class="form-control" name="content" cols="30" rows="5"
                                    placeholder="votre commentaire...">{{ old('content') }}</textarea>

                                @error('content')
                                    <div class="error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <button type="submit" class="btn btn-primary">Commenter</button>
                        </form>
                    @endauth

                    @guest
                        <a href="{{ route('login') }}" class="btn btn-success">Laisser un commentaire</a>
                    @endguest
                </div>
            </div>
            {{-- <!-- /.card --> --}}
        </div>
        <!-- /.col-lg-9 -->
    </div>

@stop
