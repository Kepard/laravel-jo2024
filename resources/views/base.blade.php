<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>JO 2024 | @yield('title')</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top border-bottom border-dark">
        <div class="container-fluid">
            <img src="Olympic_flag.svg" width="90" height="60" class="mx-2"></img>
            <a class="navbar-brand" href="/">JO 2024</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            @php
            $route = request()->route()->getName();
            @endphp

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a @class(['nav-link','active' => str_contains($route,'competitions.')]) href="{{route('competitions')}}"> Competitions</a>
                    </li>
                    <li class="nav-item">
                        <a @class(['nav-link','active' => str_contains($route,'reservation.')]) href="{{route('reservation')}}">Billeterie</a>
                    </li>
                    <div>
                        <a href="{{ route('cart.list') }}" class="nav-link">
                            <img src="cart.svg" width="20" height="20" class="mx-2">{{ Cart::getTotalQuantity()}}</img>
                        </a>
                    </div>
                </ul>

                <div class="ms-auto">
                    <a class="btn btn-light" href="{{route('admin.competition.index')}}">Organisateur</a>
                </div>
            </div>
        </div>
    </nav>
        </nav>
    </div>
    

@yield('content')

<footer class="bg-light text-black text-center py-3">
    <p>© 2024 Jeux Olympiques. Tous droits réservés.</p>
</footer>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>