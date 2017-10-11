<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mail;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use Illuminate\Support\Facades\DB;
use App\Models\User;




class crmcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

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

                $tipoint = DB::table('tipointeraccion')
                                     ->select('*')
                                     ->orderby('id')
                                     ->get();

               $dispositions = DB::table('dispositions')
                                    ->select('*')
                                    ->orderby('id')
                                    ->get();

        // obligatorios en cualquier vista para el menu
        return View('CRM/iniciocrm',compact('datauser','menuIzquierda','submenuIzquierda','tipoint','dispositions') );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function buscacliente($id)
    {
        //

        $user = Auth::user();

        $detalleCliente = DB::table('clientes')
                                 ->join('clientesDetail','clientes.customerid','=','clientesDetail.customerid')
                                 ->select('*')
                                 ->where('clientes.customerid','=',$id)
                                 ->first();

//return(dd($detalleCliente));

        return response()->json($detalleCliente);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function buscaclienteinteraccion($id)
    {
      $user = Auth::user();

      $clientesInteraccion = DB::table('clientes')
                               ->join('clientesInteraccion','clientes.customerid','=','clientesInteraccion.customerid')
                               ->join('dispositions','clientesInteraccion.id_disposition','=','dispositions.id')
                               ->join('tipointeraccion','clientesInteraccion.id_tipoInteraccion','=','tipointeraccion.id')
                               ->join('users','clientesInteraccion.id_users','=','users.id')
                               ->select('*')
                               ->where('clientes.customerid','=',$id)
                               ->orderby('clientesInteraccion.id','desc')
                               ->get();

//return(dd($detalleCliente));

      return response()->json($clientesInteraccion);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function liberadiv($id)
    {
        //
     $user = Auth::user();

     $dispcompromiso = DB::table('dispositions')
                            ->select('*')
                            ->where('id','=',$id)
                            ->first();

     return response()->json($dispcompromiso);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeinteractions(Request $request)
    {
        //
        $today = Carbon::now(-5)->subMonth();

    //    return(dd($today));
        $user = Auth::user();

        $userid = $user->id;

        $idd = DB::table('clientesinteraccion')->insertGetId(
                ['customerid'=> $request->input('customerid3'),
                 'id_tipoInteraccion' => $request->input('tipoInte'),
                 'id_disposition'=>$request->input('dispositions'),
                 'comentario'=>$request->input('comentario'),
                 'id_users'=>$userid,
                 'fechaInteraccion'=> $today,
                 ]);

       $dispcontroagenda = DB::table('dispositions')
                                ->select('compromiso')
                                ->where('id','=',$request->input('dispositions'))
                                ->first();



       if (($dispcontroagenda->compromiso) == 1)
       {


                 DB::table('controlcompromisos')->insert(
                 ['id_clientes'=> $request->input('customerid3'),
                  'fechaInicio' => $today,
                  'fechaFin'=> $request->input('fechapp'),
                  'comentario'=>$request->input('comentario'),
                  'monto'=>$request->input('monto'),
                  'id_disposition'=>$request->input('dispositions'),
                  'hecho'=>0,
                  'id_users'=>$userid,
                  ]);

       }


    return  redirect('/crmindex');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function buscaclienteinteraccionresumen($id)
    {
      $carbon = Carbon::now(-5)->subMonth();

      $user = Auth::user();

      $clientesInteraccion = DB::table('clientes')
                               ->join('clientesInteraccion','clientes.customerid','=','clientesInteraccion.customerid')
                               ->join('dispositions','clientesInteraccion.id_disposition','=','dispositions.id')
                               ->join('tipointeraccion','clientesInteraccion.id_tipoInteraccion','=','tipointeraccion.id')
                               ->join('users','clientesInteraccion.id_users','=','users.id')
                               ->selectRaw('dispositions.nombre,count(dispositions.nombre) as cuantos')
                               ->where('clientes.customerid','=',$id)
                               ->where('fechaInteraccion','>=',$carbon->todatestring())
                               ->groupby('dispositions.nombre')
                               ->get();

  //return(dd($clientesInteraccion));
  /*   [1, 34],
     [2, 25],
     [3, 19],
     [4, 34],
     [5, 32],
     [6, 44]*/
$prueba[]= [];

foreach($clientesInteraccion as $x => $x_value) {
//$prueba = $prueba.'['.$x_value->nombre.','.(int)$x_value->cuantos.'],';
$prueba[$x] =[$x_value->nombre,(int)$x_value->cuantos] ;
}

return(response()->json($prueba));



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function controlcompromisosindex(Request $request)
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

      $today = Carbon::now(-5);


      $start = Carbon::parse($today)->startOfDay();
      $end = Carbon::parse($today)->endOfDay();

      $compromisos = DB::table('controlcompromisos')
                               ->join('dispositions','controlcompromisos.id_disposition','=','dispositions.id')
                               ->join('clientesDetail','controlcompromisos.id_clientes','=','clientesDetail.customerid')
                               ->select('controlcompromisos.id','dispositions.nombre','controlcompromisos.comentario','controlcompromisos.fechaFin','controlcompromisos.hecho','clientesDetail.nombreCliente','clientesDetail.customerid','controlcompromisos.monto')
                               ->wherebetween('controlcompromisos.fechaFin',[$start,$end])
                               ->where('controlcompromisos.id_users','=',$userid)
                               ->orderBy('controlcompromisos.fechaFin','desc')
                               ->get();

//return(dd($compromisos));
    return View('CRM/controlCompromisosCrm',compact('datauser','menuIzquierda','submenuIzquierda','compromisos') );

    }

    public function compromisoscambiostatus($id)
    {
        //
        $hecho = DB::table('controlcompromisos')
                           ->select('hecho')
                           ->where('id','=',$id)
                           ->first();

        if ( ($hecho->hecho) == 1)
        {
          $cambio = 0;
        }
        else {
          $cambio = 1;
        }

        DB::table('controlcompromisos')
                    ->where('id', $id)
                    ->update(['hecho' => $cambio]);


//return(dd($compromisos));
    return(response()->json($cambio));

    }


    public function newcode(Request $request)
    {


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
                          ->join('usuariosPerfil','users.id_usuariosPerfil','=','usuariosPerfil.id')
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

      $dispositionTratamientos = DB::table('dispositionTratamiento')
                                    ->select('*')
                                    ->get();


//return(dd($compromisos));
  return View('CRM/codigonuevo',compact('datauser','menuIzquierda','submenuIzquierda','dispositionTratamientos') );


    }


}