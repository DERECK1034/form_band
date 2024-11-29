@extends('principal')

@section('contenido')

<style>
    .container {
        width: 1500px;
    }

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
    .contenedor-tabla {
        width: 80%;
        overflow: hidden;
        margin: auto;
    }

    .tabla-carrito {
        width: 100%;
        border-collapse: collapse;
    }

    .tabla-carrito td {
        padding: 10px;
        border: 1px solid #e0e0e0;
        text-align: center;
        vertical-align: middle;
    }

    .tabla-carrito img {
        width: 48px;
        height: 40px;
        object-fit: cover;
        display: block;
        margin: auto;
    }

    .tabla-carrito tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .tabla-carrito tr:nth-child(odd) {
        background-color: #ffffff;
    }

    .tabla-carrito tr:first-child {
        background-color: #fff; 
        font-weight: bold;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {

        $("#idcli").change(function() {
            var idcli = $(this).val();
            if (idcli) {
                $("#idcli_hidden").val(idcli);
                $("#infocliente").load('{{ url('infocliente') }}' + '?idcli=' + idcli);
            } else {
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
    $("#seccion").change(function() {
        var idsec = $(this).val();
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
    });
    $(document).ready(function() {
    $("#fecha").change(function() {
        var idcon = $(this).val();
        $("#idcon").val(idcon);
    });

    $("#seccion").change(function() {
        var idsec = $(this).val();
        $("#idsec").val(idsec); 
    });
});

</script>

<center><h1>Editar venta existente</h1></center>
<div class="form-container">
    <div class="form-section">
        <form action="{{ route('actualizarventa', $venta->idven) }}" method="POST">
            @csrf
            <table>
                <tr>
                    <td align="right">No. Venta</td>
                    <td>
                        <input class="form-control form-control-sm" type="text" name="idven" value="{{ $venta->idven ?? '' }}" readonly="readonly">
                    </td>
                </tr>
                <tr>
                    <td align="right">Vendedor</td>
                    <td>
                        <input class="form-control form-control-sm" type="text" name="vendedor" value="{{ $venta->nombre }} {{ $venta->apellido }}" readonly="readonly">
                        <input class="form-control form-control-sm" type="hidden" name="idu" value="{{ $venta->idu ?? '' }}">
                    </td>
                </tr>
                <tr>
                    <td align="right">Cliente</td>
                    <td>
                        <select class="form-select" name="idcli" id="idcli">
                            <option value="">Seleccione un cliente</option>
                            @foreach($clientes as $c)
                                <option value="{{ $c->idcli }}" {{ (isset($venta) && $venta->idcli == $c->idcli) ? 'selected' : '' }}>
                                    {{ $c->nombre }} {{ $c->apellido }}
                                </option>
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
                                <option value="{{ $b->idb }}" {{ (isset($venta) && $venta->idb == $b->idb) ? 'selected' : '' }}>
                                    {{ $b->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div class="form-section">
        <center>
            <div class="conciertos"></div>
                </div>
            </div>
        </center>
    </div>
</div>

<form action="{{ route('actualizarventa', $venta->idven) }}" method="POST">
    @csrf
    <input type="hidden" name="idven" value="{{ $venta->idven ?? '' }}">
    <input type="hidden" name="idu" value="{{ $venta->idu ?? '' }}">
    <input type="hidden" name="idcli" id="idcli_hidden" value="{{ $venta->idcli ?? '' }}">
    <input type="hidden" name="idcon" id="idcon" value="{{ $venta->idcon ?? '' }}">
    <input type="hidden" name="idsec" id="idsec" value="{{ $venta->idsec ?? '' }}">
    <input type="hidden" id="cantidad_boletos_hidden" name="cantidad" value="{{ $venta->cantidad ?? '' }}">
    <input type="hidden" id="subtotal_hidden" name="subtotal" value="{{ $venta->subtotal ?? '' }}">
    <input type="hidden" id="total_hidden" name="total" value="{{ $venta->total ?? '' }}">
    <button type="button" id="guardar" class="btn btn-primary btn-right">Actualizar Venta</button>
</form>

    <div id="lista">
        <center>
        <div class="contenedor-tabla">
            <table class="tabla-carrito">
                @forelse($carritodetalle as $cd)
                <tr>
                    <td><img src="{{ asset('archivos/'.$cd->foto) }}" alt="Imagen" /></td>
                    <td>{{ $cd->banda }}</td>
                    <td>{{ $cd->seccion }}</td>
                    <td>{{ $cd->subtotal }}</td>
                    <td>
                        <form action="{{ route('borraboleto') }}" method="POST" >
                            @csrf
                            <input type="hidden" name="idvd" value="{{ $cd->idvd }}">
                            <input type="hidden" name="idven" value="{{ $cd->idven }}">
                            <input type="hidden" name="idb" value="{{ $cd->idb }}">
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">No hay datos disponibles.</td>
                </tr>
                @endforelse
            </table>
        </div>
        <br><br>
    </center>
    </div>
@stop
