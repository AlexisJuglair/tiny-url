@extends('base')

@section('title', 'Liste des liens')

@section('content')
  <div class="d-flex align-items-center gap-2">
    <h1>@yield('title')</h1>
    @auth
      <a href="{{ route('link.create') }}" class="btn btn-primary">Ajouter un lien</a>
      <form action="{{ route('logout') }}" method="post">
        @method('delete')
        @csrf
        <button class="btn btn-primary">Se déconnecter</button>
      </form>
    @endauth
    @guest
      <a href="{{ route('login.get') }}" class="btn btn-primary">Se connnecter</a>
    @endguest
  </div>

  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
      <tr>
        <th>Nom</th>
        <th>Lien raccourci</th>
        @auth
          <th class="text-center">Nombre de clic</th>
          <th class="text-center">Date de validation</th>
          <th class="text-center">Afficher ?</th>
          <th class="text-end">Actions</th>
        @endauth
      </tr>
      </thead>
      <tbody>
      @foreach ($links as $link)
        @if ((Auth::check() || ($link->validation_date > now() && $link->show)))
          @php
            $urlTiny = route('link.show', ['id' => $link->id, 'alias' => $link->alias]);
          @endphp
          <tr>
            <td>
              {{ $link->name }}
            </td>
            <td>
              <a href="{{ $urlTiny }}" target="_blank" class="btn btn-primary">
                {{ $urlTiny }}
              </a>
            </td>
            @auth
              <td class="text-center">{{ $link->nb_click }}</td>
              <td class="text-center">{{ \Carbon\Carbon::parse($link->validation_date)->format('d-m-Y H:i') }}</td>
              <td class="text-center">
                @if ($link->show)
                  <span class="badge text-bg-success">Oui</span>
                @endif            
              </td>
              <td>
                <div class="d-flex gap-2 w-100 justify-content-end">
                  <a href="{{ route('link.edit', $link) }}" class="btn btn-primary">Editer</a>
                  <form action="{{ route('link.destroy', $link) }}" method="post">
                    @csrf
                    @method("delete")

                    <button class="btn btn-danger">Supprimer</button>
                  </form>
                </div>
              </td>
            @endauth
          </tr>
        @endif
      @endforeach
      </tbody>
    </table>
  </div>
  
  {{ $links->links() }}
@endsection