<style>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('form').on('submit', function(e) {
            e.preventDefault(); 
            
            var form = $(this);
            var url = form.attr('action');
            var data = form.serialize();

            $.post(url, data, function(response) {
                $('.contenedor-tabla').html(response.html);
            }).fail(function() {
                alert('Error al eliminar el boleto.');
            });
        });
    });
</script>

<center>
    <div class="contenedor-tabla">
        <table class="tabla-carrito">
            @forelse($carritodetalle as $cd)
            <tr>
                <td><img src="{{ asset('archivos/'.$cd->foto) }}" alt="Imagen" /></td>
                <td>{{ $cd->banda }}</td>
                <td>{{ $cd->seccion }}</td>
                <td>{{ $cd->total }}</td>
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
