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



use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;



class hrmcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newprofileuser()
    {
        //

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

        $usuarios = DB::table('users')
                                   ->select('users.id','users.email')
                                   ->orderby('users.email')
                                   ->get();


        return View('HRM/crearPerfilUsuario',compact('datauser','menuIzquierda','submenuIzquierda','usuarios') );

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showprofileuser()
    {
        //

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

            $usuarios = DB::table('users')
                                       ->select('users.id','users.email')
                                       ->orderby('users.email')
                                       ->get();

                return View('HRM/mostrarPerfilUsuario',compact('datauser','menuIzquierda','submenuIzquierda','usuarios') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showprofileuserid($id)
    {
        //
        $user = Auth::user();

        $userid = $user->id;

        $userdetail = DB::table('usuariosdetail')
                                ->where('id_usuario','=',$id)
                                ->first();

        return response()->json($userdetail);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function guardaprofileuser(request $request)
    {
        //
        $user = Auth::user();

        $userid = $user->id;

        $id = $request->input('id_usuario');


        DB::table('usuariosDetail')->where('id', $id)
                                   ->update(
                                           ['nombre'=> $request->input('nombre'),
                                            'apellidoPaterno' => $request->input('apellidoPaterno'),
                                            'apellidoMaterno' =>   $request->input('apellidoMaterno'),
                                            'sexo' => $request->input('sexo'),
                                            'fechaNacimiento' => $request->input('fechaNacimiento'),
                                            'fechaIngreso' => $request->input('fechaIngreso'),
                                            'domicilioCalle' => $request->input('domicilioCalle'),
                                            'domicilioColonia' => $request->input('domicilioColonia'),
                                            'domicilioCiudad' => $request->input('domicilioCiudad'),
                                            'domicilioCP' => $request->input('domicilioCP'),
                                            'telefonoCasa' => $request->input('telefonoCasa'),
                                            'telefonoCelular' => $request->input('telefonoCelular'),
                                            'curp' => $request->input('curp'),
                                            'rfc' => $request->input('rfc'),
                                            'nss' => $request->input('nss'),
                                            ]);

    return  redirect('/newprofileuser');

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
