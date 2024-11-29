@extends('principal')

@section('contenido')

<style>
    h1 {
        color: #000;
        font-family: serif;
    }
    .form-container {
        font-family: serif;
        display: flex;
        justify-content: center;
        margin-top: 10px;
    }
    .form-section {
        width: 45%;
        margin: 10px;
    }
    .form-section table {
        width: 100%;
    }
    .form-section td {
        padding: 10px;
    }
    .form-section select, .form-section input {
        width: 100%;
    }
    .conciertos {
        font-family: serif;
        padding: 10px;
        min-height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .btn-right {
        margin-left: 250px;
        display: block;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {
        $("#banda").prop('disabled', true);

        $("#idcli").change(function() {
            var idcli = $(this).val();
            if (idcli) {
                $("#banda").prop('disabled', false);
                $("#idcli_hidden").val(idcli);
                $("#infocliente").load('{{ url('infocliente') }}' + '?idcli=' + idcli);
            } else {
                $("#banda").prop('disabled', true);
                $("#idcli_hidden").val('');
            }
        });

        $("#banda").change(function() {
            var idb = $(this).val();
            if (idb) { 
                $(".conciertos").load('{{ url('conciertos') }}' + '?idb=' + idb);
            } else {
                $(".conciertos").html("Seleccione una banda para ver los conciertos.");
            }
        });

        $("#guardar").click(function(e) {
            e.preventDefault(); 
            var formData = $(this).closest('form').serialize();
            $.post("{{ url('agregaelemento') }}", formData, function(data) {
                $("#lista").html(data);
            })
        });
    });
</script>

<center><h1>Compra de boletos</h1></center>
<div class="form-container">
    <div class="form-section">
        <form action="">
            <table>
                <tr>
                    <td align="right">No. Venta</td>
                    <td>
                        <input class="form-control form-control-sm" type="text" name="idven" value="{{ $iddventa }}" readonly="readonly">
                    </td>
                </tr>
                <tr>
                    <td align="right">Vendedor</td>
                    <td>
                        <input class="form-control form-control-sm" type="text" name="vendedor" value="{{ $nombreusuario }}" readonly="readonly">
                        <input class="form-control form-control-sm" type="hidden" name="idu" value="{{ $idu }}">
                    </td>
                </tr>
                <tr>
                    <td align="right">Cliente</td>
                    <td>
                        <select class="form-select" name="idcli" id="idcli">
                            <option value="">Seleccione un cliente</option>
                            @foreach($clientes as $c)
                                <option value="{{ $c->idcli }}">{{ $c->nombre }} {{ $c->apellido }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <center>
                            <div id="infocliente"></div>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td align="right">Banda</td>
                    <td>
                        <select class="form-select" name="banda" id="banda">
                            <option value="">Seleccione una banda</option>
                            @foreach($bandas as $b)
                                <option value="{{ $b->idb }}">{{ $b->nombre }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div class="form-section">
        <center>
        <div class="conciertos">
            Seleccione una banda para ver los conciertos.
        </div>
        </center>
    </div>
</div>

<form action="{{ url('agregaelemento') }}" method="POST" >
    @csrf
    <input type="hidden" name="idven" value="{{ $iddventa }}">
    <input type="hidden" name="idu" value="{{ $idu }}">
    <input type="hidden" name="idcli" id="idcli_hidden">
    <input type="hidden" name="idcon" id="idcon">
    <input type="hidden" name="idsec" id="idsec">
    <input type="hidden" id="cantidad_boletos_hidden" name="cantidad">
    <input type="hidden" id="subtotal_hidden" name="subtotal">
    <input type="hidden" id="total_hidden" name="total">
    <button type="button" id="guardar" class="btn btn-primary btn-right">Comprar</button>
</form>

<div id="lista"></div>

<a href="{{ url('reporteventas') }}" class="btn btn-primary">Reporte</a>



@stop
