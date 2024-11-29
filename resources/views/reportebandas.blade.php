@extends('principal')

@section('contenido')


<center><h1> Reporte de bandas </h1>
<a href="{{ route('altabandas') }}">
            <button type="button" class="btn btn-primary">Alta de productos</button>
        </a></center>
        @if (Session:: has('mensaje'))
        
        <div>
            <div class="alert alert-dismissible alert-success">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Felicidades</strong> {{ Session::get('mensaje')}}
            </div>
        </div>
        @endif
        <center><table class ="table table-hover" border =1>
            <tr class="table-secondary">
                <td>Foto</td>
                <td>Nombre</td>
                <td>Inspiración</td>
                <td>Genero</td>
                <td>Subgenero</td>
                <td>Surgimiento</td>
                <td>Lanzamiento</td>
                <td>Vocalista</td>
                <td>Guitarrista</td>
                <td>Bajista</td>
                <td>Baterista</td>
                <td>Email</td>
                <td>Discografia</td>
                <td>Codigo de identificación</td>
                <td>Opciones</td>
                
            </tr>
            @foreach($consulta as $c)
            <tr class="table-dark">
                <td><img src = "{{asset('archivos/'.$c->foto)}}" height =80 width=80></td>
                <td>{{$c->banda}}</td>
                <td>{{$c->inspo}}</td>
                <td>{{$c->genero}}</td>
                <td>{{$c->subgenero}}</td>
                <td>{{$c->surgimiento}}</td>
                <td>{{$c->lanzamiento}}</td>
                <td>{{$c->vocalista}}</td>
                <td>{{$c->guitarrista}}</td>
                <td>{{$c->bajista}}</td>
                <td>{{$c->baterista}}</td>
                <td>{{$c->email}}</td>
                <td>{{$c->discografia}}</td>
                <td>{{$c->codigo}}</td>
                <td>
                @php $masid = Crypt::encrypt($c->idb); @endphp
                @if($c->activo == 'si')
                    <a href="{{ url('editabanda') }}/{{$masid}}">
                        <button type="button" class="btn btn-info">Editar</button>
                    </a>
                    
                    <a href="{{ url('desactivabanda') }}/{{$masid}}">
                        <button type="button" class="btn btn-warning">Desactivar</button>
                    </a>
                @else
                
                    <a href="{{ url('activabanda') }}/{{$masid}}">
                        <button type="button" class="btn btn-primary">Activar</button>
                    </a>
                    <a href="{{ url('eliminabanda') }}/{{$masid}}">
                        <button type="button" class="btn btn-danger">Eliminar</button>
                    </a>
                
                @endif
                </td>
            </tr>
            @endforeach
        </table></center>


        @stop