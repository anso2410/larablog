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
                    J'ai oublié mon mot de passe
                </div>
                <!-- /.formulaire inscription -->
                <div class="card-body">

                    <form action="{{ route('post.forgot') }}" method="post">

                        @csrf

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                            {{-- affichage message d'erreur --}}
                            @error('email')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>

                     <p class="mt-3"><a href="{{ route('forgot') }}">J'ai oublié mon mot de passe</a></p> 
                    <p class="mt-3"><a href="{{ route('register') }}">Je n'ai pas un compte</a></p> 

                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-lg-9 -->
    </div>

@stop
