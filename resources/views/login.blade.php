<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@5.2.3/dist/cosmo/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .login-container {
            margin-top: 100px;
            border-radius: 15px;
            width: 100%;
            max-width: 400px;
            padding: 30px;
            background: #ffffff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .login-container h2 {
            font-weight: 600;
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 10px;
        }

        .alerta {
            width: 100%;
            margin-top: 15px;
        }

        .form-control-sm {
            border-radius: 10px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px;
            border-radius: 10px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <center>
        <div class="login-container">
            <h2>Iniciar sesión</h2>
            <form action="{{ route('validar') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo electrónico</label>
                    <input type="text" class="form-control form-control-sm" id="correo" name="correo" required placeholder="tucorreo@example.com">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control form-control-sm" id="password" name="password" required placeholder="******">
                </div>
                <input type="submit" class="btn btn-primary btn-sm w-100" value="Iniciar Sesión">
                <div class="mt-3">
                    <small>¿Olvidaste tu contraseña? <a href="{{ route('newpassword') }}">Clic aquí</a></small>
                    <br>
                    <small>Recuperacion por URL <a href="{{ route('newpassword2') }}">Clic aquí</a></small>
                </div>
            </form>

            @if (Session::has('mensaje'))
                <div class="alerta">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error:</strong> {{ Session::get('mensaje') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
        </div>
    </center>
</body>
</html>
