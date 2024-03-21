@extends('base')

@section('title', 'Connexion')

@section('content')
  <h1>Se connecter</h1>

  <div class="card">
    <div class="card-body">
      @if ($errors->has('credentials'))
        <div class="alert alert-danger">
            {{ $errors->first('credentials') }}
        </div>
      @endif
      <p><strong>Identifiant: admin | Mot de passe : admin</strong></p>
      <form action="{{ route('login.post') }}" method="post" class="vstack gap-3">

        @csrf

        <div class="form-group">
          <label for="link">Identifiant</label>
          <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ old('email') }}">
          @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="form-group">
          <label for="link">Mot de passe</label>
          <input class="form-control @error('password') is-invalid @enderror" type="password" id="password" name="password">
          @error('password')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <button class="btn btn-primary">Se connecter</button>

      </form>
    </div>
  </div>
@endsection