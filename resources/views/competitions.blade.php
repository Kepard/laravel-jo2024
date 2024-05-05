@extends('base')

@section('title', 'Liste des Compétitions')

@section('content')

<div class="container">
    <h2 class="text-center my-3">Liste des Compétitions</h2>

    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('competitions') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="date" class="form-control" name="date" placeholder="Date" min="2024-01-01" max="2024-12-31" value="{{ request('date') }}">
                    <select class="form-select" name="location_id" aria-label="Location">
                        <option value="">Toutes les localisations</option>
                        @foreach ($locations->sortBy('name') as $location)
                            <option value="{{ $location->id }}" {{ request('location_id') == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                        @endforeach
                    </select>
                    <select class="form-select" name="sport_id" aria-label="Sport">
                        <option value="">Tous les sports</option>
                        @foreach ($sports->sortBy('name') as $sport)
                            <option value="{{ $sport->id }}" {{ request('sport_id') == $sport->id ? 'selected' : '' }}>{{ $sport->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Filtrer</button>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Sport</th>
                    <th>Lieu</th>
                    <th>Tour</th>
                    <th>Prix</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($competitions as $competition)
                    <tr>
                        <td>{{ date('d F', strtotime($competition->day)) }}</td>
                        <td>{{ $competition->sport->name }}</td>
                        <td>{{ $competition->location->name }}</td>
                        <td>{{ $competition->round }}</td>
                        <td><a href="{{ route('reservation', ['competition_id' => $competition->id]) }}">{{ $competition->price }}€</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
