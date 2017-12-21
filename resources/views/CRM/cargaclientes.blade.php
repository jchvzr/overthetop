
@extends('layouts.principal')

@section('title', 'Main page')

@section('content')


<!-- Jquery Validate -->
<script src="js/plugins/validate/jquery.validate.min.js"></script>

<!-- Data Tables-->
<script src="js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

<!-- js especifico de vista -->
<script type="text/javascript" src="js/moment.min.js"></script>
<script src="js/datetimepicker/bootstrap-datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="css/datetimepicker/bootstrap-datetimepicker.css" />

<!-- Jquery Validate -->
<script src="js/plugins/validate/jquery.validate.min.js"></script>

<!-- Switchery -->
<link href="css/plugins/switchery/switchery.css" rel="stylesheet">

<!-- Switchery -->
<script src="js/plugins/switchery/switchery.js"></script>

<!-- especificos -->

<script src="js/jsespecificos/CRM/Cargaclientes.js"></script>



@if($errors->has())
    <div class="alert alert-warning" role="alert">
       @foreach ($errors->all() as $error)
          <div>{{ $error }}</div>
      @endforeach
    </div>
@endif </br>

<div id="pruebasjquery"></div>
<div class="row  border-bottom white-bg dashboard-header">
<div class="row">
  <div class="col-lg-12 col-md-12">
    <h2>Carga de clientes</h2>
  </div>
  <div class="col-lg-6 col-md-6">
    <a href="layout.xlsx" style='color:#FFF'><button type="button" class="btn btn-warning">Layout: <i class="glyphicon glyphicon-cloud-download"></i> </button></a>
  </div>
</div>
</div>

<div class="wrapper wrapper-content">
 <div class="ibox-content inspinia-timeline" id="compromisoslistado">
   <div class="row">
       <div class="col-lg-12">
         <div class="panel blank-panel">
             <div class="panel-heading">
                 <div class="panel-options">
                     <ul class="nav nav-tabs">
                         <li class="active"><a id="elementobuscado" data-toggle="tab" href="#tab-1">Carga de clientes</a></li>
                         <li class=""><a data-toggle="tab" href="#tab-2">Pase a productivo</a></li>
                     </ul>
                 </div>
             </div>

             <div class="panel-body">
               <div class="tab-content">

                <div id="tab-1" class="tab-pane active">
                 <div id="datos">
                   <div class="row">
                     <form id="fileinfo" method="post" onsubmit="subir();">
                       <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                       <div class="col-lg-6 col-md-6">
                         <h2><label for="Usuario" class="control-label">Campaña:</label></h2>
                         <select class="form-control  input-lg" id="campaña" name="campaña" required>
                           <option value=""></option>
                           <?php foreach ($campana as $campanas): ?>
                             <option value="<?=$campanas->id?>"><?=$campanas->nombre?></option>
                           <?php endforeach ?>
                         </select>
                       </div>
                       <div class="col-lg-8 col-md-8">
                         <h2><label for="Usuario" class="control-label col-md-12">Archivo:</label></h2>
                         <input class="" id="archivo" type="file" placeholder="Elige el archivo" name="archivo" required>
                         <progress id="progress" value="0"></progress>
                       </div>
                       <br>
                       <div class="col-lg-6 col-md-6">
                         <button class="btn btn-success" type="submit" name="button">subir</button>
                       </div>
                     </form>
                   </div>
                  </div>
                 </div>

                 <div id="tab-2" class="tab-pane">
                   <div id="bitacora">
                     <div class="row">
                       <form id="fileinfopro" method="post" onsubmit="subirpro();">
                         <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                         <div class="col-lg-6 col-md-6">
                           <h2><label for="Usuario" class="control-label">Campaña pre-cargada:</label></h2>
                           <select class="form-control  input-lg" id="campañapro" name="campañapro" required>
                             <option value=""></option>
                             <?php foreach ($campana_pre as $campanasp): ?>
                               <option value="<?=$campanasp->id?>"><?=$campanasp->nombre?></option>
                             <?php endforeach ?>
                           </select>
                         </div>
                         <br>
                         <div class="col-lg-12 col-md-12">
                           <button class="btn btn-success" type="submit" name="button">Cargar</button>
                         </div>
                       </form>
                     </div>
                   </div>
                 </div>
               </div>
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


 .cargando {
   position:absolute;
   width:100%;
   height:100%;
   left:30%;
   top:40%;
   margin-left:-400px;
   overflow:visible;
   -webkit-user-select:none;
   cursor:default;
 }

 .cargando div {
   position:absolute;
   width:30%;
   height:30%;
   opacity:0;
   font-family:Helvetica, Arial, sans-serif;
   -webkit-animation:move 3s linear infinite;
   -webkit-transform:rotate(180deg);
   color:#000000;
 }

 .cargando div:nth-child(2) {-webkit-animation-delay:0.1s;}
 .cargando div:nth-child(3) {-webkit-animation-delay:0.2s;}
 .cargando div:nth-child(4) {-webkit-animation-delay:0.3s;}
 .cargando div:nth-child(5) {-webkit-animation-delay:0.4s;}
 .cargando div:nth-child(6) {-webkit-animation-delay:0.5s;}
 .cargando div:nth-child(7) {-webkit-animation-delay:0.6s;}
 .cargando div:nth-child(8) {-webkit-animation-delay:0.7s;}
 .cargando div:nth-child(9) {-webkit-animation-delay:0.8s;}

 @keyframes move {
   0% {
     left:0;
     opacity:0;
   }
     35% {
         left: 41%;
         -webkit-transform:rotate(0deg);
         opacity:1;
     }
     65% {
         left:59%;
         -webkit-transform:rotate(0deg);
         opacity:1;
     }
     100% {
         left:100%;
         -webkit-transform:rotate(-180deg);
         opacity:0;
     }
 }

 @-webkit-keyframes move {
     0% {
         left:0;
         opacity:0;
     }
     35% {
         left:41%;
         -webkit-transform:rotate(0deg);
         transform:rotate(0deg);
         opacity:1;
     }
     65% {
         left:59%;
         -webkit-transform:rotate(0deg);
         transform:rotate(0deg);
         opacity:1;
     }
     100% {
         left:100%;
         -webkit-transform:rotate(-180deg);
         transform:rotate(-180deg);
         opacity:0;
     }
 }

</style>

@endsection
