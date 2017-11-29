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



class BienvenidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contacto()
    {
        return view('contacto');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mail(Request $request)
    {
      Mail::send('emails.contact',$request->all(), function($msj){
        $msj->subject('Correo de contacto');
        $msj->to('jonathan.gomez@overthetop.com.mx');
      });
      Session::flash('message','Enviado correctamente');
      
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

    public function cambioempresa(Request $request){

      $usuarios = Auth::user();
      $empresa = new Empresas;


      if($usuarios->perfil <= 2){

        $user = User::findorfail($usuarios->id);
        $empresas = $empresa->where('id',$request->input('empresa'))->first();
        $user->id_compania = $request->input('empresa');
        if($request->input('empresa') == 0){
          $user->empresa = 'Sin empresa';
        }else {
          $user->empresa = $empresas->razonSocial;
        }

        $user->save();

      }

      return redirect('/bienvenida');

    }


    public function show()
    {
      $user = Auth::user();

      $userid = $user->id;

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

      return View('inicio0',compact('datauser','menuIzquierda','submenuIzquierda') );

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function grafico1()
    {
        //

        $carbon = Carbon::now(-5)->subMonth();

        $user = Auth::user();


        $today = Carbon::now(-5);


        $start = Carbon::parse($today)->startOfDay();
        $end = Carbon::parse($today)->endOfDay();

//->wherebetween('controlcompromisos.fechaFin',[$start,$end])

        $clientesInteraccion = DB::table('clientesInteraccion')
                                 ->selectRaw('DATE(clientesInteraccion.fechaInteraccion) as date,count(clientesInteraccion.comentario) as cuantos')
                                 ->where('clientesInteraccion.id_users','=',$user->id)
                                 ->where('fechaInteraccion','>=',$start->subDays(7))
                                 ->groupby('date')
                                 ->get();

    /*   [1, 34],
       [2, 25],
       [3, 19],
       [4, 34],
       [5, 32],
       [6, 44]*/
  $prueba[]= [];

  foreach($clientesInteraccion as $x => $x_value) {
  //$prueba = $prueba.'['.$x_value->nombre.','.(int)$x_value->cuantos.'],';
  $prueba[$x] =[$x_value->date,(int)$x_value->cuantos] ;
  }

  return(response()->json($prueba));



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

    public function retornardocumento(Request $request)
    {
        if ($request->isMethod('post')){

          $documentos = new Documentos;
          $documento = $documentos ->where('nombreunico',$request->nombreunico)->first();
          return response()->json(
          [
            'Documento' => $documento->nombre ,
            'Descripcion' => $documento->descripcion,
            'link' => $documento->id
          ]);
        }
    }

    public function retornarproceso(Request $request)
    {
        if ($request->isMethod('post')){

          $procesos = new Procesos;
          $documento = $documentos ->where('nombreunico',$request->nombreunico)->first();
          return response()->json(
          [
            'Documento' => $documento->nombre ,
            'Descripcion' => $documento->descripcion,
            'link' => $documento->id
          ]);
        }
    }

}
