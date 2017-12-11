
@extends('layouts.principal')

@section('title', 'Main page')

@section('content')

<!-- js especifico de vista -->
<script type="text/javascript" src="js/moment.min.js"></script>
<script src="js/datetimepicker/bootstrap-datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="css/datetimepicker/bootstrap-datetimepicker.css" />


<!-- Data picker -->
<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>
<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">

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

       <div class="col-sm-2">

           <h2>Resultados</h2>

       </div>
  <form id="formfiltro" method="post" enctype="multipart/form-data" action="/descargadashboardpenetracion">
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
       <div class="col-sm-4">
           <div class="form-group">
               <label>Campaña </label>
               <select id="campana" name="campana" class="chosen-select form-control required">
                <?php foreach($campanas as $campana): ?>
                  <option value="<?=$campana->id?>"><?=$campana->nombre?></option>
                <?php endforeach ?>
               </select>
           </div>
       </div>

     <div class="col-sm-6" id="sandbox-container">
        <label>Rango de fechas </label>
       <div class="input-daterange input-group" id="datepicker">
           <input type="text" class="input-sm form-control" id="start"name="start" data-mask="<?=$inicio?>" value="<?=$inicio?>" />
           <span class="input-group-addon">hasta</span>
           <input type="text" class="input-sm form-control" id="end"name="end" data-mask="<?=$final?>"  value="<?=$final?>" />
       </div>
   </div>
  <!--   <button type="submit" class="btn btn-primary" id="guarda" name="guarda" value="">Pruebasubmint</button>-->
 </form>
 </div>

  <center>  <button name="buscacliente" type="button" class="btn btn-primary" id="buscaresultados" style="font-family: Arial;" onclick="buscaresultado();">Ver resultados</button> </center>

 </div>
<div id="todo">
 <div class="row">
   <div class="progress" id="progress">
     <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
     </div>
   </div>
 </div>

 <div class="row">
 <div class="col-lg-6">
     <div class="ibox float-e-margins">
         <div class="ibox-title">
             <h5>Rendimiento en la campaña:</h5>
         </div>
<div class="ibox-content">
     <ul class="stat-list">
         <li>
             <h2 class="no-margins" id="codigos"></h2>
             <small>Total de codigos ingresados</small>
             <h2 class="no-margins" id="contactos"></h2>
             <small>Total de contactos</small>
             <div class="stat-percent" id="contactospct"> <i class="fa fa-level-down text-navy"></i></div>
             <div class="progress progress-mini">
                 <div id="contactospctbar" style="width: 0%;" class="progress-bar"></div>
             </div>
             </li>
             <li>
                 <h2 class="no-margins" id="rpc"></h2>
                 <small>Total de rpc</small>
                 <div class="stat-percent" id="rpcpct"> <i class="fa fa-level-down text-navy"></i></div>
                   <div class="progress progress-mini">
                       <div id="rpcpctbar" style="width: 0%;" class="progress-bar"></div>
                   </div>
             </li>
             <li>
               <h2 class="no-margins " id="exito"></h2>
                <small>Total de exitos</small>
                <div class="stat-percent" id="exitopct"><i class="fa fa-bolt text-navy"></i></div>
                <div class="progress progress-mini">
                    <div id="exitopctbar" style="width: 0%;" class="progress-bar"></div>
                </div>
            </li>
         </ul>
 </div>
 </div>
 </div>


 <div class="col-lg-6">
     <div class="ibox float-e-margins">
         <div class="ibox-title">
             <h5>Penetracion de la base: </h5>
         </div>
         <div class="ibox-content">
           <h5 id="cargados"></h5>
           <h5 id="trabajados"></h5>
             <div class="flot-chart">
                 <div class="flot-chart-pie-content" id="flot-pie-chart"></div>
             </div>
            </div>
         </div>
     </div>
</div>


 <div class="row">
 <div class="col-lg-12">

       <div class="ibox float-e-margins">
           <div class="ibox-title">
               <h5>Levantamiento de promesas por dia: </h5>
           </div>
           <div class="ibox-content">
   <div class="flot-chart">
       <div class="flot-chart-content" id="flot-dashboard-chart" ></div>
   </div>
 </div>
 </div>

 </div>
 </div>
</div>
 <style>
 #WindowLoad
 {
     position:fixed;
     top:0px;
     left:0px;
     z-index:3200;
     filter:alpha(opacity=65);
    -moz-opacity:65;
     opacity:0.65;
     background:#999;
 }
 </style>

@endsection
