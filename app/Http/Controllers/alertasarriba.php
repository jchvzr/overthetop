<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class alertasarriba extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $today = Carbon::now(-5);


      $start = Carbon::parse($today)->startOfDay();  //2016-09-29 00:00:00.000000
      $end = Carbon::parse($today)->endOfDay(); //2016-09-29 23:59:59.000000
      //$clicks->dateBetween($start, $end);


      $user = Auth::user();

      $userid = $user->id;
      $compromisos = DB::table('controlcompromisos')
                               ->join('dispositions','controlcompromisos.id_disposition','=','dispositions.id')
                               ->selectRaw('dispositions.nombre,count(dispositions.nombre) as cuantos')
                               ->wherebetween('controlcompromisos.fechaFin',[$start,$end])
                               ->where('controlcompromisos.id_users','=',$userid)
                               ->where('controlcompromisos.hecho','=',0)
                               ->groupby('dispositions.nombre')
                               ->orderBy('dispositions.nombre')
                               ->get();

      return(response()->json($compromisos));

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
