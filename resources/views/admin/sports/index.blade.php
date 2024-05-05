@extends('admin.admin')

@section('title', 'Tous les sports')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>@yield('title')</h1>
    <a href="{{ route('admin.sport.create')}}" class="btn btn-primary">Ajouter un sport</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Nom</th>
            <th class="text-end">Actions</th>
        </tr>
    </thead>
    
    <tbody>
        @foreach($sports as $sport)
        <tr>
            <td>{{ $sport->name }}</td>
            <td>
                <div class="d-flex gap-2 w-100 justify-content-end">
                    <a href="{{ route('admin.sport.edit', $sport) }}" class="btn btn-primary" >Editer</a>
                    <form action="{{ route('admin.sport.destroy' , $sport)}}" method="POST" onsubmit="return confirm('Supprimer ce sport?')">
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

{{$sports->links()}}

@endsection