
<style>
    #infocliente table  {
    width: 450px;
    height: 250px;
    background-color: #fff;
    background: linear-gradient(#f8f8f8, #fff);
    box-shadow: 0 8px 16px -8px rgba(0,0,0,0.4);
    border-radius: 10px;
    overflow: hidden;
    position: relative;
    margin-top: 10px;
  }
</style>

@if($cliente)
    <table border="1">
        <tr><td colspan="2"><center><b>Información del cliente</b></center></td></tr>
        <tr>
            <td>
                <img src="{{ asset('fotosclientes/'.$cliente->foto) }}" height="250" width="200">
            </td>
            <td>
                Nombre: {{ $cliente->nombre }}<br>
                Tipo: {{ $cliente->tipo }}<br>
                @if(isset($cliente->tel))
                    Teléfono: {{ $cliente->tel }}<br>
                @else
                    Teléfono: No disponible<br>
                @endif
            </td>
        </tr>
    </table>
@else
    <p>Cliente no encontrado o sin teléfono disponible.</p>
@endif
