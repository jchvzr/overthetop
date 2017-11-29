
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



@endsection
