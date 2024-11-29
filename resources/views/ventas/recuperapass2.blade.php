<html>
    <head>
    <link rel="stylesheet" type="text/css" href ="{{asset ('css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href ="{{asset ('css/bootstrap.min.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js">  </script>
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
    $(document).ready(function(){
        $("#recupera").click(function() {
            $("#mensaje").load('{{url('validauser2')}}' + '?' + $(this).closest('form').serialize()) ;
        });
    });
    </script>
    <body>
        <center><h1>Recupera contraseña</h1>
        <div class="container-custom">
        <form id="formu">
            Introduce un correo 
            <input type="text" class="form-control form-control-sm" name="correo" id="correo">
            <br>
            <input type="button" class="btn btn-primary btn-sm w-100" value="Recuperar" id="recupera">
        </form>
        <div id="mensaje"></div>
        </div>
        </center>
    </body>

</html>