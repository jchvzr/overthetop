
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
<script src="js/jsespecificos/descargadetalle/detallecompromisos.js"></script>


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
<div class="col-lg-4">

    <form action="/descargacompromisosshow" id="buscadetallecodigos" name="buscadetallecodigos"class="form-inline" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
          <label class="col-lg-2 control-label">Fecha inicial:</label>
          <input class="form-control" id="fechainicio" type="date" placeholder="Fecha inicio" name="fechainicio" value="<?=$iniciostr?>" >
          <label class="col-lg-2 control-label">Fecha final:</label>
          <input class="form-control" id="fechafinal" type="date" placeholder="Fecha final" name="fechafinal" value="<?=$finalstr?>" >
          <!--<button name="buscadetalle" type="button" class="btn btn-primary" id="buscadetalle" style="font-family: Arial;" onclick="buscadetalleint();">Buscar detalle</button>-->
          <button name="buscadetalle" type="submit" class="btn btn-primary" id="buscadetalle" style="font-family: Arial;" >Buscar detalle</button>
      </form>
</div>
</div>

</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel blank-panel">
            <div class="panel-heading">
              <center>  <div class="panel-title m-b-md"><h3>Detalle de compromisos</h3> </center></div>
              <center> <button name="mandaexcel" type="button" class="btn btn-primary" id="mandaexcel" style="font-family: Arial;" onclick="mandaraexcel();">Exportar a excel <i class="fa fa-file-excel-o" aria-hidden="true"></i></button> </center>
              </div>

            <div class="panel-body">

                      <div id="detalleencontrado">
                        <div class="row">

                          <div class="progress" id="progress">
                            <div class="progress-bar progress-bar-striped active" role="progressbar"
                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">

                            </div>

                        <table class="table table-striped table-bordered table-hover dataTables-example"  id="interactiontable">
                                            <thead>
                                            <tr>

                                              <th>Fecha</th>
                                              <th>Usuario</th>
                                              <th>Cliente / cuenta</th>
                                              <th>Codigo</th>
                                              <th>Comentario</th>
                                              <th>Campaña</th>
                                              <th>Monto</th>
                                              <th>Revisado</th>

                                            </tr>
                                            </thead>
                                            <tbody id="tableInteraccion">


                                            </tbody>

                                            </table>

                      </div>
                    </div>

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
