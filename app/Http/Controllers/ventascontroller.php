<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\clientes;
use App\Models\ventas;
use App\Models\conciertos;
use App\Models\estadios;
use App\Models\secciones;
use App\Models\ventasdetalles;
use App\Models\bandas;
use Session;

class VentasController extends Controller
{
    public function crearventa()
    {
        if(Session::get('sesionidu'))
        {
        $ventas = \DB::select("SELECT * FROM ventas ORDER BY idven DESC LIMIT 1");

        $cuantos = count($ventas);
        $iddventa = ($cuantos == 0) ? 1 : ($ventas[0]->idven + 1);

        $idu = Session::get('sesionidu');
        $nombreusuario = Session::get('sesionname');
        $fecha = date('Y-m-j');
        $clientes = \DB::select("SELECT * FROM clientes ORDER BY nombre ASC");
        $bandas = \DB::select("SELECT * FROM bandas ORDER BY nombre ASC");

        return view('ventas.nuevaventa')
            ->with('iddventa', $iddventa)
            ->with('idu', $idu)
            ->with('nombreusuario', $nombreusuario)
            ->with('fecha', $fecha)
            ->with('clientes', $clientes)
            ->with('bandas', $bandas);
        }
        else
        {
            Session::flash('mensaje', "Es necesario iniciar sesión");
            return view('login');
        }
    }

    public function infocliente(Request $request)
    {
        $cliente = \DB::select("SELECT * FROM clientes WHERE idcli = ?", [$request->idcli]);
        return view('ventas.infocliente')->with('cliente', $cliente[0]);
    }

    public function conciertos(Request $request)
{
    $idb = $request->idb;
    $conciertos = \DB::select("SELECT * FROM conciertos WHERE idb = ?", [$idb]);
    $secciones = \DB::select("SELECT * FROM secciones");

    if(count($conciertos) > 0) {
        return view('ventas.conciertos')
            ->with('conciertos', $conciertos)
            ->with('secciones', $secciones);
    } else {
        return response()->json(['error' => 'No hay conciertos para esta banda'], 404);
    }
}

    public function secciondetalle(Request $request)
    {
        $idsec = $request->idsec;
        $seccion = \DB::table('secciones')->where('idsec', $idsec)->first();

        if ($seccion) {
            return view('ventas.boletosinfo')
                ->with('disponibilidad', $seccion->disponibilidad)
                ->with('costo', $seccion->costo);
        } else {
            return response()->json(['error' => 'No se encontró la sección'], 404);
        }
    }

    public function codigoc(Request $request)
    {
        $cupones = \DB::select("SELECT * FROM cupones");
        return view('ventas.codigoc')->with('cupones', $cupones);
    }

    public function verificarCodigoCupon(Request $request)
    {
        $codigo = $request->codigo;
        $cupon = \DB::table('cupones')->where('codigo', $codigo)->first();

        if ($cupon) {
            return response()->json(['porcentaje' => $cupon->porcentaje]);
        } else {
            return response()->json(['error' => 'Código de cupón no válido'], 404);
        }
    }
    public function agregaelemento(Request $request)
    {
        $venta = \DB::table('ventas')->where('idven', $request->idven)->first();

        if (!$venta) {
            $venta = new ventas;
            $venta->idven = $request->idven;
            $venta->idu = $request->idu;
            $venta->idcli = $request->idcli;
            $venta->idcon = $request->idcon;
            $venta->save();
        }

        $ventasdetalles = new ventasdetalles;
        $ventasdetalles->idven = $request->idven;
        $ventasdetalles->idcon = $request->idcon;
        $ventasdetalles->idsec = $request->idsec;
        $ventasdetalles->idu = $request->idu;
        $ventasdetalles->cantidad = $request->cantidad;
        $ventasdetalles->subtotal = $request->subtotal;
        $ventasdetalles->total = $request->total;
        $ventasdetalles->save();

        $carritodetalle = \DB::select("
            SELECT vd.idvd, vd.idven, b.foto, b.idb, b.nombre AS banda, sec.nombre AS seccion, c.fecha, 
            CONCAT('$ ', FORMAT(vd.subtotal, 2)) AS subtotal, CONCAT('$ ', FORMAT(vd.total, 2)) AS total
            FROM ventasdetalles AS vd
            INNER JOIN conciertos AS c ON vd.idcon = c.idcon
            INNER JOIN bandas AS b ON c.idb = b.idb
            INNER JOIN estadios AS e ON c.ide=e.ide
            INNER JOIN secciones AS sec ON vd.idsec=sec.idsec
            WHERE vd.idven = ?
        ", [$request->idven]);

        return view('ventas.carrito', ['carritodetalle' => $carritodetalle])->render();
    }

    public function borraboleto(Request $request)
    {
        $idvd = $request->input('idvd');
        $idven = $request->input('idven');

        $detalle = ventasdetalles::where('idvd', $idvd)
            ->where('idven', $idven)
            ->first();

        if ($detalle) {
            $detalle->delete();
        }


        $carritodetalle = \DB::select("
            SELECT vd.idvd, vd.idven, b.foto, b.idb, b.nombre AS banda, sec.nombre AS seccion, c.fecha, 
            CONCAT('$ ', FORMAT(vd.subtotal, 2)) AS subtotal, CONCAT('$ ', FORMAT(vd.total, 2)) AS total
            FROM ventasdetalles AS vd
            INNER JOIN conciertos AS c ON vd.idcon = c.idcon
            INNER JOIN bandas AS b ON c.idb = b.idb
            INNER JOIN estadios AS e ON c.ide=e.ide
            INNER JOIN secciones AS sec ON vd.idsec=sec.idsec
            WHERE vd.idven = ?
        ", [$idven]);
        return response()->json(['html' => view('ventas.carrito', ['carritodetalle' => $carritodetalle])->render()]);
    }

    public function editaventa($idven)
    {
        $venta = \DB::select("SELECT v.*, u.nombre, u.apellido, c.nombre AS cliente_nombre, b.idb, b.nombre AS banda_nombre, con.idcon, con.fecha, sec.idsec
                    FROM ventas v
                    INNER JOIN clientes c ON v.idcli = c.idcli
                    INNER JOIN usuarios AS u ON v.idu= u.idu
                    INNER JOIN ventasdetalles as vd on vd.idven=v.idven
                    INNER JOIN secciones as sec on vd.idsec = sec.idsec
                    INNER JOIN conciertos AS con ON v.idcon = con.idcon
                    INNER JOIN bandas b ON con.idb = b.idb
                    WHERE v.idven = ?", [$idven]);

        if (!$venta) {
            return redirect()->route('reporteventas')->with('error', 'Venta no encontrada.');
        }

        $venta = $venta[0];
        $clientes = \DB::select("SELECT * FROM clientes ORDER BY nombre ASC");
        $bandas = \DB::select("SELECT * FROM bandas ORDER BY nombre ASC");
        $conciertos = \DB::select("SELECT * FROM conciertos WHERE idb = ?", [$venta->idb]);
        $secciones = \DB::select("SELECT * FROM secciones");
        $carritodetalle = \DB::select("
            SELECT vd.idvd, vd.idven, b.foto, b.idb, b.nombre AS banda, sec.nombre AS seccion, c.fecha, 
            CONCAT('$ ', FORMAT(vd.subtotal, 2)) AS subtotal, CONCAT('$ ', FORMAT(vd.total, 2)) AS total
            FROM ventasdetalles AS vd
            INNER JOIN conciertos AS c ON vd.idcon = c.idcon
            INNER JOIN bandas AS b ON c.idb = b.idb
            INNER JOIN estadios AS e ON c.ide=e.ide
            INNER JOIN secciones AS sec ON vd.idsec=sec.idsec
            WHERE vd.idven = ?
        ", [$idven]);

        return view('ventas.editaventa', compact('venta', 'clientes', 'bandas', 'conciertos', 'secciones', 'carritodetalle'));
    }

    public function actualizarventa(Request $request, $idven)
    {

        $validatedData = $request->validate([
            'idcli' => 'required|exists:clientes,idcli',
            'banda' => 'required|exists:bandas,idb',
        ]);


        \DB::table('ventas')
            ->where('idven', $idven)
            ->update([
                'idcli' => $request->input('idcli'),
                'idb' => $request->input('banda'),
                
            ]);

        return redirect()->route('reporteventas')->with('success', 'Venta actualizada correctamente.');
    }

    public function reporteventas()
    {
        if(Session::get('sesionidu'))
        {
            $todasventas = \DB::select("SELECT vd.idven, DATE(vd.created_at) AS fecha, c.idb AS idbanda, vd.cantidad, b.nombre as banda, 
            CONCAT('$', FORMAT(vd.total, 2)) AS total
            FROM ventasdetalles AS vd
            INNER JOIN conciertos AS c ON vd.idcon = c.idcon
            INNER JOIN bandas AS b ON c.idb = b.idb");


            return view('ventas.reporteventas')->with('todasventas', $todasventas);
        }
        else
        {
            Session::flash('mensaje', "Es necesario iniciar sesión");
            return view('login');
        }
    }

}
