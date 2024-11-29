<html>
<head>
    <link rel="stylesheet" type="text/css" href ="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href ="{{asset('css/bootstrap.min.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <link rel="stylesheet" href="css/style.css">

</head>
<body>

<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">DISCOGRAFIA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor0" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor02">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('inicio') }}">Inicio
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('reportebandas') }}">Bandas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('crearventa') }}">Venta de boletos</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{ ('cerrarsesion') }}">Cerrar Sesion</a>
        </li>
      </ul>
      @if (Session::has('sesionname'))
      <div>BIENVENIDO
          <br>{{ Session::get('sesionname')}}
        <br>
        {{ Session::get('sesiontipo')}}
        @endif
    </div>
  </div>
</nav>

@yield('contenido')


<div class="list-group">
  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Derechos reservados</h5>
      <small>Diana A. Gonzalez R. 2024</small>
    </div>
</div> 

</body>
</html>