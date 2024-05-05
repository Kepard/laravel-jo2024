@extends('base')

@section('title','Se connecter')

@section('content')

<div class="mt-4 container">
    <h1>Acceder au panel organisateur</h1>



    <form action="{{route('login')}}" method="post" class="vstack gap-3z">
        @csrf
        @include('shared.input', ['type' => 'email', 'label' => 'Email', 'name' => 'email'])
        @include('shared.input', ['type' => 'password', 'label' => 'Mot de passe', 'name' => 'password'])
        <div>
            <button class="btn btn-primary my-1">
                Se connecter
            </button>
        </div>
    </form>

</div>

@endsection