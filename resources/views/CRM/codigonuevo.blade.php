
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

<script src="js/jsespecificos/CRM/CRMControlCompromisos.js"></script>



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
<h2>Crear un nuevo codigo</h2>

</div>
</div>

<div class="wrapper wrapper-content">
 <div class="ibox-content inspinia-timeline" id="paranuevocodigo">
<form id="creacodigo" name="creacodigo"class="" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
<div class="row">

<div class="checkbox col-lg-3"></div>
  <div class="form-group col-lg-6">
    <label>Nombre del codigo: *</label>
    <input id="codigo" name="codigo" type="text" class="form-control required">
  </div>
<div class="checkbox col-lg-3"></div>
</div>
<br>
<div class="row">
<div class="checkbox col-lg-6">
<center><label > Reportar como: </label></center>

<center><label class="checkbox-inline"> <input type="checkbox" name="contacto"  id="contacto" value=""> Contacto </label>
<label class="checkbox-inline"> <input type="checkbox" name="rpc"  id="rpc" value=""> RPC </label>
<label class="checkbox-inline"> <input type="checkbox" name="exito"  id="exito" value=""> Exito </label></center>
</div>

<div class="checkbox col-lg-6">
  <div class="form-group">
      <label>Tratamiento *</label>
      <br>
      <select id="dispositionTratamiento" name="dispositionTratamiento" class="form-control required">
        <option value="" ></option>
       <?php foreach ($dispositionTratamientos as $dispositionTratamiento): ?>
        <option value=<?=$dispositionTratamiento->id ?> ><?=$dispositionTratamiento->nombre ?></option>
       <?php endforeach ?>
      </select>

  </div>
</div>
</div>
<br>
<div class="row">
  <div class="checkbox col-lg-3"></div>
<div class="form-group col-lg-6">
  <center>
    <button name="guardacodigo" type="button" class="btn btn-primary" id="guardacodigo" style="font-family: Arial;">Guardar codigo</button>
  </center>
</div>
<div class="checkbox col-lg-3"></div>
</div>
</form>
</div>
</div>


<div class="row  border-bottom white-bg dashboard-header">
<div class="row">
<h2>Editar codigos</h2>

</div>
</div>


<div class="wrapper wrapper-content">
 <div class="ibox-content inspinia-timeline" id="paranuevocodigo">
<form id="creacodigo" name="creacodigo"class="" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
<div class="row">

<div class="checkbox col-lg-3"></div>
  <div class="form-group col-lg-6">
    <label>Elige el codigo *</label>
    <br>
    <select id="dispositionlist" name="dispositionlist" class="form-control required">
      <option value="" ></option>
     <?php foreach ($dispositions as $disposition): ?>
      <option value=<?=$disposition->id ?> ><?=$disposition->nombre ?></option>
     <?php endforeach ?>
    </select>
  </div>
<div class="checkbox col-lg-3"></div>
</div>

<div class="row">

<div class="checkbox col-lg-6">
<center><label > Reportar como: </label></center>
<center><label class="checkbox-inline"> <input type="checkbox" name="contacto"  id="contacto" value=""> Contacto </label>
<label class="checkbox-inline"> <input type="checkbox" name="rpc"  id="rpc" value=""> RPC </label>
<label class="checkbox-inline"> <input type="checkbox" name="exito"  id="exito" value=""> Exito </label></center>
</div>

<div class="checkbox col-lg-6">
  <br>
  <div class="form-group">
      <label>Tratamiento *</label>
      <br>
      <select id="dispositionTratamiento" name="dispositionTratamiento" class="form-control required">
        <option value="" ></option>
       <?php foreach ($dispositionTratamientos as $dispositionTratamiento): ?>
        <option value=<?=$dispositionTratamiento->id ?> ><?=$dispositionTratamiento->nombre ?></option>
       <?php endforeach ?>
      </select>

  </div>
</div>
</div>
</form>
</div>
</div>


@endsection
