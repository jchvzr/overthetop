
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


<!-- jscript especifico -->
<script src="js/jsespecificos/descargadetalle/detallecodigos.js"></script>


<!-- Flot -->
<script src="js/plugins/flot/jquery.flot.js"></script>
<script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="js/plugins/flot/jquery.flot.resize.js"></script>
<script src="js/plugins/flot/jquery.flot.pie.js"></script>
<script src="js/plugins/flot/jquery.flot.time.js"></script>
<script src="js/plugins/flot/jquery.flot.categories.js"></script>

<!-- Chosen -->
<script src="js/plugins/chosen/chosen.jquery.js"></script>
<link href="css/plugins/chosen/chosen.css" rel="stylesheet">

<!-- table to excel-->
<script src="/js/EXCEL/src/jquery.table2excel.js"></script>

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
<div class="col-lg-12">

  <h3>Descarga detalles</h3>
</div>
</div>

</div>

<br>

<div class="row">
    <div class="col-lg-6">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
              <h5>Descarga detalle de codigos</h5>
          </div>
          <div class="ibox-content">

      <form  action="/descargacodigosshow" id="buscadetallecodigos" name="buscadetallecodigos"class="form-inline" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="col-sm-9" id="sandbox-container">
           <label>Rango de fechas </label>
          <div class="input-daterange input-group" id="datepicker">
              <input type="text" class="input-sm form-control" id="fechainicio"name="fechainicio" data-mask="<?=$iniciostr?>" value="<?=$iniciostr?>" />
              <span class="input-group-addon">hasta</span>
              <input type="text" class="input-sm form-control" id="fechafinal" name="fechafinal" value="<?=$finalstr?>" data-mask="<?=$finalstr?>"   />
          </div>
        </div>

        <button onclick="descargainteracciones();" name="buscadetalle" type="submit" class="btn btn-primary" id="buscadetalle" style="font-family: Arial;" >Bajar detalle</button>
        </form>
         </div>
    </div>

</div>

<div class="col-lg-6">
  <div class="ibox float-e-margins">
      <div class="ibox-title">
          <h5>Descarga detalle de compromisos</h5>
      </div>
      <div class="ibox-content">

        <form action="/descargacompromisosshow" id="buscadetallecompromisos" name="buscadetallecodigos"class="form-inline" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
          <div class="col-sm-9" id="sandbox-container">
             <label>Rango de fechas </label>
            <div class="input-daterange input-group" id="datepicker">
                <input type="text" class="input-sm form-control" id="fechainicio"name="fechainicio" data-mask="<?=$iniciostr?>" value="<?=$iniciostr?>" />
                <span class="input-group-addon">hasta</span>
                <input type="text" class="input-sm form-control" id="fechafinal" name="fechafinal" value="<?=$finalstr?>" data-mask="<?=$finalstr?>"   />
            </div>
          </div>
              <!--<button name="buscadetalle" type="button" class="btn btn-primary" id="buscadetalle" style="font-family: Arial;" onclick="buscadetalleint();">Buscar detalle</button>-->
              <button onclick="descargacompromisos();"  name="buscadetalle" type="submit" class="btn btn-primary" id="buscadetalle" style="font-family: Arial;" >Bajar detalle</button>
          </form>
     </div>
</div>

</div>


</div>

<div class="row">
    <div class="col-lg-6">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
              <h5>Descarga detalle de campaña</h5>
          </div>
          <div class="ibox-content">

      <form  action="/descargaclientes" id="buscadetallecampaña" name="buscadetallecodigos"class="form-inline" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="col-sm-9">
            <label >Campaña </label>
            <select id="campana" name="campana" class="chosen-select required">
             <?php foreach($campanas as $campana): ?>
               <option value="<?=$campana->id?>"><?=$campana->nombre?></option>
             <?php endforeach ?>
            </select>
              </div>
              <button onclick="descargacampaña();" name="buscadetalle" type="submit" class="btn btn-primary" id="buscadetalle" style="font-family: Arial;" >Bajar detalle</button>
        </form>
         </div>
    </div>

</div>
</div>


<style>
    body.DTTT_Print {
        background: #fff;

    }
    .DTTT_Print #page-wrapper {
        margin: 0;
        background:#fff;
    }

    button.DTTT_button, div.DTTT_button, a.DTTT_button {
        border: 1px solid #e7eaec;
        background: #fff;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }
    button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {
        border: 1px solid #d2d2d2;
        background: #fff;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }

    .dataTables_filter label {
        margin-right: 5px;

    }
</style>

@endsection
