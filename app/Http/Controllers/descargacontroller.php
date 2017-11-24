<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class descargacontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function descargacodigosindex(Request $request)
    {
        //

        $user = Auth::user();

        $userid = $user->id;

        // validando si el usuario esta donde debe de estar si no se regresa a inicio
        //return(dd( "/".$request->path()));
       $validapermiso = DB::table('users')
                                  ->join('permisosSubmenu','users.id_usuariosPerfil','=','permisosSubmenu.id_perfil')
                                  ->join('submenuIzquierda','submenuIzquierda.id','=','permisosSubmenu.id_submenuIzquierda')
                                  ->where('users.id','=',$userid)
                                  ->where('submenuIzquierda.route','=',"/".$request->path())
                                  ->count();
       //return(dd($validapermiso));
       if ($validapermiso == 0) {
        // si no debe de estar aqui se regresa a la bienvenida
         return  redirect('/bienvenida');
       }

        $datauser = DB::table('users')
                            ->join('usuariosPuesto','users.id_usuariosPuesto','=','usuariosPuesto.id')
                            ->join('usuariosDetail','users.id','=','usuariosDetail.id_usuario')
                            ->select('users.id','users.usuario','users.email','users.id_usuariosPerfil','users.id_usuariosPuesto','usuariosPuesto.puesto','usuariosDetail.nombre','usuariosDetail.apellidoPaterno','usuariosDetail.apellidoMaterno')
                            ->where('users.id','=',$userid)
                            ->first();

    // obligatorios en cualquier vista para el menu
        $menuIzquierda = DB::table('permisosMenu')
                                 ->join('usuariosPerfil','usuariosPerfil.id','=','permisosMenu.id_perfil')
                                 ->join('menuIzquierda','menuIzquierda.id','=','permisosMenu.id_menuIzquierda')
                                 ->join('users','users.id_usuariosPerfil','=','usuariosPerfil.id')
                                 ->select('usuariosPerfil.perfil','menuIzquierda.opcion','menuIzquierda.icono','menuIzquierda.route','menuIzquierda.consubmenu','menuIzquierda.id')
                                 ->where('users.id','=',$userid)
                                 ->orderBy('menuIzquierda.id')
                                 ->get();

         $submenuIzquierda = DB::table('permisosMenu')
                                  ->join('permisosSubmenu','permisosSubmenu.id_permisosMenu','=','permisosMenu.id')
                                  ->join('usuariosPerfil','usuariosPerfil.id','=','permisosMenu.id_perfil')
                                  ->join('submenuIzquierda','submenuIzquierda.id','=','permisosSubmenu.id_submenuIzquierda')
                                  ->join('users','users.id_usuariosPerfil','=','usuariosPerfil.id')
                                  ->join('usuariosPuesto','users.id_usuariosPuesto','=','usuariosPuesto.id')
                                  ->select('submenuIzquierda.opcion','submenuIzquierda.route','submenuIzquierda.id_menuIzquierda')
                                  ->where('users.id','=',$userid)
                                  ->orderBy('submenuIzquierda.id')
                                  ->get();
    // obligatorios en cualquier vista para el menu


    $iniciostr =  Carbon::now(-5)->startOfMonth()->todatestring();
    $finalstr = Carbon::now(-5)->endOfMonth()->todatestring();


return View('descargadetalle/descargadetallecodigos',compact('datauser','menuIzquierda','submenuIzquierda','usuarios','iniciostr','finalstr') );

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function descargacodigosshow(Request $request)
    {
        //

        $user = Auth::user();

$inicio =   Carbon::createFromDate(substr ($request->fechainicio, 0,4 ), substr ($request->fechainicio, 5,2 ), substr ($request->fechainicio, 8,2 ))->startOfDay();
$final =   Carbon::createFromDate(substr ($request->fechafinal, 0,4 ), substr ($request->fechafinal, 5,2 ), substr ($request->fechafinal, 8,2 ))->endOfDay();


        $clientesinteraccion = DB::table('clientes')
                                 ->join('clientesinteraccion','clientes.customerid','=','clientesinteraccion.customerid')
                                 ->join('dispositions','clientesinteraccion.id_disposition','=','dispositions.id')
                                 ->join('tipointeraccion','clientesinteraccion.id_tipoInteraccion','=','tipointeraccion.id')
                                 ->join('users','clientesinteraccion.id_users','=','users.id')
                                 ->select('clientesinteraccion.fechaInteraccion','clientes.customerid','users.usuario','tipointeraccion.descripcion as tipoInteraccion','users.usuario','dispositions.nombre','clientesinteraccion.comentario','clientes.idcampana')
                                 ->whereBetween('clientesinteraccion.fechaInteraccion',[$inicio,$final])
                                 ->orderby('clientesinteraccion.id','desc')
                                 ->orderby('clientes.idcampana','desc')
                                 ->get();

        return response()->json($clientesinteraccion);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function descargacompromisosindex(Request $request)
    {
        //

        $user = Auth::user();

        $userid = $user->id;

        // validando si el usuario esta donde debe de estar si no se regresa a inicio
        //return(dd( "/".$request->path()));
       $validapermiso = DB::table('users')
                                  ->join('permisosSubmenu','users.id_usuariosPerfil','=','permisosSubmenu.id_perfil')
                                  ->join('submenuIzquierda','submenuIzquierda.id','=','permisosSubmenu.id_submenuIzquierda')
                                  ->where('users.id','=',$userid)
                                  ->where('submenuIzquierda.route','=',"/".$request->path())
                                  ->count();
       //return(dd($validapermiso));
       if ($validapermiso == 0) {
        // si no debe de estar aqui se regresa a la bienvenida
         return  redirect('/bienvenida');
       }

        $datauser = DB::table('users')
                            ->join('usuariosPuesto','users.id_usuariosPuesto','=','usuariosPuesto.id')
                            ->join('usuariosDetail','users.id','=','usuariosDetail.id_usuario')
                            ->select('users.id','users.usuario','users.email','users.id_usuariosPerfil','users.id_usuariosPuesto','usuariosPuesto.puesto','usuariosDetail.nombre','usuariosDetail.apellidoPaterno','usuariosDetail.apellidoMaterno')
                            ->where('users.id','=',$userid)
                            ->first();

    // obligatorios en cualquier vista para el menu
        $menuIzquierda = DB::table('permisosMenu')
                                 ->join('usuariosPerfil','usuariosPerfil.id','=','permisosMenu.id_perfil')
                                 ->join('menuIzquierda','menuIzquierda.id','=','permisosMenu.id_menuIzquierda')
                                 ->join('users','users.id_usuariosPerfil','=','usuariosPerfil.id')
                                 ->select('usuariosPerfil.perfil','menuIzquierda.opcion','menuIzquierda.icono','menuIzquierda.route','menuIzquierda.consubmenu','menuIzquierda.id')
                                 ->where('users.id','=',$userid)
                                 ->orderBy('menuIzquierda.id')
                                 ->get();

         $submenuIzquierda = DB::table('permisosMenu')
                                  ->join('permisosSubmenu','permisosSubmenu.id_permisosMenu','=','permisosMenu.id')
                                  ->join('usuariosPerfil','usuariosPerfil.id','=','permisosMenu.id_perfil')
                                  ->join('submenuIzquierda','submenuIzquierda.id','=','permisosSubmenu.id_submenuIzquierda')
                                  ->join('users','users.id_usuariosPerfil','=','usuariosPerfil.id')
                                  ->join('usuariosPuesto','users.id_usuariosPuesto','=','usuariosPuesto.id')
                                  ->select('submenuIzquierda.opcion','submenuIzquierda.route','submenuIzquierda.id_menuIzquierda')
                                  ->where('users.id','=',$userid)
                                  ->orderBy('submenuIzquierda.id')
                                  ->get();
    // obligatorios en cualquier vista para el menu

    $iniciostr =  Carbon::now(-5)->startOfMonth()->todatestring();
    $finalstr = Carbon::now(-5)->endOfMonth()->todatestring();


return View('descargadetalle/descargadetallecompromisos',compact('datauser','menuIzquierda','submenuIzquierda','usuarios','iniciostr','finalstr') );

    }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function descargacompromisosshow(Request $request)
    {
        //

        $user = Auth::user();

$inicio =   Carbon::createFromDate(substr ($request->fechainicio, 0,4 ), substr ($request->fechainicio, 5,2 ), substr ($request->fechainicio, 8,2 ))->startOfDay();
$final =   Carbon::createFromDate(substr ($request->fechafinal, 0,4 ), substr ($request->fechafinal, 5,2 ), substr ($request->fechafinal, 8,2 ))->endOfDay();

/*
        $clientesinteraccion = DB::table('clientes')
                                 ->join('clientesinteraccion','clientes.customerid','=','clientesinteraccion.customerid')
                                 ->join('dispositions','clientesinteraccion.id_disposition','=','dispositions.id')
                                 ->join('tipointeraccion','clientesinteraccion.id_tipoInteraccion','=','tipointeraccion.id')
                                 ->join('users','clientesinteraccion.id_users','=','users.id')
                                 ->select('clientesinteraccion.fechaInteraccion','clientes.customerid','users.usuario','tipointeraccion.descripcion as tipoInteraccion','users.usuario','dispositions.nombre','clientesinteraccion.comentario','clientes.idcampana')
                                 ->whereBetween('clientesinteraccion.fechaInteraccion',[$inicio,$final])
                                 ->orderby('clientesinteraccion.id','desc')
                                 ->orderby('clientes.idcampana','desc')
                                 ->get();
*/

           $clientesinteraccion = DB::table('controlcompromisos')
                                    ->join('dispositions','controlcompromisos.id_disposition','=','dispositions.id')
                                    ->join('clientesdetail','controlcompromisos.id_clientes','=','clientesdetail.id')
                                    ->join('clientes','clientes.customerid','=','clientesdetail.customerid')
                                    ->join('users','controlcompromisos.id_users','=','users.id')
                                    ->select('users.usuario','controlcompromisos.id','dispositions.nombre','controlcompromisos.comentario','controlcompromisos.fechaFin','controlcompromisos.hecho','clientesdetail.nombreCliente','clientesdetail.customerid as cuenta','controlcompromisos.monto','clientes.idcampana')
                                    ->wherebetween('controlcompromisos.fechaFin',[$inicio,$final])
                                    //->where('controlcompromisos.id_users','=',$userid)
                                    ->orderBy('controlcompromisos.fechaFin','desc')
                                    ->get();

        return response()->json($clientesinteraccion);

    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
