@extends ('admin.admin')

@section('title', $location->exists ? "Editer un lieu" : "Creer un lieu")

@section('content')

    <h1>@yield('title')</h1>

    <form action="{{ route($location->exists ? 'admin.location.update' : 'admin.location.store' , $location) }}" method="POST">
        
        @csrf
        @method($location->exists ? 'put' : 'post')

        @include('shared.input', ['label' => 'Nom', 'name' => 'name', 'value' => $location->name])
        @include('shared.input', ['label' => 'Capacite', 'name' => 'capacity', 'value' => $location->capacity])

        <div class="m-1">
            <button class="btn btn-primary">
                @if($location->exists)
                    Modifier
                @else
                    Creer
                @endif
            </button>
        </div>

@endsection