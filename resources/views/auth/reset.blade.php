@extends('layouts.main')

@section('content')

    <div class="row">
        <div class="col-lg-3">
            @include('includes.sidebar')
        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

            @if (session('success'))
                {{-- message connexion réussie --}}
                <div class="alert alert-success mt-3 text-center">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                {{-- message erreur connexion --}}
                <div class="alert alert-danger mt-3 text-center">{{ session('error') }}</div>
            @endif
            <!-- /.card -->

            <div class="card card-outline-secondary my-4">
                <div class="card-header">
                    Réinitialiser mon mot de passe
                </div>
                <!-- /.formulaire inscription -->
                <div class="card-body">

                    <form action="{{ route('post.reset') }}" method="post">

                        @csrf

                        <input type="hidden" name="token" value="{{ $password_reset->token }}">

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

                        <div class="form-group">
                            <label for="password">Confirmer le mot de passe</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-lg-9 -->
    </div>

@stop
