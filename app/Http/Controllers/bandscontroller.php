<?php

namespace App\Http\Controllers;

use App\Models\inspiraciones;
use App\Models\subgeneros;
use App\Models\bandas;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

use Session;

use Illuminate\Http\Request;

class bandscontroller extends Controller
{

    public function inicio()
    {
        return view('inicio');
    }
    public function altabandas()
    {
        if(Session::get('sesionidu'))
        {
            $todasinspiraciones = inspiraciones::orderby('nombre', 'asc')->get();
            $todossubgeneros = subgeneros::orderby('nombre', 'asc')->get();
            return view('altabandas')
            ->with('todasinspiraciones', $todasinspiraciones)
            ->with('todossubgeneros', $todossubgeneros);
        }
        else
        {
            Session::flash('mensaje', "Es necesario iniciar sesión");
            return view('login');
        }
    }

    public function guardabanda(Request $request)
    {

        $this->validate($request,[   
            'nombre'=>'regex:/^[A-Z][a-z,A-Z, ,á,é,í,ó,Ü,ñ,Ñ]+$/',
            'surgimiento'=>'required|date',
            'lanzamiento'=>'required|date',
            'vocalista'=>'regex:/^[A-Z][a-z,A-Z, ,á,é,í,ó,Ü,ñ,Ñ]+$/',
            'guitarrista'=>'regex:/^[A-Z][a-z,A-Z, ,á,é,í,ó,Ü,ñ,Ñ]+$/',
            'bajista'=>'regex:/^[A-Z][a-z,A-Z, ,á,é,í,ó,Ü,ñ,Ñ]+$/',
            'baterista'=>'regex:/^[A-Z][a-z,A-Z, ,á,é,í,ó,Ü,ñ,Ñ]+$/',
            'email' => 'required|email|unique:bandas,email',
            'codigo' => 'regex:/^[a-z][0-9]{3}[-][a-z]{1}$/',
            'foto' => 'image|mimes:jpeg,png,jpg,gif',
            'formato' =>'mimes:pdf, docx'
        ]);


        $currentDateTime = now();
        

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fecha = date_create();
            $img = date_timestamp_get($fecha) . $file->getClientOriginalName();
            \Storage::disk('local')->put($img, \File::get($file));
        } else {
            $img = 'sinfoto.png';
        }

        $nombreformato = '';
        $archi = $request->file('formato');
        if ($file != '')
        {
        $fecha = date_create();
        $nombreformato = date_timestamp_get($fecha) . $archi->getClientOriginalName();
        \Storage::disk('archiv')->put($nombreformato, \File::get($archi));
        }


        \DB::table('bandas')->insert([
            'nombre' => $request->nombre,
            'id_inspo' => $request->idi,
            'genero' => $request->genero,
            'id_subgen' => $request->ids,
            'fecha_surgimiento' => $request->surgimiento,
            'fecha_lanzamiento' => $request->lanzamiento,
            'vocalista' => $request->vocalista,
            'guitarrista' => $request->guitarrista,
            'bajista' => $request->bajista,
            'baterista' => $request->baterista,
            'email' => $request->email,
            'discografia' => $request->discografia,
            'codigo' => $request->codigo,
            'foto'=> $img, 
            'formato'=>$nombreformato,
            'activo' => $request->activo,
            'created_at' => $currentDateTime
        ]);

        Session::flash('mensaje', "La información de la banda $request->nombre se ha guardado correctamente");
        return redirect()->route('reportebandas');
    }

    public function reportebandas()
    {
        if(Session::get('sesionidu'))
        {
            $consulta = \DB::select("SELECT b.idb, b.nombre AS banda, b.id_inspo AS idi, i.nombre AS inspo, b.id_subgen AS  ids, b.genero, s.nombre AS subgenero, b.fecha_surgimiento as surgimiento, b.fecha_lanzamiento as lanzamiento, b.vocalista, b.guitarrista, b.bajista, b.baterista, b.email, b.discografia, b.codigo, b.activo, b.foto, b.formato
            FROM bandas AS b
            INNER JOIN inspiraciones AS i ON i.idi = b.id_inspo
            INNER JOIN subgeneros AS s ON s.ids = b.id_subgen
            ORDER BY banda ASC");
            return view ('reportebandas')->with('consulta', $consulta);
        }
        else
        {
            Session::flash('mensaje', "Es necesario iniciar sesión");
            return view('login');
        }
    }

    public function editabanda($idb)
    {
        $clave = Crypt::decrypt($idb);

        if(Session::get('sesionidu'))
        {
            $infobanda =\DB::select("SELECT b.idb, b.nombre AS banda, b.id_inspo AS idi, i.nombre AS inspo, b.genero, b.id_subgen AS ids, s.nombre AS subgenero, b.fecha_surgimiento as surgimiento, b.fecha_lanzamiento as lanzamiento, b.vocalista, b.guitarrista, b.bajista, b.baterista, b.email, b.discografia, b.codigo, b.activo, b.foto, b.formato
            FROM bandas AS b
            INNER JOIN inspiraciones AS i ON i.idi = b.id_inspo
            INNER JOIN subgeneros AS s ON s.ids = b.id_subgen
            WHERE idb = $clave");

            if($infobanda[0]->formato !='')
            {
            $extensionarchivo = explode('.', $infobanda[0]->formato);
            $extension = $extensionarchivo[1];
            }
            else
            {
                $extension = 'NA';
            }

            $inspiraciones= inspiraciones::where('idi', '<>', $infobanda[0]->idi)
            -> orderby('nombre', 'Asc')
            ->get();

            $subgeneros = subgeneros::where('ids', '<>', $infobanda[0]->ids)
            -> orderby('nombre', 'Asc')
            ->get();

            return view('editarbanda')
            ->with('infobanda', $infobanda[0])
            ->with('inspiraciones', $inspiraciones)
            ->with('subgeneros', $subgeneros)
            ->with('extension', $extension);
    }
    else
    {
        Session::flash('mensaje', "Es necesario iniciar sesión");
        return view('login');
    }
    }

    public function guardacambios(Request $request, $idb)
{
    $this->validate($request, [
        'nombre' => 'regex:/^[A-Z][a-z,A-Z, ,á,é,í,ó,Ü,ñ,Ñ]+$/',
        'surgimiento' => 'required|date',
        'lanzamiento' => 'required|date',
        'vocalista' => 'regex:/^[A-Z][a-z,A-Z, ,á,é,í,ó,Ü,ñ,Ñ]+$/',
        'guitarrista' => 'regex:/^[A-Z][a-z,A-Z, ,á,é,í,ó,Ü,ñ,Ñ]+$/',
        'bajista' => 'regex:/^[A-Z][a-z,A-Z, ,á,é,í,ó,Ü,ñ,Ñ]+$/',
        'baterista' => 'regex:/^[A-Z][a-z,A-Z, ,á,é,í,ó,Ü,ñ,Ñ]+$/',
        'email' => 'required|email', 
        'codigo' => 'regex:/^[a-z][0-9]{3}[-][a-z]{1}$/',
        'foto' => 'image|mimes:jpeg,png,jpg,gif',
        'formato'=>'mimes:pdf, docx'
    ]);

    $file = $request->file('foto');
        if ($file != '')
        {
        $fecha = date_create();
        $img = date_timestamp_get($fecha) . $file->getClientOriginalName();
        \Storage::disk('local')->put($img, \File::get($file));
        }

        $file2 = $request->file('formato');
        if ($file2 != '')
        {
        $fecha = date_create();
        $format = date_timestamp_get($fecha) . $file2->getClientOriginalName();
        \Storage::disk('archiv')->put($format, \File::get($file2));
        }

    $banda = Bandas::find($idb);
    $banda->nombre = $request->nombre;
    $banda->id_inspo = $request->idi;
    $banda->genero = $request->genero;
    $banda->id_subgen = $request->ids;
    $banda->fecha_surgimiento = $request->surgimiento;
    $banda->fecha_lanzamiento = $request->lanzamiento;
    $banda->vocalista = $request->vocalista;
    $banda->guitarrista = $request->guitarrista;
    $banda->bajista = $request->bajista;
    $banda->baterista = $request->baterista;
    $banda->email = $request->email;
    $banda->discografia = $request->discografia;
    $banda->codigo = $request->codigo;
    if ($file != '')
        {
            $banda->foto=$img;
        }
    if ($file2 != '')
        {
            $banda->formato=$format;
        }
    $banda->activo = $request->activo;
    $banda->save();

    Session::flash('mensaje', "La información de la banda $request->nombre se ha editado correctamente");
    return redirect()->route('reportebandas');
}


    public function desactivabanda($idb)
    {
        $clave = Crypt::decrypt($idb);
        $banda = bandas::find($clave);
        $banda->activo='no';
        $banda->save();

        Session::flash('mensaje', "La banda de clave $clave ha sido desactivada");
        return redirect()->route('reportebandas');
    }

    public function activabanda($idb)
    {
        $clave = Crypt::decrypt($idb);
        $banda = bandas::find($clave);
        $banda->activo='si';
        $banda->save();

        Session::flash('mensaje', "La banda de clave $clave ha sido activada");
        return redirect()->route('reportebandas');
    }

    public function eliminabanda($idb)
    {
        $clave = Crypt::decrypt($idb);

        $borrabanda = \DB::delete("DELETE from bandas WHERE idb = $clave");

        Session::flash('mensaje', "La banda de clave $clave ha sido eliminada");
        return redirect()->route('reportebandas');
    }
}

