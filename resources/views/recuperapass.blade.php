<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@5.2.3/dist/cosmo/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .container-custom {
            top: 100px;
            border-radius: 15px;
            position: relative;
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background: #ffffff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .container-custom h3 {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight: 600;
            color: #343a40;
            margin-bottom: 15px;
        }

        .form-control-sm {
            border-radius: 10px;
        }

        #mensaje {
            margin-top: 15px;
            font-size: 14px;
            color: #28a745;
        }
    </style>
</head>

<script type="text/javascript">
    $(document).ready(function () {
        $("#reinicia").click(function () {
            $("#mensaje").load('{{url('validauser')}}' + '?' + $(this).closest('form').serialize());
        });

        $("#otro").click(function () {
            $("#seleccionacaptcha").load('{{url('captchanuevo')}}');
        });
    });
</script>

<body>
    <center>
        <div class="container-custom">
            <h3>Reinicia Password</h3>
            <p class="mb-4">Introduce tu correo y te enviaremos un link de registro</p>

            <form id="formu">
                <div class="mb-3">
                    <label for="correo" class="form-label">Email</label>
                    <input type="email" class="form-control form-control-sm" name="correo" id="correo" placeholder="tucorreo@example.com">
                </div>
                <div class="mb-3">
                    <label for="captcha" class="form-label">Captcha</label>
                    <div id="seleccionacaptcha" class="mb-2">
                        <img src="{{asset('captchas/'.$captcha->ruta)}}" alt="Captcha" height='120' width='150'>
                    </div>
                    <input type="button" value="Otro" id="otro" class="btn btn-info btn-sm">
                </div>
                <div class="mb-3">
                    <label for="captcha" class="form-label">Teclea el valor del captcha</label>
                    <input type="hidden" name="textcap" id="textcap" value="{{$captcha->idcap}}">
                    <input type="text" class="form-control form-control-sm" name="captcha" placeholder="Introduce el captcha">
                </div>

                <input type="button" class="btn btn-success btn-sm" value="Reinicia Password" id="reinicia">
            </form>

            <div id="mensaje"></div>
        </div>
    </center>
</body>
</html>
