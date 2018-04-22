<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\encuestadesatisfaccion;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class encuesta extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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

        $user = Auth::user();
        $customerid = $request->input('customer_id');
        $contestados = new encuestadesatisfaccion;
        $contestado = $contestados->where('customer_id','=',$customerid)->count();

       if ($contestado == 0)
       {
        $encuesta = new encuestadesatisfaccion;
        $encuesta->customer_id = $request->input('customer_id');
        $encuesta->p1 = $request->input('p1');
        $encuesta->p2 = $request->input('p2');
        $encuesta->p3 = $request->input('p3');
        $encuesta->p4 = $request->input('p4');
        $encuesta->p5 = $request->input('p5');
        $encuesta->p6 = $request->input('p6');
        $encuesta->p7 = $request->input('p7');
        $encuesta->p8 = $request->input('p8');
        $encuesta->p9 = $request->input('p9');
        $encuesta->p10 = $request->input('p10');
        $encuesta->p11 = $request->input('p11');
        $encuesta->p12 = $request->input('p12');
        $encuesta->p13 = $request->input('p13');
        $encuesta->p14 = $request->input('p14');

        $encuesta->p15_factoraje = $request->input('p15_factoraje');
        $encuesta->p15_credito_de_capital_de_trabajo = $request->input('p15_credito_de_capital_de_trabajo');
        $encuesta->p15_credito_puente = $request->input('p15_credito_puente');
        $encuesta->p15_arrendamiento_financiero = $request->input('p15_arrendamiento_financiero');
        $encuesta->p15_otro = $request->input('p15_otro');
        $encuesta->p15_cual = $request->input('p15_cual');

        $encuesta->p16_factoraje = $request->input('p16_factoraje');
        $encuesta->p16_credito_de_capital_de_trabajo = $request->input('p16_credito_de_capital_de_trabajo');
        $encuesta->p16_credito_puente = $request->input('p16_credito_puente');
        $encuesta->p16_arrendamiento_financiero = $request->input('p16_arrendamiento_financiero');
        $encuesta->p16_otro = $request->input('p16_otro');
        $encuesta->p16_cual = $request->input('p16_cual');

        $encuesta->p17 = $request->input('p17');

        $encuesta->save();



        if ($user == null)
        {
          $today = Carbon::now(-5);

          $idd = DB::table('clientesinteraccion')->insertGetId(
                  ['customerid'=> $request->input('customer_id'),
                   'id_tipoInteraccion' => 1,
                   'id_disposition'=> 45,
                   'comentario'=>'Encuesta contestada x email',
                   'id_users'=>7,
                   'fechaInteraccion'=> $today,
                   ]);

          return view('encuestaarrendamas.formulariocontestado',compact('customerid'));
        }
        else {
         return redirect()->action('crmcontroller@index' )->with('mensaje','cuestionario guardado correctamente, codifica al cliente: '.$request->input('customer_id'));
        }
    }
    else{
      if ($user == null)
      {
        return view('encuestaarrendamas.formulariocontestado',compact('customerid'));
      }
      else {
       return redirect()->action('crmcontroller@index' )->with('mensaje','El cuestionario ya habia sido guardado anteriormente, para el cliente: '.$request->input('customer_id'));
      }
    }


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

      $customerid = $id;
      $contestados = new encuestadesatisfaccion;
      $contestado = $contestados->where('customer_id','=',$id)->count();

     if ($contestado == 0)
     {
       return view('encuestaarrendamas.formularioencuesta',compact('customerid'));
     }

     else {

       $user = Auth::user();

       if ($user == null)
       {
         return view('encuestaarrendamas.formulariocontestado',compact('customerid'));
       }
       else {
        return redirect()->action('crmcontroller@index' )->with('mensaje','El cuestionario ya habia sido contestado por el cliente: '.$id);
       }

     }

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
