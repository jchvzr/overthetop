
@extends('layouts.principal')

@section('title', 'Main page')

@section('content')

<!-- Data Tables -->
<link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
<link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
<link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">


<!-- Data Tables-->
<script src="js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>


<!-- Jquery Validate -->
<script src="js/plugins/validate/jquery.validate.min.js"></script>

<!-- Switchery -->
<link href="css/plugins/switchery/switchery.css" rel="stylesheet">

<!-- Switchery -->
<script src="js/plugins/switchery/switchery.js"></script>

<!-- Chosen -->
<script src="js/plugins/chosen/chosen.jquery.js"></script>
<link href="css/plugins/chosen/chosen.css" rel="stylesheet">


<!-- especificos -->

<script src="js/jsespecificos/CRM/CRMCatalogocodigos.js"></script>


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
<h2>Crear cat&aacute;logo de c&oacute;digos<small> Aqu&iacute; se genera un cat&aacute;logo de c&oacute;digos para asociarlo a la campaña.</h2>

</div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
 <div class="ibox float-e-margins">
 <div class="ibox-title">
     <h5>Nuevo cat&aacute;logo</h5>
     <div class="ibox-tools">
         <a class="collapse-link">
             <i class="fa fa-chevron-up"></i>
         </a>
     </div>
 </div>

 <div class="ibox-content" id="paranuevocodigo">
<form id="creacatalogo" name="creacodigo" class="" method="post" accept-charset="UTF-8" enctype="multipart/form-data" action="/CRM/creacodigo/">
  <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
<div class="row">

<div class="checkbox col-lg-3"></div>
  <div class="form-group col-lg-6">
    <label>Nombre del nuevo cat&aacute;logo: *</label>
    <input id="catalogo" name="catalogo" type="text" class="form-control required">
    <label>descripci&oacute;n: *</label>
    <textarea id="catalogodescripcion" name="catalogodescripcion" class="form-control required"></textarea>
  </div>
<div class="checkbox col-lg-3"></div>
</div>
<br>
<div class="row">

  <div class="col-lg-5 m-l-n">
    <label>C&oacute;digos disponibles:</label>
  <select class="form-control" multiple="" id="listaDisposition" onclick="agregaSeleccion('listaDisposition', 'dispositionSeleccionados');">
    <?php foreach($dispositions as $disposition): ?>
      <option value=<?=$disposition->id?> ><?=$disposition->nombre?></option>
    <?php     endforeach ?>
  </select>
  </div>
<div class="col-lg-2 m-l-n">
  <br>
<center>   <input type="button" name="agregar todo" class="btn btn-primary btn-outline" value=">>>" title="agregar todo" onclick="agregaTodo('listaDisposition', 'dispositionSeleccionados');"> </center>
<center>   <input type="button" name="quitar todas" class="btn btn-primary btn-outline" value="<<<" title="Quitar todo" onclick="agregaTodo('dispositionSeleccionados', 'listaDisposition');"> </center>
</div>

<div class="col-lg-5 m-l-n">
  <label>C&oacute;digos seleccionados: *</label>
<select class="form-control required" multiple="" id="dispositionSeleccionados"  name="dispositionSeleccionados[]" onclick="agregaSeleccion('dispositionSeleccionados', 'listaDisposition');">

</select>
</div>


</div>
<br>
<div class="row">
  <div class="checkbox col-lg-3"></div>
<div class="form-group col-lg-6">
  <center>
  <!--  <button name="guardacodigo" type="submit" class="btn btn-primary" id="guardacodigo" style="font-family: Arial;">Guardar codigo submit</button>-->

    <button name="guardacodigo" type="button" class="btn btn-primary" id="guardacodigo" style="font-family: Arial;" onclick="guardaformulariocatalogo()">Guardar nuevo cat&aacute;logo</button>
  </center>
</div>
<div class="checkbox col-lg-3"></div>
</div>
</form>
</div>
</div>
</div>

<div class="row  border-bottom white-bg dashboard-header">
<div class="row">
<h2>Editar cat&aacute;logos <small> Aqu&iacute; se pueden ver o editar cat&aacute;logos ya existentes. </small></h2>

</div>
</div>


<div class="wrapper wrapper-content">
 <div class="ibox float-e-margins">
  <div class="ibox-title">
      <h5>Ver o editar cat&aacute;logo</h5>
      <div class="ibox-tools">
          <a class="collapse-link">
              <i class="fa fa-chevron-up"></i>
          </a>
      </div>
  </div>


 <div class="ibox-content inspinia-timeline" id="paranuevocodigo">

   <table class="table table-striped table-bordered table-hover dataTables-example" >
   <thead>
   <tr>
     <th>Nombre</th>
   </tr>
   </thead>
   <tbody id="tablacodigos">
    <?php foreach ($dispositionplans as $dispositionplan): ?>
       <tr id="fila<?=$dispositionplan->id ?>" class="gradeX" onclick="openmodal(<?=$dispositionplan->id ?>)"><strong>
         <td><?=$dispositionplan->nombre ?></td>
       </strong></tr>
    <?php endforeach ?>
     </tbody>
     <tfoot>
     <tr>
       <th>Nombre</th>
     </tr>
     </tfoot>
     </table>

</div>
</div>
</div>


<!--modal para edicion -->

<div class="modal inmodal" id="modaledita" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated flipInY">
            <div class="modal-header">

                <button type="button" class="close" onclick="cerrarmodal()" ><span aria-hidden="true">&times;</span><span class="sr-only" >Close</span></button>
                <h4 class="modal-title">Editar cat&aacute;logo</h4>
            </div>
            <div class="modal-body">

              <form id="editacatalogomodal" name="editacatalogomodal" class="" method="post" accept-charset="UTF-8" enctype="multipart/form-data" action="/newcatalogo/editacatalogo/6">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" name="hdnid" value="" id="hdnid">
              <div class="row">

              <div class="checkbox col-lg-3"></div>
                <div class="form-group col-lg-6">
                  <label>Nombre del nuevo cat&aacute;logo: *</label>
                  <input id="catalogomodal" name="catalogomodal" type="text" class="form-control required">
                  <label>descripci&oacute;n: *</label>
                  <textarea id="catalogodescripcionmodal" name="catalogodescripcionmodal" class="form-control required"></textarea>
                </div>
              <div class="checkbox col-lg-3"></div>
              </div>
              <br>
              <div class="row">

                <div class="col-lg-5 m-l-n">
                  <label>C&oacute;digos disponibles:</label>
                <select class="form-control" multiple="" id="listaDispositionmodal" onclick="agregaSeleccion('listaDispositionmodal', 'dispositionSeleccionadosmodal');">
                  <?php foreach($dispositions as $disposition): ?>
                    <option value=<?=$disposition->id?> ><?=$disposition->nombre?></option>
                  <?php     endforeach ?>
                </select>
                </div>
              <div class="col-lg-2 m-l-n">
                <br>
              <center>   <input type="button" name="agregar todo" class="btn btn-primary btn-outline" value=">>>" title="agregar todo" onclick="agregaTodo('listaDispositionmodal', 'dispositionSeleccionadosmodal');"> </center>
              <center>   <input type="button" name="quitar todas" class="btn btn-primary btn-outline" value="<<<" title="Quitar todo" onclick="agregaTodo('dispositionSeleccionadosmodal', 'listaDispositionmodal');"> </center>
              </div>

              <div class="col-lg-5 m-l-n">
                <label>C&oacute;digos seleccionados: *</label>


              <select class="form-control required" multiple="" id="dispositionSeleccionadosmodal"  name="dispositionSeleccionadosmodal[]" onclick="agregaSeleccion('dispositionSeleccionadosmodal', 'listaDispositionmodal');">

              </select>
              </div>


              </div>
              <br>
              <div class="row">
                <div class="checkbox col-lg-3"></div>
              <div class="form-group col-lg-6">
                <center>
                <!--  <button name="guardacodigo" type="submit" class="btn btn-primary" id="guardacodigo" style="font-family: Arial;">Guardar nuevo cat&aacute;logo submit</button>-->


                </center>
              </div>
              <div class="checkbox col-lg-3"></div>
              </div>
              </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white"  id="closeguarda" name="closeguarda" onclick="cerrarmodal() ">Close</button>
                <button name="guardacodigo" type="button" class="btn btn-primary" id="guardacodigo" style="font-family: Arial;" onclick="guardacambio()">Guardar nuevo cat&aacute;logo</button>


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