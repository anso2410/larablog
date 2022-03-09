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
            <!-- /.card -->

            <div class="card card-outline-secondary my-4">
                <div class="card-header">
                    Modifier la publication : {{ $article->title }}
                </div>

                <div class="card-body">

                    <form action="{{ route('articles.update', ['article' => $article->slug]) }}" method="post">
                        
                        @method('PUT')

                        @csrf

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $article->title) }}">
                            {{-- affichage message d'erreur --}}
                            @error('title')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="content">Contenu</label>
                            <textarea class="form-control" name="content" cols="30" rows="5"
                                placeholder="Contenu de la publication">{{ old('content', $article->content) }}</textarea>
                            @error('content')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="category">Catégorie</label>
                            <select name="category" class="form-control">
                                <option value=""></option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if(old('category', $article->category_id ?? null) == $category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>

                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-lg-9 -->
    </div>

@stop
