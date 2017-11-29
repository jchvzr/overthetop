<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\crearUser;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mail;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Validation\Validator;

class admintoolcontroller extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newUser(Request $request)
    {
        //
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

    $perfilesSeguridad = DB::table('usuariosPerfil')
                        ->select('usuariosPerfil.id','usuariosPerfil.perfil')
                        ->orderby('id','desc')
                        ->get();

    $usuariosPuesto = DB::table('usuariosPuesto')
                        ->select('usuariosPuesto.id','usuariosPuesto.puesto')
                        ->orderby('id','desc')
                        ->get();


        return View('AdminTool/crearUser',compact('datauser','menuIzquierda','submenuIzquierda','perfilesSeguridad','usuariosPuesto') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function userStore(Request $request)
    {

      $user = Auth::user();

     $userid = $user->id;

     $usu = new User;

     $today = Carbon::now(-5);

      $v = \Validator::make($request->all(), [
          'usuario'  => 'required',
          'email'    => 'required|email|unique:users',
          'password'  => 'required',
          'confirm'  => 'required|same:password',
      ]);

//return(dd($v->errors()));

     if ($v->fails())
      {

        return redirect()->back()->withInput()->withErrors($v->errors());

      }

  $idd = DB::table('users')->insertGetId(
          ['usuario'=> $request->input('usuario'),
           'email' => $request->input('email'),
           'password' =>   bcrypt($request->input('password')),
           'habilitado' => 1,
           'id_usuariosPerfil' => $request->input('perfilSeguridad'),
           'id_usuariosPuesto' => $request->input('puesto'),
           'created_at' => $today,
           'updated_at' => $today,
           ]);

  $idd2 = DB::table('usuariosdetail')->insertGetId(
          ['nombre'=> $request->input('usuario'),
           'apellidoPaterno'=> '',
           'apellidoMaterno'=> '',
           'domicilioCalle'=> '',
           'domicilioColonia' => '',
           'domicilioCiudad' => '',
           'domicilioCP' =>'',
           'telefonoCasa' => '',
           'telefonoCelular' => '',
           'fechaNacimiento' => $today,
           'sexo' => '',
           'curp' => '',
           'rfc' => '',
           'nss' => '',
           'fechaIngreso' => $today,
           'id_usuario' => $idd,
           'created_at' => $today,
           'updated_at' => $today,
          ]);


  Session::flash('flash_message', 'Se guardo el usuario: '.$request->input('usuario').'Es necesario completar el perfil del mismo en el HRM');

  return redirect('/newuser');
  //return response()->json("Usuario guardado");
      }


      /**
       * Show the form for creating a new resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function newPerfil(Request $request)
      {
        //
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

        $menuIzquierdaTodo = DB::table('menuIzquierda')
                                  ->select('*')
                                  ->orderby('id')
                                  ->get();

        $submenuIzquierdaTodo = DB::table('submenuIzquierda')
                                  ->join('menuIzquierda','submenuIzquierda.id_menuIzquierda','=','menuIzquierda.id')
                                  ->select('submenuIzquierda.*','menuIzquierda.opcion as opc')
                                  ->orderby('submenuIzquierda.id')
                                  ->get();

//return(dd($submenuIzquierdaTodo));
        return View('AdminTool/crearPerfilSeguridad',compact('datauser','menuIzquierda','submenuIzquierda','menuIzquierdaTodo','submenuIzquierdaTodo') );
      }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perfilstore(Request $request)
    {
  //    return(dd($request));

      $v = \Validator::make($request->all(), [
          'perfil'    => 'required|unique:usuariosperfil',
      ]);

     if ($v->fails())
      {

      return redirect()->back()->withInput()->withErrors($v->errors());
      }

  $idperfil = DB::table('usuariosperfil')->insertGetId(
              ['perfil'=> $request->input('perfil'),
               ]);

//return(dd($request));

  $seleccionmenu=$request->input('menuizquierda');

  $seleccionsubmenu=$request->input('submenuizquierda');

               for ($i=0;$i<count($seleccionmenu);$i++)
               {

                 $id_permisosMenu = DB::table('permisosMenu')->insertGetId(
                                    ['id_menuIzquierda'=> $seleccionmenu[$i],
                                      'id_perfil' => $idperfil
                                    ]);

                                    for ($o=0;$o<count($seleccionsubmenu);$o++)
                                    {

                                      $submenuIzquierdaTodo = DB::table('submenuIzquierda')
                                                                ->join('menuIzquierda','submenuIzquierda.id_menuIzquierda','=','menuIzquierda.id')
                                                                ->select('submenuIzquierda.id_menuIzquierda')
                                                                ->where('submenuIzquierda.id','=', $seleccionsubmenu[$o])
                                                                ->first();
                                      if ($seleccionmenu[$i] ==$submenuIzquierdaTodo->id_menuIzquierda)
                                      {

                                      $id_permisosSubmenu = DB::table('permisosSubmenu')->insertGetId(
                                                         ['id_submenuIzquierda'=> $seleccionsubmenu[$o],
                                                           'id_perfil' => $idperfil,
                                                           'id_permisosMenu' => $id_permisosMenu
                                                         ]);
                                       }
                                    }
               }

return redirect('/nuevoperfilseguridad');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editperfilseguridadshow(Request $request)
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

        $menuIzquierdaTodo = DB::table('menuIzquierda')
                                  ->select('*')
                                  ->orderby('id')
                                  ->get();

        $submenuIzquierdaTodo = DB::table('submenuIzquierda')
                                  ->join('menuIzquierda','submenuIzquierda.id_menuIzquierda','=','menuIzquierda.id')
                                  ->select('submenuIzquierda.*','menuIzquierda.opcion as opc')
                                  ->orderby('submenuIzquierda.id')
                                  ->get();

        $perfiles = DB::table('submenuIzquierda')
                                  ->join('menuIzquierda','submenuIzquierda.id_menuIzquierda','=','menuIzquierda.id')
                                  ->select('submenuIzquierda.*','menuIzquierda.opcion as opc')
                                  ->orderby('submenuIzquierda.id')
                                  ->get();

        $perfilesSeguridad = DB::table('usuariosPerfil')
                            ->select('usuariosPerfil.id','usuariosPerfil.perfil')
                            ->orderby('id','desc')
                            ->get();


  return View('AdminTool/editPerfilSeguridad',compact('datauser','menuIzquierda','submenuIzquierda','menuIzquierdaTodo','submenuIzquierdaTodo','perfilesSeguridad') );


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editperfilseguridadchecks($id)
    {
        //
        $user = Auth::user();

        $userid = $user->id;

        $permisosMenu =  DB::table('permisosMenu')
                            ->select('*')
                            ->where('id_perfil','=',$id)
                            ->get();


        return(response()->json($permisosMenu));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editperfilseguridadcheckssub($id)
    {
        //
        $user = Auth::user();

        $userid = $user->id;

        $permisosSubmenu =  DB::table('permisosSubmenu')
                            ->select('*')
                            ->where('id_perfil','=',$id)
                            ->get();


        return(response()->json($permisosSubmenu));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perfilstoreedit(Request $request)
    {
        //
        $user = Auth::user();

        $userid = $user->id;

        $idperfil = $request->perfilSeguridad;


        DB::table('permisosMenu')->where('id_perfil','=',$idperfil)->delete();

        DB::table('permisosSubmenu')->where('id_perfil','=',$idperfil)->delete();


        $seleccionmenu=$request->input('menuizquierda');

        $seleccionsubmenu=$request->input('submenuizquierda');

                     for ($i=0;$i<count($seleccionmenu);$i++)
                     {

                       $id_permisosMenu = DB::table('permisosMenu')->insertGetId(
                                          ['id_menuIzquierda'=> $seleccionmenu[$i],
                                            'id_perfil' => $idperfil
                                          ]);

                                          for ($o=0;$o<count($seleccionsubmenu);$o++)
                                          {

                                            $submenuIzquierdaTodo = DB::table('submenuIzquierda')
                                                                      ->join('menuIzquierda','submenuIzquierda.id_menuIzquierda','=','menuIzquierda.id')
                                                                      ->select('submenuIzquierda.id_menuIzquierda')
                                                                      ->where('submenuIzquierda.id','=', $seleccionsubmenu[$o])
                                                                      ->first();
                                            if ($seleccionmenu[$i] ==$submenuIzquierdaTodo->id_menuIzquierda)
                                            {

                                            $id_permisosSubmenu = DB::table('permisosSubmenu')->insertGetId(
                                                               ['id_submenuIzquierda'=> $seleccionsubmenu[$o],
                                                                 'id_perfil' => $idperfil,
                                                                 'id_permisosMenu' => $id_permisosMenu
                                                               ]);
                                             }
                                          }
                     }

      return redirect('/editperfilseguridadshow');


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newcompany(Request $request)
    {
        //
        //
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

         $compañias = DB::table('companias')->get();

          return view('AdminTool/createcompany',compact('datauser','menuIzquierda','submenuIzquierda','menuIzquierdaTodo','submenuIzquierdaTodo','perfilesSeguridad','compañias'));

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newcompanymuestracompany($id)
    {

        $user = Auth::user();

        $userid = $user->id;

        $compañias = DB::table('companias')->where('id','=',$id)->first();

        return(response()->json($compañias));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function companystore(Request $request)
    {

        $user = Auth::user();

        $userid = $user->id;

        $v = \Validator::make($request->all(), [
          'nombre'       => 'required|max:255',
          'email'  => 'required|max:255|email_address',
          'domicilio'  => 'required|max:255',
          'telefono'  => 'required|max:255',
          'status'  => 'required|max:255',
          'archivo'  => 'required|file|image',
        ]);

  //return(dd($v->errors()));

       if ($v->fails())
        {

          return redirect()->back()->withInput()->withErrors($v->errors());

        }

        DB::table('companias')->insertGetId(
                ['nombre'=> $request->input('nombre'),
                 'email' => $request->input('email'),
                 'password' =>   bcrypt($request->input('password')),
                 'habilitado' => 1,
                 'id_usuariosPerfil' => $request->input('perfilSeguridad'),
                 'id_usuariosPuesto' => $request->input('puesto'),
                 'created_at' => $today,
                 'updated_at' => $today,
                 ]);



        DB::table('users')->insertGetId(
                ['usuario'=> $request->input('usuario'),
                 'email' => $request->input('email'),
                 'password' =>   bcrypt($request->input('password')),
                 'habilitado' => 1,
                 'id_usuariosPerfil' => $request->input('perfilSeguridad'),
                 'id_usuariosPuesto' => $request->input('puesto'),
                 'created_at' => $today,
                 'updated_at' => $today,
                 ]);




    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es requerido',

        ];
    }


}
