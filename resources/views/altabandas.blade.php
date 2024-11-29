@extends('principal')

@section('contenido')

<center><h1>Fromulario Bandas Rock/Metal</h1></center>
<form action = "{{route('guardabanda')}}" method="POST" enctype ="multipart/form-data">
        {{ csrf_field()}}
<center><table border = 1>
    <tr>
    <td align="right">* Nombre de la Banda:</td>
                    <td>
                    @if($errors->first('nombre'))
                    <p class="text-warning">{{$errors->first('nombre')}}</p>
                    @endif
                        <input type='text' class="form-control form-control-sm" name='nombre' value="{{ old('nombre') }}" placeholder='Teclea el nombre'>
                    </td>
    </tr>
    <tr>
            <td algin = 'right'> * Banda inspiración:</td>
            <td><select  class="btn btn-info" name = 'idi'>
                @foreach($todasinspiraciones as $ti)
                <option value = '{{$ti->idi}}'>{{$ti->nombre}}</option>
                @endforeach
                </select></td>
    </tr>
    <tr>
                    <td align='right'>* Género:</td>
                    <td>
                        <div class="form-check">
                            <input type='radio' class="form-check-input-info" name='genero' value='rock' checked> Rock<br>
                            <input type='radio' class="form-check-input-info" name='genero' value='metal'> Metal
                        </div>
                    </td>

    </tr>
    <tr>
            <td algin = 'right'> * Subgenero:</td>
            <td><select  class="btn btn-info" name = 'ids'>
                @foreach($todossubgeneros as $ts)
                <option value = '{{$ts->ids}}'>{{$ts->nombre}}</option>
                @endforeach
                </select></td>
    </tr>
                <tr>
                    <td align='right'>* Fecha de surgimiento:</td>
                    <td>
                    @if($errors->first('surgimiento'))
                    <p class="text-warning">{{$errors->first('surgimiento')}}</p>
                    @endif
                        <input type='date' class="form-control form-control-sm" name='surgimiento' value="{{ old('surgimiento') }}">
                    </td>
    </tr>
    <tr>
                    <td align='right'>* Fecha de lanzamiento:</td>
                    <td>
                    @if($errors->first('lanzamiento'))
                    <p class="text-warning">{{$errors->first('lanzamiento')}}</p>
                    @endif
                        <input type='date' class="form-control form-control-sm" name='lanzamiento' value="{{ old('fecha_lanzamiento') }}">
                    </td>
    </tr>
    
    <tr>
    <td align="right">* Nombre vocalista:</td>
                    <td>
                    @if($errors->first('vocalista'))
                    <p class="text-warning">{{$errors->first('vocalista')}}</p>
                    @endif
                        <input type='text' class="form-control form-control-sm" name='vocalista' value="{{ old('vocalista') }}" >
                    </td>
    </tr>
    <tr>
    <td align="right">* Nombre guitarrista:</td>
                    <td>
                    @if($errors->first('guitarrista'))
                    <p class="text-warning">{{$errors->first('guitarrista')}}</p>
                    @endif
                        <input type='text' class="form-control form-control-sm" name='guitarrista' value="{{ old('guitarrista') }}">
                    </td>
    </tr>
    <tr>
    <td align="right">* Nombre bajista:</td>
                    <td>
                    @if($errors->first('bajista'))
                    <p class="text-warning">{{$errors->first('bajista')}}</p>
                    @endif
                        <input type='text' class="form-control form-control-sm" name='bajista' value="{{ old('bajista') }}" >
                    </td>
    </tr>
    <tr>
    <td align="right">* Nombre baterista:</td>
                    <td>
                    @if($errors->first('baterista'))
                    <p class="text-warning">{{$errors->first('baterista')}}</p>
                    @endif
                        <input type='text' class="form-control form-control-sm" name='baterista' value="{{ old('baterista') }}">
                    </td>
    </tr>
    <tr>
    <td align="right">* Correo electrónico:</td>
                    <td>
                    @if($errors->first('email'))
                    <p class="text-warning">{{$errors->first('email')}}</p>
                    @endif
                        <input type='text' class="form-control form-control-sm" name='email' value="{{ old('email') }}" placeholder='example@gmail.com'>
                    </td>
    </tr>
    <tr>
            <td align ='rigth'> * Discografía</td>
            <td><textarea class="form-label mt-4" name = 'discografia'></textarea></td>
    </tr>
    <tr>
    <td align="right">* codigo identificacion:</td>
                    <td>
                    @if($errors->first('codigo'))
                    <p class="text-warning">{{$errors->first('codigo')}}</p>
                    @endif
                        <input type='text' class="form-control form-control-sm" name='codigo' value="{{ old('codigo') }}">
                    </td>
    </tr>
    <tr>
            <td align='right'>*Logo</td>
                <td>
                @if($errors->first('foto'))
            <p class="text-warning">{{$errors->first('foto')}}</p>
            @endif<input type = 'file' name ='foto' class="form-control">
            </td>
    </tr>
    <tr>
            <td align='right'>*Fromato certificación</td>
                <td>
                @if($errors->first('formato'))
            <p class="text-warning">{{$errors->first('formato')}}</p>
            @endif<input type = 'file' name ='formato' class="form-control">
            </td>
    </tr>

    <tr>
        <td align ='right'>* Activo:</td>

            <td><div class="form-check">
                <input type ='radio' class="form-check-input"name = 'activo' value = 'si' checked >Si<br>
                <input type ='radio' class="form-check-input"name = 'activo' value = 'no' >No
        </div></td>
        </tr>

    <tr>
        <td align ='right' colspan = 2>
            <input  type='submit' class="btn btn-info" name = 'guardar' value = 'guardar'>
        </td>
    </tr>


</table></center>
</form>

@stop