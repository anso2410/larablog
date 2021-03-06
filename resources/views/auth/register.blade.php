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
                    Inscription
                </div>
                <!-- /.formulaire inscription -->
                <div class="card-body">

                    <form action="{{ route('post.register') }}" method="post">

                        @csrf

                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                            {{-- affichage message d'erreur --}}
                            @error('name')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                            {{-- affichage message d'erreur --}}
                            @error('email')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" name="password" class="form-control">
                            {{-- affichage message d'erreur --}}
                            @error('password')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- <div class="form-group form-check"> --}}
                        {{-- <input type="checkbox" class="form-check-input" id="exampleCheck1"> --}}
                        {{-- <label class="form-check-label" for="exampleCheck1">Check me out</label> --}}
                        {{-- </div> --}}
                        <button type="submit" class="btn btn-primary">Inscription</button>
                    </form>

                    <p class="mt-3"><a href="{{ route('login') }}">J'ai d??j?? un compte</a></p>

                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-lg-9 -->
    </div>

@stop
