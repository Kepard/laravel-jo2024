@extends('base')

@section('title', 'Panier')

@section('content')

<main class="my-5">
    <div class="container px-6 mx-auto">
        <div class="row justify-content-center my-5">
            <div class="col-md-8">

            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
                <h3 class="text-3xl font-bold">Contenu du panier:</h3>
                <div class="flex-1">
                    <form action="{{ route('cart.save-to-db') }}" method="POST">
                        @csrf
                        <table class="table table-striped table-bordered text-sm">
                            <thead>
                                <tr class="uppercase">
                                    <th class="text-left">Spectateur</th>
                                    <th class="text-left">Recapitulatif</th>
                                    <th class="text-right">Prix</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                    <tr>
                                        <td>
                                            <span>{{ $item->name }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $item->attributes['recap'] }}</span>
                                        </td>
                                        <td class="text-right">
                                            <span class="text-sm font-medium">{{ $item->price }}€</span>
                                        </td>
                                        <td class="text-right">
                                            <form id="removeItemForm{{ $item->id }}" action="{{ route('cart.remove') }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $item->id }}" name="id">
                                                <button type="button" class="btn btn-danger" onclick="removeItem('{{ $item->id }}')">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <!-- Hidden inputs for each reservation details -->
                                    <input type="hidden" name="competitions[]" value="{{ $item->id }}">
                                    <input type="hidden" name="first_name[]" value="{{ $item->attributes['first_name'] }}">
                                    <input type="hidden" name="last_name[]" value="{{ $item->attributes['last_name'] }}">
                                    <input type="hidden" name="phone_number[]" value="{{ $item->attributes['phone_number'] }}">
                                    <input type="hidden" name="email[]" value="{{ $item->attributes['email'] }}">
                                @endforeach
                            </tbody>
                        </table>
                        <h5>
                            Prix total: {{ Cart::getTotal() }} €
                        </h5>
                        <button type="submit" class="btn btn-success my-2">Confirmer la réservation</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function removeItem(itemId) {
            if (confirm('Supprimer?')) {
                document.getElementById('removeItemForm' + itemId).submit();
            }
        }
    </script>
</main>

@endsection
