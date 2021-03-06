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
                    Hello {{ $user->name }}
                </div>

                <div class="card-body">

                    <form action="{{ route('post.user') }}" method="post" enctype="multipart/form-data">

                        @csrf

                        <div class="form-group">
                            <label for="name">Nom d'utilisateur</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                            {{-- affichage message d'erreur --}}
                            @error('name')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $user->email) }}">
                            {{-- affichage message d'erreur --}}
                            @error('email')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="avatar"> Mon avatar</label>
                            <br>
                            <input class="mt-2" type="file" name="avatar">
                            @error('avatar')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        @if (!empty($user->avatar->filename))
                            <div class="mb-4">
                                <a href="{{ $user->avatar->url }}" target="blank">
                                    <img src="{{ $user->avatar->thumb_url }}" width="200" height="200" alt="">
                                </a>
                            </div>
                        @endif

                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>

                    <p class="mt-3"><a href="{{ route('user.password') }}">Modifier mon mot de passe</a></p>

                    <div class="text-right">
                        <form action="{{ route('user.destroy', ['user'=>$user->id]) }}" method="post">
                           @method('DELETE') 
                           @csrf
                           <button type="submit" class="alert alert-danger">Supprimer mon compte</button>                           
                        </form>
                    </div>

                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-lg-9 -->
    </div>

@stop
