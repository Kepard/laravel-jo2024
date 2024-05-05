@extends('admin.admin')

@section('title', 'Tous les lieux')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>@yield('title')</h1>
    <a href="{{ route('admin.location.create')}}" class="btn btn-primary">Ajouter un lieu</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Capacite</th>
            <th class="text-end">Actions</th>
        </tr>
    </thead>
    
    <tbody>
        @foreach($locations as $location)
        <tr>
            <td>{{ $location->name }}</td>
            <td>{{ $location->capacity }}</td>
            <td>
                <div class="d-flex gap-2 w-100 justify-content-end">
                    <a href="{{ route('admin.location.edit', $location) }}" class="btn btn-primary" >Editer</a>
                    <form action="{{ route('admin.location.destroy' , $location)}}" method="POST" onsubmit="return confirm('Supprimer ce lieu?')">
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

{{$locations->links()}}

@endsection