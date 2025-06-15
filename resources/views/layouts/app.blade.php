<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Ambulâncias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Sistema Cólera</a>
            <div>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{ route('ambulancias.index') }}">Ambulâncias</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('ambulancias.create') }}">Cadastrar</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>

    <footer class="bg-light text-center text-muted py-3 mt-5">
        <small>&copy; {{ date('Y') }} Sistema de Gestão de Emergência</small>
    </footer>

</body>
</html>
