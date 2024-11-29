@extends('principal')

@section('contenido')

<center><h1>Editar Banda Rock/Metal</h1></center>
    <form action="{{ route('guardacambios', ['idb' => $infobanda->idb]) }}" method="POST" enctype ="multipart/form-data">
        {{ csrf_field()}}
        <input type= 'hidden' name= 'idma' value="{{$infobanda->idb}}">
        <center><table border = 1>
    <tr>
    <td align="right">* Nombre de la Banda:</td>
                    <td>
                    @if($errors->first('nombre'))
                    <p class="text-warning">{{$errors->first('nombre')}}</p>
                    @endif
                        <input type='text' class="form-control form-control-sm" name='nombre' value="{{$infobanda->banda}}" placeholder='Teclea el nombre'>
                    </td>
    </tr>
    <tr>
            <td algin = 'right'> *Banda inspiración:</td>
            <td><select  class="form-label mt-4" name = 'idi'>
                <option value='{{$infobanda->idi}}'>{{$infobanda->inspo}}</option>
                @foreach($inspiraciones as $i)
                <option value='{{$i->idi}}'>{{$i->nombre}}</option>
                @endforeach
                </select></td>
        </tr>
    <tr>
                    <td align='right'>* Género:</td>
                    <td>
                    @if($infobanda->genero=='rock')
                        <div class="form-check">
                            <input type='radio' class="form-check-input-info" name='genero' value='rock' checked> Rock<br>
                            <input type='radio' class="form-check-input-info" name='genero' value='metal'> Metal
                        </div>
                    @else
                    <div class="form-check">
                            <input type='radio' class="form-check-input-info" name='genero' value='rock' > Rock<br>
                            <input type='radio' class="form-check-input-info" name='genero' value='metal'checked> Metal
                        </div>
                    @endif

                    </td>

    </tr>
    <tr>
            <td algin = 'right'> * Subgenero:</td>
            <td><select  class="btn btn-info" name = 'ids'>
                
                <option value = '{{$infobanda->ids}}'>{{$infobanda->subgenero}}</option>
                @foreach($subgeneros as $s)
                <option value='{{$s->ids}}'>{{$s->nombre}}</option>
                @endforeach
                </select></td>
    </tr>
                <tr>
                    <td align='right'>* Fecha de surgimiento:</td>
                    <td>
                    @if($errors->first('surgimiento'))
                    <p class="text-warning">{{$errors->first('surgimiento')}}</p>
                    @endif
                        <input type='date' class="form-control form-control-sm" name='surgimiento' value="{{$infobanda->surgimiento}}">
                    </td>
    </tr>
    <tr>
                    <td align='right'>* Fecha de lanzamiento:</td>
                    <td>
                    @if($errors->first('lanzamiento'))
                    <p class="text-warning">{{$errors->first('lanzamiento')}}</p>
                    @endif
                        <input type='date' class="form-control form-control-sm" name='lanzamiento' value="{{$infobanda->lanzamiento}}">
                    </td>
    </tr>
    
    <tr>
    <td align="right">* Nombre vocalista:</td>
                    <td>
                    @if($errors->first('vocalista'))
                    <p class="text-warning">{{$errors->first('vocalista')}}</p>
                    @endif
                        <input type='text' class="form-control form-control-sm" name='vocalista' value="{{$infobanda->vocalista}}" >
                    </td>
    </tr>
    <tr>
    <td align="right">* Nombre guitarrista:</td>
                    <td>
                    @if($errors->first('guitarrista'))
                    <p class="text-warning">{{$errors->first('guitarrista')}}</p>
                    @endif
                        <input type='text' class="form-control form-control-sm" name='guitarrista' value="{{$infobanda->guitarrista}}">
                    </td>
    </tr>
    <tr>
    <td align="right">* Nombre bajista:</td>
                    <td>
                    @if($errors->first('bajista'))
                    <p class="text-warning">{{$errors->first('bajista')}}</p>
                    @endif
                        <input type='text' class="form-control form-control-sm" name='bajista' value="{{$infobanda->bajista}}" >
                    </td>
    </tr>
    <tr>
    <td align="right">* Nombre baterista:</td>
                    <td>
                    @if($errors->first('baterista'))
                    <p class="text-warning">{{$errors->first('baterista')}}</p>
                    @endif
                        <input type='text' class="form-control form-control-sm" name='baterista' value="{{$infobanda->baterista}}">
                    </td>
    </tr>
    <tr>
    <td align="right">* Correo electrónico:</td>
                    <td>
                    @if($errors->first('email'))
                    <p class="text-warning">{{$errors->first('email')}}</p>
                    @endif
                        <input type='text' class="form-control form-control-sm" name='email' value="{{$infobanda->email}}" placeholder='example@gmail.com'>
                    </td>
    </tr>
    <tr>
            <td align ='rigth'> * Discografía</td>
            <td><textarea class="form-label mt-4" name = 'discografia'>{{$infobanda->discografia}}</textarea></td>
    </tr>
    <tr>
    <td align="right">* codigo identificacion:</td>
                    <td>
                    @if($errors->first('codigo'))
                    <p class="text-warning">{{$errors->first('codigo')}}</p>
                    @endif
                        <input type='text' class="form-control form-control-sm" name='codigo' value="{{$infobanda->codigo}}">
                    </td>
    </tr>
    <tr>
            <td align='right'>*Logo</td>
                <td>
                @if($errors->first('foto'))
            <p class="text-warning">{{$errors->first('foto')}}</p>
            @endif
            <a href = "{{asset('archivos/'.$infobanda->foto)}}" target = '_blank'>
            <img src = "{{asset('archivos/'.$infobanda->foto)}}" height =80 width=80>
            </a>
            <input type = 'file' name ='foto' class="form-control">
            </td>
    </tr> 

    <tr>
            <td align='right'>*Formato certificación</td>
                <td>
                @if($errors->first('formato'))
            <p class="text-warning">{{$errors->first('formato')}}</p>
            @endif
            @if($extension == 'pdf' or $extension == 'PDF')
            <a href = "{{asset('formatos/'.$infobanda->formato)}}" target = '_blank'>
            <img src = " {{asset('archivos/pdf.png')}}" height = 100 width = 100>
            @elseif($extension == 'docx' or $extension == 'DOCX')
            <a href = "{{asset('formatos/'.$infobanda->formato)}}" target = '_blank'>
            <img src = " {{asset('archivos/word.png')}}" height = 100 width = 100>
            @else
            <img src = " {{asset('archivos/nofile.png')}}" height = 100 width = 100>
            @endif
            {{$infobanda->formato}}

            <input type = 'file' name ='formato' class="form-control">
            </td>
    </tr>

    @if(Session::get('sesiontipo')=='Administrador')
    <tr>
        <td align ='right'>* Activo:</td>

            <td><div class="form-check">
                <input type ='radio' class="form-check-input"name = 'activo' value = 'si' checked >Si<br>
                <input type ='radio' class="form-check-input"name = 'activo' value = 'no' >No
        </div></td>
        </tr>
        @endif

    <tr>
        <td align ='right' colspan = 2>
            <input  type='submit' class="btn btn-info" name = 'guardar' value = 'guardar'>
        </td>
    </tr>


</table></center>
</form>

@stop