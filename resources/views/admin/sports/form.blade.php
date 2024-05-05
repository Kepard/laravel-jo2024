@extends ('admin.admin')

@section('title', $sport->exists ? "Editer un sport" : "Creer un sport")

@section('content')

    <h1>@yield('title')</h1>

    <form action="{{ route($sport->exists ? 'admin.sport.update' : 'admin.sport.store' , $sport) }}" method="POST">
        
        @csrf
        @method($sport->exists ? 'put' : 'post')

        @include('shared.input', ['label' => 'Nom', 'name' => 'name', 'value' => $sport->name])

        <div class="m-1">
            <button class="btn btn-primary">
                @if($sport->exists)
                    Modifier
                @else
                    Creer
                @endif
            </button>
        </div>

@endsection