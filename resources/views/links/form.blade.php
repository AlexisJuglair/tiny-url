@extends('base')

@section('title', $link->exists ? "Editer un lien" : "Créer un lien")

@section('content')
  <div class="d-flex justify-content-between align-items-center">
    <h1>@yield('title')</h1>
    <a href="{{ route('link.index') }}" class="btn btn-primary">Retourner à la liste</a>
  </div>

  <form class="vstack gap-2" action="{{ route($link->exists ? "link.update" : "link.store", $link) }}" method="post">

    @csrf
    @method($link->exists ?  'put' : 'post')

    <div class="row">
      <div class="col-md-10">
        <div class="form-group">
          <label for="link">Lien à raccourcir <span class="text-danger">*</span></label>
          <input class="form-control @error('link') is-invalid @enderror" type="text" id="link" name="link" value="{{ old('link', $link->link) }}">
          @error('link')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-check form-switch">
          <input class="form-check-input @error('show') is-invalid @enderror" type="checkbox" role="switch" id="show" {{ $link->show || !$link->exists ? 'checked' : '' }}>
          <label class="form-check-label" for="show">Afficher ?</label>
        </div>
        @error('show')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
         @enderror
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label for="link">Nom du lien <span class="text-danger">*</span></label>
          <input class="form-control @error('name') is-invalid @enderror" type="text"  id="name" name="name" value="{{ old('name', $link->name) }}">
          @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <label for="link">Alias <span class="text-danger">*</span></label>
          <input class="form-control @error('alias') is-invalid @enderror" type="text"  id="alias" name="alias" value="{{ old('alias', $link->alias) }}">
          @error('alias')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <label for="link">Date de validation <span class="text-danger">*</span></label>
          <input class="form-control @error('validation_date') is-invalid @enderror" type="datetime-local"  id="validation_date" name="validation_date" value="{{ old('validation_date', $link->validation_date) }}">
          @error('validation_date')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
      </div>
    </div>

    <div>
      <button class="btn btn-primary">
        @if ($link->exists)
          Modifier
        @else
          Créer 
        @endif
      </button>
    </div>

  </form>
@endsection