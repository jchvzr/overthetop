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
class dashboard extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
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
                                   ->join('clientesdetail','controlcompromisos.id_clientes','=','clientesdetail.id')
                                   ->select('controlcompromisos.id','dispositions.nombre','controlcompromisos.comentario','controlcompromisos.fechaFin','controlcompromisos.hecho','clientesdetail.nombreCliente','clientesdetail.customerid','controlcompromisos.monto')
                                   ->wherebetween('controlcompromisos.fechaFin',[$start,$end])
                                   ->where('controlcompromisos.id_users','=',$userid)
                                   //->where('controlcompromisos.hecho','=',0)
                                   ->orderBy('controlcompromisos.fechaFin','asc')
                                   ->get();

          $countcompro = count($compromisos);

          $sum = DB::table('controlcompromisos')
                                   ->join('dispositions','controlcompromisos.id_disposition','=','dispositions.id')
                                   ->join('clientesdetail','controlcompromisos.id_clientes','=','clientesdetail.id')
                                   ->select('controlcompromisos.id','dispositions.nombre','controlcompromisos.comentario','controlcompromisos.fechaFin','controlcompromisos.hecho','clientesdetail.nombreCliente','clientesdetail.customerid','controlcompromisos.monto')
                                   ->wherebetween('controlcompromisos.fechaFin',[$start,$end])
                                   ->where('controlcompromisos.id_users','=',$userid)
                                   //->where('controlcompromisos.hecho','=',0)
                                   ->sum('monto');




    /*
           $tophm = DB::table('controlcompromisos')
                                    ->join('dispositions','controlcompromisos.id_disposition','=','dispositions.id')
                                    ->join('clientesdetail','controlcompromisos.id_clientes','=','clientesdetail.id')
                                    ->select('controlcompromisos.id','dispositions.nombre','controlcompromisos.comentario','controlcompromisos.fechaFin','controlcompromisos.hecho','clientesdetail.nombreCliente','clientesdetail.customerid','controlcompromisos.monto')
                                    ->wherebetween('controlcompromisos.fechaFin',[$start,$end])
                                    ->where('controlcompromisos.id_users','=',$userid)
                                    ->where('controlcompromisos.hecho','=',0)
                                    ->sum('monto');
    */



          $end = $end->addDays(7);


          $compromisosw = DB::table('controlcompromisos')
                                   ->join('dispositions','controlcompromisos.id_disposition','=','dispositions.id')
                                   ->join('clientesdetail','controlcompromisos.id_clientes','=','clientesdetail.id')
                                   ->select('controlcompromisos.id','dispositions.nombre','controlcompromisos.comentario','controlcompromisos.fechaFin','controlcompromisos.hecho','clientesdetail.nombreCliente','clientesdetail.customerid','controlcompromisos.monto')
                                   ->wherebetween('controlcompromisos.fechaFin',[$start,$end])
                                   ->where('controlcompromisos.id_users','=',$userid)
                                   //->where('controlcompromisos.hecho','=',0)
                                   ->orderBy('controlcompromisos.fechaFin','asc')
                                   ->get();

          $countcomprow = count($compromisosw);

          $sumw = DB::table('controlcompromisos')
                                   ->join('dispositions','controlcompromisos.id_disposition','=','dispositions.id')
                                   ->join('clientesdetail','controlcompromisos.id_clientes','=','clientesdetail.id')
                                   ->select('controlcompromisos.id','dispositions.nombre','controlcompromisos.comentario','controlcompromisos.fechaFin','controlcompromisos.hecho','clientesdetail.nombreCliente','clientesdetail.customerid','controlcompromisos.monto')
                                   ->wherebetween('controlcompromisos.fechaFin',[$start,$end])
                                   ->where('controlcompromisos.id_users','=',$userid)
                                   //->where('controlcompromisos.hecho','=',0)
                                   ->sum('monto');


           $end = $end->subDays(7);


           $clientesinteraccion = DB::table('clientes')
                                    ->join('clientesinteraccion','clientes.customerid','=','clientesinteraccion.customerid')
                                    ->join('dispositions','clientesinteraccion.id_disposition','=','dispositions.id')
                                    ->join('tipointeraccion','clientesinteraccion.id_tipoInteraccion','=','tipointeraccion.id')
                                    ->join('users','clientesinteraccion.id_users','=','users.id')
                                    ->select(DB::raw('count(*) as codigos, sum(contacto) as contacto, sum(rpc) as rpc, sum(exito) as exito'))
                                    ->wherebetween('clientesinteraccion.fechaInteraccion',[$start,$end])
                                    ->where('clientesinteraccion.id_users','=',$userid)
                                    ->first();

    //return(dd($clientesinteraccion));

          $inicio = $start->subDays(7)->todatestring();
          $final = $end->todatestring();


          return View('/dashboard/dashboard',compact('datauser','menuIzquierda','submenuIzquierda','compromisos','countcompro','sum','compromisosw','countcomprow','sumw','clientesinteraccion','inicio','final') );



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
