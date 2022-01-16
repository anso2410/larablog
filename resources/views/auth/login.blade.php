@extends('layouts.main')

@section('content')

    <div class="row">
        <div class="col-lg-3">
            @include('includes.sidebar')
        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

            @if (session('success')) {{-- message connexion réussie --}}
                <div class="alert alert-success mt-3 text-center">{{ session('success') }}</div>
            @endif

            @if (session('error'))  {{--message erreur connexion --}}
                <div class="alert alert-danger mt-3 text-center">{{ session('error') }}</div>
            @endif
            <!-- /.card -->

            <div class="card card-outline-secondary my-4">
                <div class="card-header">
                    Connexion
                </div>
                <!-- /.formulaire inscription -->
                <div class="card-body">

                    <form action="{{ route('post.login') }}" method="post">

                        @csrf

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                            {{-- affichage message d'erreur --}}
                            @error('email')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" name="password" class="form-control">
                            {{-- affichage message d'erreur --}}
                            @error('password')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember" value="1">
                            <label class="form-check-label" for="remember">Se souvenir de moi</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Connexion</button>
                    </form>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-lg-9 -->
    </div>

@stop
