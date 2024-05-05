@extends('base')

@section('title', 'Billeterie')

@section('content')

<div class="bg-light p-5">
    <div class="container">

        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <h2>Achat des billets</h2>
        <form id="reservationForm" method="POST">
            @csrf

            <div class="form-group my-2">
                <h5>Choisir la/les compétitions:</h5>
                <div class="form-check">
                    @foreach($competitions as $competition)
                        @php
                            $isChecked = request()->filled('competition_id') && $competition->id == request()->query('competition_id');
                        @endphp
                        <input class="form-check-input" type="checkbox" id="competition_{{ $competition->id }}" name="competitions[]" value="{{ $competition->id }}" {{ $isChecked ? 'checked' : '' }}>
                        <label class="form-check-label" for="competition_{{ $competition->id }}">
                            {{ $competition->sport->name }} | {{ $competition->round }} | {{ date('d F', strtotime($competition->day)) }}
                        </label>
                        @error('competitions')
                            <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                        <br>
                    @endforeach
                </div>
            </div>
            

            <div id="spectator-info my-2">
                <div class="form-group spectator">
                    <h5>Vos informations:</h5>
                    <label for="first_name">Prénom</label>
                    <input class="form-control @error('first_name.0') is-invalid @enderror" type="text" id="first_name" name="first_name[]" value="{{ old('first_name.0') }}">
                    @error('first_name.0')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    
                    <label for="last_name">Nom</label>
                    <input class="form-control @error('last_name.0') is-invalid @enderror" type="text" id="last_name" name="last_name[]" value="{{ old('last_name.0') }}">
                    @error('last_name.0')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    
                    <label for="phone_number">Numéro de téléphone</label>
                    <input class="form-control @error('phone_number.0') is-invalid @enderror" type="text" id="phone_number" name="phone_number[]" value="{{ old('phone_number.0') }}">
                    @error('phone_number.0')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    
                    <label for="email">Email</label>
                    <input class="form-control @error('email.0') is-invalid @enderror" type="email" id="email" name="email[]" value="{{ old('email.0') }}">
                    @error('email.0')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div id="input-group">

            </div>

            <button type="button" id="add-spectator" class="btn btn-primary my-2" onclick="addInputFields()">Ajouter un spectateur</button>
            <div>
            <button type="button" id="reserverBtn" class="btn btn-success my-2">Reserver</button>
            <button type="button" id="addToCartBtn" class="btn btn-outline-success my-2">Ajouter au panier</button>
        </div>
        </form>
    </div>
</div>

<script>
    var counter = 1;
    var maxFields = 5;

    function addInputFields() {
        if (counter >= maxFields) {
            return;
        }

        var inputGroup = document.getElementById('input-group');
        var formGroup = document.createElement('div');
        formGroup.classList.add('form-group');
        formGroup.innerHTML = `
            <h5>Informations du spectateur ${counter+1}:</h5>
            @include('shared.input', ['label' => 'Prénom', 'name' => 'first_name[]'])
            @include('shared.input', ['label' => 'Nom', 'name' => 'last_name[]'])
            <button type="button" class="btn btn-danger" onclick="removeInputFields()">Supprimer la personne</button>
        `;
        inputGroup.appendChild(formGroup);
        counter++;
    }

    function removeInputFields() {
        var inputGroup = document.getElementById('input-group');
        if (inputGroup.children.length >= 1) {
            inputGroup.removeChild(inputGroup.lastChild);
            counter--;
        }
    }

    document.getElementById('reserverBtn').addEventListener('click', function() {
        document.getElementById('reservationForm').action = "{{ route('reservation.store') }}";
        document.getElementById('reservationForm').submit();
    });


    document.getElementById('addToCartBtn').addEventListener('click', function() {
        document.getElementById('reservationForm').action = "{{ route('cart.store') }}";
        document.getElementById('reservationForm').submit();
    });
</script>


@endsection
