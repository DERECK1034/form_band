@extends('principal')

@section('contenido')

<style>
    .container {
        width: 1500px;
    }
    h1{
        font-family: serif;
        
    }
</style>

<h1>Reporte de ventas</h1>
<br>
<div class="container">
    <table class="table table-hover">
        <thead>
            <tr class="table-primary">
                <th scope="row">No. Venta</th>
                <td>Fecha</td>
                <td>Banda</td>
                <td>Cantidad</td>
                <td>Precio</td>
                <td>Operaciones</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($todasventas as $tv)
            <tr>
                <td>{{$tv->idven}}</td>
                <td>{{$tv->fecha}}</td>
                <td>{{$tv->banda}}</td>
                <td>{{$tv->cantidad}}</td>
                <td>{{$tv->total}}</td>
                <td>
                <a href="{{ route('editaventa', $tv->idven) }}" class="btn btn-warning">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@stop
