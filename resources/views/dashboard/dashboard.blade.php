
@extends('layouts.principal')

@section('title', 'Main page')

@section('content')

<!-- js especifico de vista -->
<script type="text/javascript" src="js/moment.min.js"></script>
<script src="js/datetimepicker/bootstrap-datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="css/datetimepicker/bootstrap-datetimepicker.css" />

<!-- Flot -->
<script src="js/plugins/flot/jquery.flot.js"></script>
<script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="js/plugins/flot/jquery.flot.resize.js"></script>
<script src="js/plugins/flot/jquery.flot.pie.js"></script>
<script src="js/plugins/flot/jquery.flot.time.js"></script>

<!-- EayPIE -->
<script src="js/plugins/easypiechart/jquery.easypiechart.js"></script>

<!-- jscript especifico -->
<script src="js/jsespecificos/dashboard/dashboard.js"></script>

<!-- Chosen -->
<script src="js/plugins/chosen/chosen.jquery.js"></script>
<link href="css/plugins/chosen/chosen.css" rel="stylesheet">



<div class="row  border-bottom white-bg dashboard-header">

<div class="row">

       <div class="col-sm-3">

           <h2>Resultados</h2>

       </div>
       <div class="col-sm-3">
           <div class="form-group">
               <label>Campaña </label>
               <select id="tipoInte" name="tipoInte" multiple="multiple" class="chosen-select form-control required">

               </select>
           </div>
       </div>

   <div class="col-sm-3">
       <div class="form-group col-sm-6" id="data_5">
                                       <label class="font-noraml">Range select</label>
                                       <div class="input-daterange input-group" id="datepicker">
                                           <input type="text" class="input-sm form-control" name="start" value="05/14/2014"/>
                                           <span class="input-group-addon">to</span>
                                           <input type="text" class="input-sm form-control" name="end" value="05/22/2014" />
                                       </div>
       </div>
 </div>
 </div>
 </div>

 <div class="col-lg-12">
     <div class="ibox float-e-margins">
         <div class="ibox-title">
             <h5>Rendimiento en la campaña:</h5>
         </div>
<div class="ibox-content">
 <div class="row">

 <br>
 <div class="col-lg-3">
     <ul class="stat-list">
         <li>
             <h2 class="no-margins"><?=$clientesinteraccion->codigos ?></h2>
             <small>Total de codigos ingresados</small>
             <h2 class="no-margins"><?=$clientesinteraccion->contacto ?></h2>
             <small>Total de contactos</small>
             <div class="stat-percent"><?php if (($clientesinteraccion->codigos)==0): echo(0); else: echo(($clientesinteraccion->contacto / $clientesinteraccion->codigos) * 100 );endif ?>% <i class="fa fa-level-down text-navy"></i></div>
             </li>
             <li>
                 <h2 class="no-margins "><?=$clientesinteraccion->rpc ?></h2>
                 <small>Total de rpc</small>
                 <div class="stat-percent"><?php if ($clientesinteraccion->contacto==0): echo(0); else: echo(($clientesinteraccion->rpc / $clientesinteraccion->contacto) * 100); endif?>% <i class="fa fa-level-down text-navy"></i></div>
                   <div class="progress progress-mini">
                       <div style="width: <?php if ($clientesinteraccion->contacto==0): echo(0); else: echo(($clientesinteraccion->rpc / $clientesinteraccion->contacto) * 100); endif?>%;" class="progress-bar"></div>
                   </div>
             </li>
             <li>
               <h2 class="no-margins "><?=$clientesinteraccion->exito ?></h2>
                <small>Total de exitos</small>
                <div class="stat-percent"><?php if ($clientesinteraccion->rpc==0): echo(0); else: echo(($clientesinteraccion->exito / $clientesinteraccion->rpc) * 100); endif?>% <i class="fa fa-bolt text-navy"></i></div>
                <div class="progress progress-mini">
                    <div style="width: <?php if ($clientesinteraccion->rpc==0): echo(0); else: echo(($clientesinteraccion->exito / $clientesinteraccion->rpc) * 100); endif?>%;" class="progress-bar"></div>
                </div>
            </li>

         </ul>
     </div>
 </div>

 </div>
 </div>
 </div>



@endsection
