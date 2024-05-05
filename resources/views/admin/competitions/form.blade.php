@extends ('admin.admin')

@section('title', $competition->exists ? "Editer une competition" : "Creer une competition")

@section('content')

    <h1>@yield('title')</h1>

    <form action="{{ route($competition->exists ? 'admin.competition.update' : 'admin.competition.store' , $competition) }}" method="POST">

        @csrf
        @method($competition->exists ? 'put' : 'post')

        <div class="row">
            <div class="col row">
                @include('shared.select', ['label' => 'Sport', 'name' => 'sport_id' , 'options' => $sports->sortBy('name'), 'value' => $competition->sport_id])
                @include('shared.select', ['label' => 'Lieu', 'name' => 'location_id' , 'options' => $locations->sortBy('name'), 'value' => $competition->location_id])
            </div>
            <div class="col row">
                @include('shared.input', ['label' => 'Date', 'name' => 'day', 'type' => 'date', 'min' => '2024-01-01', 'max' => '2024-12-31', 'value' => $competition->day])
                @include('shared.input', ['label' => 'Heure de debut', 'name' => 'start_time', 'type' => 'time', 'value' => $competition->start_time])
                @include('shared.input', ['label' => 'Heure de fin', 'name' => 'end_time', 'type' => 'time', 'value' => $competition->end_time])
            </div>
            <div class="col row">
                @include('shared.radio', ['label' => 'Premier tour', 'name' => 'round', 'value' => 'Premier tour', 'checked' => $competition->round === 'Premier tour'])
                @include('shared.radio', ['label' => 'Demi-finale', 'name' => 'round', 'value' => 'Demi-finale', 'checked' => $competition->round === 'Demi-finale'])
                @include('shared.radio', ['label' => 'Finale', 'name' => 'round', 'value' => 'Finale', 'checked' => $competition->round === 'Finale'])
            </div>
            
            @include('shared.input', ['label' => 'Prix du billet', 'name' => 'price', 'type' => 'number', 'value' => $competition->price])
        </div>

        <div class="m-1">
            <button class="btn btn-primary">
                @if($competition->exists)
                    Modifier
                @else
                    Creer
                @endif
            </button>
        </div>

@endsection