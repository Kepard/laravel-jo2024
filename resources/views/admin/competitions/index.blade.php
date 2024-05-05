@extends('admin.admin')

@section('title', 'Toutes les competitions')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>@yield('title')</h1>
    <a href="{{ route('admin.competition.create')}}" class="btn btn-primary">Ajouter une competition</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Sport</th>
            <th>Lieu</th>
            <th>Le jour</th>
            <th>Heure de debut</th>
            <th>Heure de fin</th>
            <th>Prix du billet</th>
            <th>Tour</th>
            <th>Nombre de spectateurs</th>
            <th>Nombre de places restantes</th>
            <th class="text-end">Actions</th>
        </tr>
    </thead>
    
    <tbody>
        @foreach($competitions as $competition)
        <tr>
            <td>{{ $competition->sport->name }}</td>
            <td>{{ $competition->location->name }}</td>
            <td>{{ date('d.m', strtotime($competition->day)) }}</td>
            <td>{{ $competition->start_time }}</td>
            <td>{{ $competition->end_time }}</td>
            <td>{{ $competition->price }}€</td>
            <td>{{ $competition->round }}</td>
            <td>{{ $competition->spectators()->count() }}</td>
            <td>{{ $competition->location->capacity - $competition->spectators()->count()}}</td>
            <td>
                <div class="d-flex gap-2 w-100 justify-content-end">
                    <a href="{{ route('admin.competition.edit', $competition) }}" class="btn btn-primary">Editer</a>
                    <form action="{{ route('admin.competition.destroy', $competition) }}" method="POST" onsubmit="return confirm('Supprimer cette competition?')">
                        @csrf
                        @method("delete")
                        <button class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{$competitions->links()}}

@endsection