<style>
    .container3 {
        width: 500px;
        border-width: 1px;
        border-style: solid;
        border-color: #EEEEEE;
        border-radius: 10px;
        padding: 10px;
    }

    .radio-container {
        display: flex;
        align-items: center;
    }

    .radio-container label {
        margin-left: 5px;
        margin-right: 15px;
    }

    .radio-container input {
        margin-left: 10px;
        margin-right: 5px;
    }

    #codigoc {
        display: none;
        margin-top: 10px;
    }

    .subtotal-container {
        text-align: right;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {
        var costo = parseFloat($('#costo').val());
        
        $('#cantidad_boletos').keyup(function() {
            var cantidadBoletos = parseFloat($(this).val()) || 0;
            var subtotal = costo * cantidadBoletos;
            $('#subtotal').text(subtotal.toFixed(2));
            $('#cantidad_boletos_hidden').val(cantidadBoletos);
            $('#subtotal_hidden').val(subtotal.toFixed(2));
        });

        $('input[name="cupon_descuento"]').change(function() {
            if ($('#cupon_si').is(':checked')) {
                var url = '{{ url('codigoc') }}'; 
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(data) {
                        $('#codigoc').html(data).show();
                    },
                    error: function() {
                        alert('Error al obtener la información del cupón.');
                    }
                });
            } else {
                $('#codigoc').hide();
            }
        });
    });
</script>

<div class="container3">
    <table>
        <tr>
            <td align="right">Disponibilidad:</td>
            <td>
                <input type="text" class="form-control form-control-sm" name="disponibilidad" id="disponibilidad" value="{{ $disponibilidad }}" readonly>
            </td>
        </tr>
        <tr>
            <td align="right">Costo:</td>
            <td>
                <input type="text" class="form-control form-control-sm" name="costo" id="costo" value="{{ $costo }}" readonly>
            </td>
        </tr>
        <tr>
            <td align="right">Cantidad de boletos:</td>
            <td>
                <input type="number" class="form-control form-control-sm" name="cantidad_boletos" id="cantidad_boletos">
            </td>
        </tr>
    </table>
</div>
<div class="subtotal-container">
    Subtotal: $<span id="subtotal">0.00</span>
</div>
<table>
    <tr>
        <td align="right">Cupón:</td>
        <td class="radio-container">
            <input type="radio" name="cupon_descuento" value="si" id="cupon_si">
            <label for="cupon_si">Sí</label>
            <input type="radio" name="cupon_descuento" value="no" id="cupon_no">
            <label for="cupon_no">No</label>
        </td>
    </tr>
</table>



<div id="codigoc"></div>
