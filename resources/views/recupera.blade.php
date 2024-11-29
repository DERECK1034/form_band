<html>
<head>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #333333;
        }

        p {
            font-size: 16px;
            color: #555555;
            line-height: 1.6;
        }

        .logo {
            width: 120px; 
            margin-bottom: 20px;
        }

        .user-info {
            font-size: 18px;
            margin: 20px 0;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 8px;
            border: 1px solid #e1e1e1;
        }

        .user-info span {
            font-weight: bold;
            color: #333333;
        }

        a {
            display: inline-block;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 16px;
        }

        a:hover {
            background-color: #0056b3;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #888888;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="{{asset('archivos/disco.png')}}" alt="Logo Inframundo de Riffs" class="logo">

        <h1>Estimado Usuario</h1>
        <p>Se ha realizado un cambio de contraseña de tu cuenta. Por favor, regresa al sitio y accede con la siguiente información:</p>

        <div class="user-info">
            <p>Usuario: <span>{{$usuario}}</span></p>
            <p>Clave: <span>{{$nuevaclave}}</span></p>
        </div>

        <p>Para acceder al sistema, haz clic en el siguiente enlace:</p>
        <a href="{{ route('login') }}">Clic aquí para acceder</a>

        <div class="footer">
            <p>Este es un correo automático, por favor no respondas a este mensaje.</p>
        </div>
    </div>
</body>
</html>
