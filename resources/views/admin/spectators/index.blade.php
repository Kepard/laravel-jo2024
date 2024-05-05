@extends('admin.admin')

@section('title', 'Tous les spectateurs')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>@yield('title')</h1>
    <a href="{{ route('admin.spectator.create')}}" class="btn btn-primary">Ajouter un spectateur</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Competition</th>
            <th>Prenom</th>
            <th>Nom</th>
            <th>Numero de telephone</th>
            <th>Email</th>
            <th class="text-end">Actions</th>
        </tr>
    </thead>
    
    <tbody>
        @foreach($spectators as $spectator)
        <tr>
            <td>{{ $spectator->competition->sport->name . ' - ' .date('d.m', strtotime($spectator->competition->day))  }}</td>
            <td>{{ $spectator->first_name }}</td>
            <td>{{ $spectator->last_name }}</td>
            <td>{{ $spectator->phone_number }}</td>
            <td>{{ $spectator->email }}</td>
            <td>
                <div class="d-flex gap-2 w-100 justify-content-end">
                    <a href="{{ route('admin.spectator.edit', $spectator) }}" class="btn btn-primary" >Editer</a>
                    <form action="{{ route('admin.spectator.destroy' , $spectator)}}" method="POST" onsubmit="return confirm('Supprimer ce spectateur?')">
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

{{$spectators->links()}}

@endsection