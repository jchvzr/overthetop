
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
<h2>Carga de clientes</h2>
<a href="layout.xlsx" style='color:#FFF'><button type="button" class="btn btn-warning"><i class="glyphicon glyphicon-cloud-download"></i></button></a>
</div>
</div>

<div class="wrapper wrapper-content">
 <div class="ibox-content inspinia-timeline" id="compromisoslistado">
   <form id="fileinfo" method="post">
     <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
     <h2><label for="Usuario" class="control-label col-md-12">Campaña:</label></h2>
     <input class="form-control input-lg" id="campaña" type="text" placeholder="Nombre de campaña" name="campaña" required>
     <h2><label for="Usuario" class="control-label col-md-12">Archivo:</label></h2>
     <input class="" id="archivo" type="file" placeholder="Elige el archivo" name="archivo" required>
     <progress id="progress" value="0"></progress>
     <br>
     <a class="btn btn-primary" id="subir" style="font-family: Arial;"><i class="glyphicon glyphicon-edit"></i><br>subir</a>
   </form>
 </div>
</div>

@endsection
