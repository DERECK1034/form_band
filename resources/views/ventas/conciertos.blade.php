<style>
    .boletosinfo {
        min-height: 100px;
        min-width: 200px; 
        padding: 10px; 
    }
    .container2 {
        display: block; 
        width: 500px;
        padding: 10px;
    }
</style>

<script type="text/javascript">
$(document).ready(function() {
    $("#seccion").change(function() {
        var idsec = $(this).val();
        console.log('Sección seleccionada:', idsec); 
        if (idsec !== "") {  
            var url = '{{ url('secciondetalle') }}' + '?idsec=' + idsec;
            $.ajax({
                url: url,
                method: 'GET',
                success: function(data) {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        $(".boletosinfo").html(data);
                    }
                },
                error: function() {
                    alert('Error al obtener la información de la sección.');
                }
            });
        } else {
            $(".boletosinfo").empty(); 
        }
    });

    $("#fecha").change(function() {
        var idcon = $(this).val();
        console.log('Fecha seleccionada:', idcon);
        if (idcon !== "") {
            $("#idcon").val(idcon);
        }
    });


    $("#seccion").change(function() {
        var idsec = $(this).val();
        console.log('Sección seleccionada:', idsec); 
        if (idsec !== "") {
            $("#idsec").val(idsec);
        }
    });
});
</script>

<div class='container2'>
    <table>
        <tr>
            <td align="right">Fecha</td>
            <td>
                <select class="form-select" name="fecha" id="fecha">
                    <option value="">Elige la fecha</option>
                    @foreach($conciertos as $con)
                        <option value="{{ $con->idcon }}">{{ $con->fecha }}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td align="right">Sección</td>
            <td>
                <select class="form-select" name="seccion" id="seccion">
                    <option value="">Elige una seccion</option>
                    @foreach($secciones as $sec)
                        <option value="{{ $sec->idsec }}">{{ $sec->nombre }}</option>
                    @endforeach
                </select>
            </td>
        </tr>
    </table>
    <div class="boletosinfo"></div>
</div>
