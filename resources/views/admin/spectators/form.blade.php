@extends ('admin.admin')

@section('title', $spectator->exists ? "Editer un spectateur" : "Creer un spectateur")

@section('content')

    <h1>@yield('title')</h1>

    <form action="{{ route($spectator->exists ? 'admin.spectator.update' : 'admin.spectator.store' , $spectator) }}" method="POST">
        
        @csrf
        @method($spectator->exists ? 'put' : 'post')

        @include('shared.select', ['label' => 'Competition', 'name' => 'competition_id' , 'options' => $competitions->map(function($competition) {
            return [
                'value' => $competition->id,
                'text' => $competition->sport->name . ' - ' . date('d.m', strtotime($competition->day))
            ];
        }), 'value' => $spectator->competition_id])
        @include('shared.input', ['label' => 'Prenom', 'name' => 'first_name', 'value' => $spectator->first_name])
        @include('shared.input', ['label' => 'Nom', 'name' => 'last_name', 'value' => $spectator->last_name])
        @include('shared.input', ['label' => 'Numero de telephone', 'name' => 'phone_number', 'value' => $spectator->phone_number])
        @include('shared.input', ['label' => 'Email', 'name' => 'email', 'value' => $spectator->email])

        <div class="m-1">
            <button class="btn btn-primary">
                @if($spectator->exists)
                    Modifier
                @else
                    Creer
                @endif
            </button>
        </div>

@endsection