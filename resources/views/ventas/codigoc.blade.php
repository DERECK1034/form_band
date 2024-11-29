<style>
    .total {
        text-align: right;
        margin-top: 10px;
        width: 100%;
    }
    .container {
        width: 500px;
        border-width: 1px;
        border-style: solid;
        border-color: #EEEEEE;
        border-radius: 10px;
        padding: 10px;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {
        $('#codigo').on('keyup', function() {
            var codigo = $(this).val();
            var subtotal = parseFloat($('#subtotal').text());

            if (codigo) {
                $.ajax({
                    url: '{{ url('verificar-codigo-cupon') }}',
                    method: 'GET',
                    data: { codigo: codigo },
                    success: function(data) {
                        if (data.porcentaje) {
                            var descuento = (subtotal * data.porcentaje) / 100;
                            var total = subtotal - descuento;
                            $('.total').text('Total: $' + total.toFixed(2));
                            $('#total_hidden').val(total.toFixed(2)); 
                        } else {
                            $('.total').text('Código de cupón no válido');
                            $('#total_hidden').val(subtotal.toFixed(2)); 
                        }
                    },
                    error: function() {
                        $('.total').text('Código de cupón no válido');
                        $('#total_hidden').val(subtotal.toFixed(2)); 
                    }
                });
            } else {
                $('.total').text('Total: $' + subtotal.toFixed(2));
                $('#total_hidden').val(subtotal.toFixed(2)); 
            }
        });
    });
</script>


<div class="container">
    <table>
        <tr>
            <td>
                <label for="codigo">Código del Cupón:</label>
                <input type="text" class="form-control form-control-sm" id="codigo" name="codigo">
            </td>
        </tr>
    </table>
</div>
<div class="total">
    Total: $
</div>
