@extends('base')

@section('title','Accueil')

@section('content')

@if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="bg-light p-5 mb-5 text-center">
    <div class="container">
        <h1>Ouvrons Grand les Jeux</h1>
        <p>Le Relais de la Flamme est une tradition incontournable qui nous plonge dans les racines des Jeux. La première torche du Relais de la Flamme Olympique de Paris 2024 sera allumée le <strong>16 avril 2024</strong>, selon la tradition antique, à l’aide des rayons du soleil, lors d’une cérémonie dans le sanctuaire d’Olympie, en Grèce, où se déroulaient les Jeux antiques. De la Péloponnèse, la Flamme Olympique rejoindra Athènes pour embarquer à bord du Belem et traverser la mer Méditerranée. C’est le <strong>8 mai 2024</strong>, à Marseille, que la Flamme Olympique débutera son épopée en France.</p>
    </div>
</div>

<div class="container mb-5">
    <h2 class="text-center my-3 mx-auto">Calendrier Olympique des Jeux de Paris 2024</h2>
    <div class="d-flex justify-content-between mb-1">
        <button class="btn btn-outline-secondary mx-1" id="toggleLocation">Afficher les lieux</button>
        <button class="btn btn-outline-secondary mx-1" id="filterPremierTour">Premier tour</button>
        <button class="btn btn-outline-secondary mx-1" id="filterDemiFinale">Demi-finale</button>
        <button class="btn btn-outline-secondary mx-1" id="filterFinale">Finale</button>
        <button class="btn btn-outline-secondary mx-1" id="showAll">Afficher tout</button>
    </div>
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center bg-secondary" style="width: 150px;">Juillet / Aout</th> <!-- Fixed column width -->
                            @php
                                $startDate = strtotime('2024-07-24');
                                $endDate = strtotime('2024-08-11');
                                $currentDate = $startDate;
                                $numDays = ($endDate - $startDate) / (60 * 60 * 24) + 1; // Number of days between start and end date
                            @endphp
                            @for ($i = 0; $i < $numDays; $i++)
                                <th class="text-center bg-secondary" style="width: 100px;">{{ date('d', $currentDate) }}</th> <!-- Fixed column width -->
                                @php
                                    $currentDate = strtotime('+1 day', $currentDate);
                                @endphp
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sports as $sport)
                            <tr>
                                <td style="max-width: 150px;"> <!-- Fixed row width -->
                                    <h6>{{$sport->name}}</h6>
                                    <div style="max-width: 4rem;">
                                        @if(file_exists(public_path('img/sports/'.$sport->name.'.png')))
                                            <a href="{{ route('reservation')}}">
                                                <img src="{{ asset('img/sports/'.$sport->name.'.png') }}" alt="{{ $sport->name }}" class="img-fluid p-2">
                                            </a>
                                        @endif
                                    </div>
                                </td>
                                @php
                                    $currentDate = $startDate;
                                @endphp
                                @for ($i = 0; $i < $numDays; $i++)
                                    <td class="text-center" style="width: 100px;"> <!-- Fixed row width -->
                                        @foreach ($competitions as $competition)
                                            @if ($competition->day == date('Y-m-d', $currentDate) and $competition->sport == $sport)
                                                <a href="{{ route('reservation', ['competition_id' => $competition->id]) }}" class="btn btn-info btn-sm mb-1 text-center my-auto">
                                                    <span class="location">{{ $competition->location->name }}</span> 
                                                    <span class="price">{{ $competition->price }}€</span>
                                                    <span class="round" style="display: none;">{{ $competition->round }}</span>
                                                </a>
                                            @endif
                                        @endforeach
                                    </td>
                                    @php
                                        $currentDate = strtotime('+1 day', $currentDate);
                                    @endphp
                                @endfor
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleLocationBtn = document.getElementById('toggleLocation');
        const filterPremierTourBtn = document.getElementById('filterPremierTour');
        const filterDemiFinaleBtn = document.getElementById('filterDemiFinale');
        const filterFinaleBtn = document.getElementById('filterFinale');
        const showAllBtn = document.getElementById('showAll');

        toggleLocationBtn.addEventListener('click', function() {
            const locations = document.querySelectorAll('.location');
            locations.forEach(location => {
                location.style.display = location.style.display === 'none' ? 'inline' : 'none';
            });
        });

        filterPremierTourBtn.addEventListener('click', function() {
            const rounds = document.querySelectorAll('.round');
            rounds.forEach(round => {
                round.parentElement.style.display = round.textContent === 'Premier tour' ? 'table-cell' : 'none';
            });
        });

        filterDemiFinaleBtn.addEventListener('click', function() {
            const rounds = document.querySelectorAll('.round');
            rounds.forEach(round => {
                round.parentElement.style.display = round.textContent === 'Demi-finale' ? 'table-cell' : 'none';
            });
        });

        filterFinaleBtn.addEventListener('click', function() {
            const rounds = document.querySelectorAll('.round');
            rounds.forEach(round => {
                round.parentElement.style.display = round.textContent === 'Finale' ? 'table-cell' : 'none';
            });
        });

        showAllBtn.addEventListener('click', function() {
            const competitions = document.querySelectorAll('.round');
            competitions.forEach(competition => {
                competition.parentElement.style.display = 'table-cell';
            });
        });
    });
</script>

@endsection
