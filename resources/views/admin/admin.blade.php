<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>@yield('title') | Administration </title>

</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top border-bottom border-white">
        <div class="container-fluid">
            <img src="{{ URL('Olympic_flag.svg')}}" width="90" height="60" class="mx-2"></img>
            <a class="navbar-brand" href="/admin/competition">JO 2024</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            @php
            $route = request()->route()->getName();
            @endphp

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item active">
                        <a @class(['nav-link','active' => str_contains($route,'competition.')]) href="{{route('admin.competition.index')}}">Gerer les competitions</a>
                    </li>
                    <li class="nav-item">
                        <a @class(['nav-link','active' => str_contains($route,'location.')]) href="{{route('admin.location.index')}}">Gerer les lieux</a>
                    </li>
                    <li class="nav-item">
                        <a @class(['nav-link','active' => str_contains($route,'spectator.')]) href="{{route('admin.spectator.index')}}">Gerer les spectateurs</a>
                    </li>
                    <li class="nav-item">
                        <a @class(['nav-link','active' => str_contains($route,'sport.')]) href="{{route('admin.sport.index')}}">Gerer les sports</a>
                    </li>
                </ul>
                <div class="ms-auto">
                    @auth
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="{{route('home')}}" class="btn btn-secondary m-1">Revenir sur la page d'acceuil</a>
                            </li>
                            <li class="nav-item">
                                <form action="{{ route('logout')}}" method="post" onsubmit="return confirm('Confirmer la deconnexion')">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-secondary m-1">Se deconnecter</button>
                                </form>
                            </li>
                        </ul>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success')}}
        </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="my-0">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')

    </div>

    <footer class="bg-dark text-white text-center py-3">
        <p>Administration</p>
        <p>© 2024 Jeux Olympiques. Tous droits réservés.</p>
    </footer>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>