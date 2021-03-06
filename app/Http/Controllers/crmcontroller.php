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
use Illuminate\Support\Facades\Input;


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
                                 ->join('clientesdetail','clientes.customerid','=','clientesdetail.customerid')
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
    public function buscacatalogocampaña($id)
    {
      $user = Auth::user();

      $codigos = DB::table('campanas')
                               ->join('dispositionplan','campanas.id_dispositionPlan','=','dispositionplan.id')
                               ->join('dispositionplandetail','dispositionplan.id','=','dispositionplandetail.id_dispositionPlan')
                               ->join('dispositions','dispositionplandetail.id_disposition','=','dispositions.id')
                               ->select('dispositions.id','dispositions.nombre')
                               ->where('campanas.id','=',$id)
                               ->get();

//return(dd($detalleCliente));

      return response()->json($codigos);
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

      $clientesinteraccion = DB::table('clientes')
                               ->join('clientesinteraccion','clientes.customerid','=','clientesinteraccion.customerid')
                               ->join('dispositions','clientesinteraccion.id_disposition','=','dispositions.id')
                               ->join('tipointeraccion','clientesinteraccion.id_tipoInteraccion','=','tipointeraccion.id')
                               ->join('users','clientesinteraccion.id_users','=','users.id')
                               ->select('*')
                               ->where('clientes.customerid','=',$id)
                               ->orderby('clientesinteraccion.id','desc')
                               ->get();

//return(dd($detalleCliente));

      return response()->json($clientesinteraccion);
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

        $today = Carbon::now(-5);

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
                                ->select('compromiso','id_dispositionTratamiento')
                                ->where('id','=',$request->input('dispositions'))
                                ->first();

      if ($dispcontroagenda->id_dispositionTratamiento == '1' || $dispcontroagenda->id_dispositionTratamiento == '2') {
          $cambio = 1;

          DB::table('controlcompromisos')
                      ->where('id_clientes', $request->input('customerid3'))
                      ->update(['hecho' => $cambio]);
      }

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

                   DB::table('clientesdetail')
                   ->where('id', '=', $request->input('customerid3'))
                   ->update(['ultimocodigo' => $dispcontroagenda->id_dispositionTratamiento, 'fecha' => $request->input('fechapp'), 'usuariocodigo' => $userid, 'enuso' => 0, 'usuarioenuso' => '']);
        }else {
          DB::table('clientesdetail')
          ->where('id', '=', $request->input('customerid3'))
          ->update(['ultimocodigo' => $dispcontroagenda->id_dispositionTratamiento, 'fecha' => $today, 'usuariocodigo' => $userid, 'enuso' => 0, 'usuarioenuso' => '' ]);
        }


    return  redirect('/crmindex');

    }

    public function storeinteractions2(Request $request)
    {

        $today = Carbon::now(-5);

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
                                ->select('compromiso','id_dispositionTratamiento')
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

                   DB::table('clientesdetail')
                   ->where('id', '=', $request->input('customerid3'))
                   ->update(['ultimocodigo' => $dispcontroagenda->id_dispositionTratamiento, 'fecha' => $request->input('fechapp'), 'usuariocodigo' => $userid, 'enuso' => 0, 'usuarioenuso' => '']);
        }else {
          DB::table('clientesdetail')
          ->where('id', '=', $request->input('customerid3'))
          ->update(['ultimocodigo' => $dispcontroagenda->id_dispositionTratamiento, 'fecha' => $today, 'usuariocodigo' => $userid, 'enuso' => 0, 'usuarioenuso' => '' ]);
        }


    return  redirect('/controlcompromisos');

    }

    public function storeinteractionsmarcacion(Request $request)
    {

        $today = Carbon::now(-5);

    //    return(dd($today));
        $user = Auth::user();

        $userid = $user->id;
        $customer = $request->input('customerid3');
        $idd = DB::table('clientesinteraccion')->insertGetId(
                ['customerid'=> $request->input('customerid3'),
                 'id_tipoInteraccion' => $request->input('tipoInte'),
                 'id_disposition'=>$request->input('dispositions'),
                 'comentario'=>$request->input('comentario'),
                 'id_users'=>$userid,
                 'fechaInteraccion'=> $today,
                 ]);

       $dispcontroagenda = DB::table('dispositions')
                                ->select('compromiso','id_dispositionTratamiento')
                                ->where('id','=',$request->input('dispositions'))
                                ->first();


      if ($dispcontroagenda->id_dispositionTratamiento == '1' || $dispcontroagenda->id_dispositionTratamiento == '2') {
          $cambio = 1;

          DB::table('controlcompromisos')
                      ->where('id_clientes', '=', $customer)
                      ->update(['hecho' => $cambio]);
      }




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

                  DB::table('clientesdetail')
                  ->where('id', '=', $customer)
                  ->update(['ultimocodigo' => $dispcontroagenda->id_dispositionTratamiento, 'fecha' => $request->input('fechapp'), 'usuariocodigo' => $userid, 'enuso' => 0, 'usuarioenuso' => '' ]);
       }else {
         DB::table('clientesdetail')
         ->where('id', '=', $customer)
         ->update(['ultimocodigo' => $dispcontroagenda->id_dispositionTratamiento, 'fecha' => $today, 'usuariocodigo' => $userid, 'enuso' => 0, 'usuarioenuso' => '' ]);
       }

    return  redirect('/Marcacion');

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

      $clientesinteraccion = DB::table('clientes')
                               ->join('clientesinteraccion','clientes.customerid','=','clientesinteraccion.customerid')
                               ->join('dispositions','clientesinteraccion.id_disposition','=','dispositions.id')
                               ->join('tipointeraccion','clientesinteraccion.id_tipoInteraccion','=','tipointeraccion.id')
                               ->join('users','clientesinteraccion.id_users','=','users.id')
                               ->selectRaw('dispositions.nombre,count(dispositions.nombre) as cuantos')
                               ->where('clientes.customerid','=',$id)
                               ->where('fechaInteraccion','>=',$carbon->todatestring())
                               ->groupby('dispositions.nombre')
                               ->get();

  //return(dd($clientesinteraccion));
  /*   [1, 34],
     [2, 25],
     [3, 19],
     [4, 34],
     [5, 32],
     [6, 44]*/
$prueba[]= [];

foreach($clientesinteraccion as $x => $x_value) {
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
                               ->join('clientesdetail','controlcompromisos.id_clientes','=','clientesdetail.customerid')
                               ->select('controlcompromisos.id','dispositions.nombre','controlcompromisos.comentario','controlcompromisos.fechaFin','controlcompromisos.hecho','clientesdetail.nombreCliente','clientesdetail.customerid','controlcompromisos.monto')
                              // ->wherebetween('controlcompromisos.fechaFin',[$start,$end])
                               ->where('controlcompromisos.id_users','=',$userid)
                               ->where('controlcompromisos.hecho','=',0)
                               ->orderBy('controlcompromisos.fechaFin','desc')
                               ->get();

       $tipoint = DB::table('tipointeraccion')
                            ->select('*')
                            ->orderby('id')
                            ->get();

      $dispositions = DB::table('dispositions')
                           ->select('*')
                           ->orderby('id')
                           ->get();


    return View('CRM/controlCompromisosCrm',compact('datauser','menuIzquierda','submenuIzquierda','compromisos','tipoint','dispositions') );

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

    public function compromisoscambiostatus2($id,$dispotition)
    {
        //
        $hecho = DB::table('controlcompromisos')
                           ->select('hecho')
                           ->where('id','=',$id)
                           ->first();

        $terminacion = DB::table('dispositions')
                           ->select('id_dispositionTratamiento')
                           ->where('id','=',$dispotition)
                           ->first();

        if ($terminacion->id_dispositionTratamiento == '1' || $terminacion->id_dispositionTratamiento == '2') {
            $cambio = 1;
        }else{
            $cambio = 0;
        }


        DB::table('controlcompromisos')
                    ->where('id', $id)
                    ->update(['hecho' => $cambio]);


//return(dd($compromisos));
    return(response()->json($cambio));

    }

   /* corresponden a menu crear o editar codigos */
    public function newcode(Request $request)
    {


      $user = Auth::user();

      $userid = $user->id;

      $companiaid = $user->id_compania;
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

      $dispositiontratamientos = DB::table('dispositiontratamiento')
                                    ->select('*')
                                    ->get();

      $dispositions = DB::table('dispositions')
                                    ->join('dispositiontratamiento','dispositions.id_dispositionTratamiento','=','dispositiontratamiento.id')
                                    ->select('dispositions.*','dispositiontratamiento.nombre as tratamiento')
                                    ->where('id_compania','=',$companiaid)
                                    ->get();


//return(dd($compromisos));
  return View('CRM/codigonuevo',compact('datauser','menuIzquierda','submenuIzquierda','dispositiontratamientos','dispositions') );


    }



    public function newcodestore(Request $request)
    {


      $user = Auth::user();

      $userid = $user->id;

      $companiaid = $user->id_compania;

      $today = Carbon::now(-5);

      if(isset($request->contacto)) {
        $contacto = 1;
      }
      else {
        $contacto = 0;
      }

      if(isset($request->rpc)) {
        $rpc = 1;
      }
      else {
        $rpc = 0;
      }


      if(isset($request->exito)) {
        $exito = 1;
      }
      else {
        $exito = 0;
      }

      if($request->input('dispositionTratamiento') == 2) {
        $compromiso = 1;
      }
      else{
        $compromiso = 0;
      }

      if($request->input('dispositionTratamiento') == 1) {
        $bloqueo = 1;
      }
      else{
        $bloqueo = 0;
      }

      DB::table('dispositions')->insert(
      ['nombre'=> $request->input('codigo'),
       'contacto' => $contacto,
       'rpc' => $rpc,
       'exito' => $exito,
       'id_dispositionTratamiento' => $request->input('dispositionTratamiento'),
       'id_compania' =>  $companiaid,
       'compromiso' => $compromiso,
       'bloqueo' => $bloqueo,
       'created_at' => $today,
       'updated_at' => $today,
       ]);

}


   public function newcodemostrarcodigo($id)
   {

     $user = Auth::user();

     $userid = $user->id;

     $companiaid = $user->id_compania;

     $today = Carbon::now(-5);

     $dispositions = DB::table('dispositions')
                                   ->join('dispositiontratamiento','dispositions.id_dispositionTratamiento','=','dispositiontratamiento.id')
                                   ->select('dispositions.*','dispositiontratamiento.nombre as tratamiento')
                                   ->where('id_compania','=',$companiaid)
                                   ->where('dispositions.id','=',$id)
                                   ->first();

     return(response()->json($dispositions));
   }


   public function newcodemostrartratamiento($id)
   {

     $user = Auth::user();

     $userid = $user->id;

     $companiaid = $user->id_compania;

     $today = Carbon::now(-5);

     $dispositionTratamiento = DB::table('dispositiontratamiento')
                                   ->select('dispositiontratamiento.id','dispositiontratamiento.nombre as tratamiento')
                                   ->get();

     return(response()->json($dispositionTratamiento));
   }



      public function newcodeeditacodigo(Request $request)
      {

        $user = Auth::user();

        $userid = $user->id;

        $companiaid = $user->id_compania;

        $today = Carbon::now(-5);


        if(isset($request->modalcontacto)) {
          $contacto = 1;
        }
        else {
          $contacto = 0;
        }

        if(isset($request->modalrpc)) {
          $rpc = 1;
        }
        else {
          $rpc = 0;
        }


        if(isset($request->modalexito)) {
          $exito = 1;
        }
        else {
          $exito = 0;
        }

        if($request->input('modaldispositionTratamiento') == 2) {
          $compromiso = 1;
        }
        else{
          $compromiso = 0;
        }

        if($request->input('modaldispositionTratamiento') == 1) {
          $bloqueo = 1;
        }
        else{
          $bloqueo = 0;
        }



        DB::table('dispositions')
                    ->where('id', $request->hdnid)
                    ->update([
                      'nombre'=> $request->input('codigomodal'),
                       'contacto' => $contacto,
                       'rpc' => $rpc,
                       'exito' => $exito,
                       'id_dispositionTratamiento' => $request->input('modaldispositionTratamiento'),
                       'id_compania' =>  $companiaid,
                       'compromiso' => $compromiso,
                       'bloqueo' => $bloqueo,
                       'updated_at' => $today,
                    ]);


        return(response()->json($request));
      }


/* corresponden a menu crear o editar codigos */

/* corresponden a menu crear o editar catalogo de codigos */

      public function newcatalogo(Request $request)
      {


        $user = Auth::user();

        $userid = $user->id;

        $companiaid = $user->id_compania;
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

        $dispositions = DB::table('dispositions')
                                      ->join('dispositiontratamiento','dispositions.id_dispositionTratamiento','=','dispositiontratamiento.id')
                                      ->select('dispositions.*','dispositiontratamiento.nombre as tratamiento')
                                      ->where('id_compania','=',$companiaid)
                                      ->get();

        $dispositionplans = DB::table('dispositionplan')
                                      ->select('*')
                                      ->where('id_compania','=',$companiaid)
                                      ->get();


  //return(dd($compromisos));
    return View('CRM/catalogocodigos',compact('datauser','menuIzquierda','submenuIzquierda','dispositionTratamientos','dispositions','dispositionplans') );


      }

/* corresponden a menu crear o editar catalogo de codigos */


       public function newcatalogostore(Request $request)
       {

          $user = Auth::user();

          $userid = $user->id;

          $companiaid = $user->id_compania;

          $today = Carbon::now(-5);

          $idd = DB::table('dispositionplan')->insertGetId(
                ['nombre'=> $request->input('catalogo'),
                 'descripcion' => $request->input('catalogodescripcion'),
                 'id_compania' =>  $companiaid,
                 'created_at' => $today,
                 'updated_at' => $today,
                 ]);


          $ins=$request->input('dispositionSeleccionados');


          for ($i=0;$i<count($ins);$i++)
          {

            DB::table('dispositionplandetail')->insert(
                  ['id_dispositionPlan'=> $idd,
                   'id_disposition' => $ins[$i],
                   'created_at' => $today,
                   'updated_at' => $today,
                   ]);

          }

        }



       public function newcatalogomostrardisponibles($id)
       {

          $user = Auth::user();

          $userid = $user->id;

          $companiaid = $user->id_compania;

          $today = Carbon::now(-5);

          $listadisp=DB::table('dispositions')
                         ->wherenotIn('id',function ($query) use ($id) {
                                                               $query->select('dispositions.id')->from('dispositions')
                                                                     ->Join('dispositionplandetail','dispositions.id','=','dispositionplandetail.id_disposition')
                                                                     ->where('id_dispositionPlan','=',$id);
                                                                       })
                          ->where('id_compania','=',$companiaid )
                          ->select('dispositions.id','dispositions.nombre')
                                                       ->get();


                                   return response()->json(
                                       $listadisp
                                   );

        }

        public function newcatalogomostrarseleccionados($id)
        {

           $user = Auth::user();

           $userid = $user->id;

           $companiaid = $user->id_compania;

           $today = Carbon::now(-5);

           $listadisp=DB::table('dispositions')
                           ->join('dispositionplandetail','dispositions.id','=','dispositionplandetail.id_disposition')
                           ->where('dispositions.id_compania','=',$companiaid )
                           ->where('dispositionplandetail.id_dispositionPlan','=',$id)
                           ->select('dispositions.id','dispositions.nombre')
                                                        ->get();


                                    return response()->json(
                                        $listadisp
                                    );

         }




         public function newcatalogomuestracatalogonombre($id)
         {

            $user = Auth::user();

            $userid = $user->id;

            $companiaid = $user->id_compania;

            $today = Carbon::now(-5);

            $dispplannombre =  DB::table('dispositionplan')
                                      ->where('id_compania','=',$companiaid)
                                      ->where('id','=',$id)
                                      ->select('dispositionplan.nombre','dispositionplan.descripcion')
                                      ->first();

            return response()->json(
                $dispplannombre
            );
         }



         public function newcatalogoeditacatalogo($id,Request $request)
         {

            $user = Auth::user();

            $userid = $user->id;

            $companiaid = $user->id_compania;

            $today = Carbon::now(-5);

            DB::table('dispositionplan')
                        ->where('id', $id)
                        ->update([
                          'nombre'=> $request->input('catalogomodal'),
                           'descripcion' => $request->input('catalogodescripcionmodal'),
                           'updated_at' => $today,
                        ]);


            $ins=$request->input('dispositionSeleccionadosmodal');

            DB::table('dispositionplandetail')->where('id_dispositionPlan','=',$id)->delete();

            for ($i=0;$i<count($ins);$i++)
            {

              DB::table('dispositionplandetail')->insert(
                    ['id_dispositionPlan'=> $id,
                     'id_disposition' => $ins[$i],
                     'created_at' => $today,
                     'updated_at' => $today,
                     ]);

            }


          }







        public function Marcacionshow(Request $request)
        {

         $user = Auth::user();

         $userid = $user->id;

         $today = Carbon::now(-5)->subMonth();

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

       // obligatorios en cualquier vista para el menu
       DB::table('clientesdetail')
       ->where('usuarioenuso', '=', $userid)
       ->update(['enuso' => 0]);

       $cliente = DB::table('clientes')
                      ->join('clientesdetail','clientes.customerid','=','clientesdetail.customerid')
                      ->select('*')
                      ->where('clientesdetail.ultimocodigo','=',2)
                      ->where('clientesdetail.enuso','=',0)
                      ->where('clientesdetail.fecha','<=',$today)
                      ->orderby('fecha', 'asc')
                      ->first();
                      //dd($cliente);
      if(!$cliente){
        $cliente = DB::table('clientes')
                       ->join('clientesdetail','clientes.customerid','=','clientesdetail.customerid')
                       ->select('*')
                       ->where('clientesdetail.ultimocodigo','=',3)
                       ->where('clientesdetail.enuso','=',0)
                       ->orWhere(function ($query2){
                         $query2->where('clientesdetail.enuso' ,0)
                         ->where('clientesdetail.ultimocodigo','');
                       })
                       ->orderby('fecha', 'asc')
                       ->first();
      }


      if($cliente){
        DB::table('clientesdetail')
        ->where('id', '=', $cliente->id)
        ->update(['enuso' => 1, 'usuarioenuso' => $userid]);
      }

      $tipoint = DB::table('tipointeraccion')
                             ->select('*')
                             ->orderby('id')
                             ->get();

       $dispositions = DB::table('dispositions')
                            ->select('*')
                            ->orderby('id')
                            ->get();
                      //dd($cliente);
         return View('CRM/marcacion',compact('cliente','tipoint','dispositions'));
       }


       /**
        * Show the form for creating a new resource.
        *
        * @return \Illuminate\Http\Response
        */
       public function buscatelefono($id)
       {
           //

           $user = Auth::user();

           $clientes = DB::table('clientes')
                                    ->join('clientesdetail','clientes.customerid','=','clientesdetail.customerid')
                                    ->select('clientesdetail.customerid','clientesdetail.nombreCliente')
                                    ->where( DB::raw('right( ltrim(rtrim(clientesdetail.telefono1)),10)'),$id)
                                    ->orwhere( DB::raw('right( ltrim(rtrim(clientesdetail.telefono2)),10)'),$id)
                                    ->orwhere( DB::raw('right( ltrim(rtrim(clientesdetail.telefono3)),10)'),$id)
                                    ->orwhere( DB::raw('right( ltrim(rtrim(clientesdetail.telefono4)),10)'),$id)
                                    ->groupby ('clientesdetail.customerid','clientesdetail.nombreCliente')
                                    ->get();

           return response()->json($clientes);

       }


}
