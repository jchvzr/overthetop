<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class CargaclientesController extends Controller
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

      $campana = DB::table('campanas')->where('id_compania',$user->id_compania)->get();

      return View('CRM/cargaclientes',compact('datauser','menuIzquierda','submenuIzquierda','campana'));
    }

     public function newcampaign(Request $request)
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

      $dispositionplan = DB::table('dispositionplan')->where('id_compania',$user->id_compania)->get();

      $campanas = DB::table('campanas')->where('id_compania',$user->id_compania)->get();

      return View('CRM/newcampaign',compact('datauser','menuIzquierda','submenuIzquierda','dispositionplan','campanas'));
    }



     public function newcampaignmuestracampaign($id)
     {

        $user = Auth::user();

        $userid = $user->id;

        $companiaid = $user->id_compania;


        $campana=DB::table('campanas')
                                ->join('dispositionplan','campanas.id_dispositionPlan','=','dispositionplan.id')
                                ->where('campanas.id','=',$id)
                                ->where('campanas.id_compania','=',$companiaid)
                                ->select('campanas.*','dispositionplan.nombre as dispositionplannombre')
                                ->first();

                                 return response()->json(
                                     $campana
                                 );

      }

      public function newcampaignmuestracatalogos()
      {

         $user = Auth::user();

         $userid = $user->id;

         $companiaid = $user->id_compania;


         $catalogo=DB::table('dispositionplan')
                                 ->where('id_compania','=',$companiaid)
                                 ->select('*')
                                 ->get();

                                  return response()->json(
                                      $catalogo
                                  );

       }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subirclientes(Request $request)
    {
      $user = Auth::user();
      $file1 = $request->file('archivo');
      $campana = $request->input('campaña');
      $usercampana = $user->id_compania;

    //  ini_set ('auto_detect_line_endings', true);

    $shouldQueue =false;
      Excel::filter('chunk')->load($file1)->chunk(250, function($results) use ($campana,$usercampana)
      {

              foreach($results as $row)
              {
                DB::table('clientes')->insert(['customerid' => $row->customerid, 'idcampana' => $campana, 'id_compania' => $usercampana]);
                DB::table('clientesdetail')->insert($row->toArray());

              }
      },$shouldQueue);
/*
      $id = DB::table('campanas')->insertGetId(['nombre' => $campana]);

      Excel::load($file1, function($reader) use ($id){
        $result = $reader->all();
        $result2 = $reader->select(array('customerid', $id))->get();
        DB::table('clientesdetail')->insert($result->toArray());
        DB::table('clientes')->insert($result2->toArray());
      });
*/
      return redirect('cargaclientes');
    }

    public function newcampaignup(Request $request)
    {
      $user = Auth::user();
      $usercampana = $user->id_compania;

      DB::table('campanas')->insert(
        ['nombre' => $request->input('campana'),
         'descripcion' => $request->input('descripcion'),
         'id_compania' => $user->id_compania,
         'id_dispositionplan' => $request->input('disposition')]);

      return redirect('newcampaign');
    }


    public function newcampaigneditcampaign(Request $request)
    {

       $user = Auth::user();

       $userid = $user->id;

       $companiaid = $user->id_compania;

       $today = Carbon::now(-5);

       DB::table('campanas')
                   ->where('id', $request->input('hdnid'))
                   ->update([
                     'nombre'=> $request->input('campanadescripcionmodal'),
                      'descripcion' => $request->input('campanadescripcionmodal'),
                      'id_dispositionPlan' => $request->input('dispositionplanmodal1'),
                      'updated_at' => $today,
                   ]);

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
