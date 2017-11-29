
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

<!-- Chosen -->
<script src="js/plugins/chosen/chosen.jquery.js"></script>
<link href="css/plugins/chosen/chosen.css" rel="stylesheet">

<!-- especificos-->

<script src="js/jsespecificos/CRM/newcampaign.js"></script>

<!-- Chosen -->
<script src="js/plugins/chosen/chosen.jquery.js"></script>
<link href="css/plugins/chosen/chosen.css" rel="stylesheet">


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
    <h2>Subir Campaña</h2>
  </div>
</div>
</div>

<div class="wrapper wrapper-content">
 <div class="ibox-content inspinia-timeline" id="compromisoslistado">
   <div class="row">
     <form class="" action="/newcampaignup" method="post">
       <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
       <div class="col-lg-6 col-md-6">
         <label for="Usuario" class="control-label">Campaña:</label>
         <input class="form-control" id="campana" type="text" placeholder="Nombre de la campaña" name="campana" required>
       </div>

       <div class="col-lg-8 col-md-8">
         <label for="Usuario" class="control-label">Descripci&oacute;n:</label>
         <textarea class="form-control" rows="3" id="descripcion" name="descripcion" placeholder="Máximo 500 caracteres" maxlength="500" required></textarea>
       </div>

       <div class="col-lg-8 col-md-8">
         <label for="Usuario" class="control-label">Cat&aacute;lgo de c&oacute;digos:</label>
         <select class="chosen-select form-control required" id="disposition" name="disposition" required >
           <option value=""></option>
           <?php foreach ($dispositionplan as $dispositionplans): ?>
             <option value="<?=$dispositionplans->id?>"><?=$dispositionplans->nombre?></option>
           <?php endforeach ?>
         </select>
       </div>
       </div>
       <br>
     <div class="row">
       <div class="col-lg-12 col-md-12">
         <button type="submit" class="btn btn-primary" id="button">Subir</button>
       </div>
     </form>
     </div>

 </div>
</div>


<div class="row  border-bottom white-bg dashboard-header">
<div class="row">
<h2>Editar campaña <small> Aqu&iacute; se puede ver o editar las campañas ya existentes. </small></h2>

</div>
</div>

<div class="wrapper wrapper-content">
 <div class="ibox float-e-margins">
  <div class="ibox-title">
      <h5>Ver o editar campaña</h5>
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
   <tbody id="tablacampañas">
     <?php foreach ($campanas as $campana): ?>
        <tr id="fila<?=$campana->id ?>" class="gradeX" onclick="openmodal(<?=$campana->id ?>)"><strong>
          <td><?=$campana->nombre ?></td>
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
                <h4 class="modal-title">Editar compañ&iacute;a</h4>
            </div>
            <div class="modal-body">

              <form id="editacampañamodal" name="editacampañamodal" class="" method="post" accept-charset="UTF-8" enctype="multipart/form-data" action="/newcatalogo/editacatalogo/6">

                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" name="hdnid" value="" id="hdnid">
              <div class="row">

              <div class="checkbox col-lg-3"></div>
                <div class="form-group col-lg-6">
                  <label>Nuevo nombre de campaña: *</label>
                  <input id="campanamodal" name="campanamodal" type="text" class="form-control required">
                  <label>descripci&oacute;n: *</label>
                  <textarea id="campanadescripcionmodal" name="campanadescripcionmodal" class="form-control required"></textarea>
                </div>
              <div class="checkbox col-lg-3"></div>
              </div>
              <br>
              <div class="row">

              <div class="col-lg-8 col-md-8">
                <label for="Usuario" class="control-label">Cat&aacute;lgo de c&oacute;digos:</label>
                <select class="chosen-select form-control required" id="dispositionplanmodal1" name="dispositionplanmodal1">

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
                <div class="progress" id="progress">
                  <div class="progress-bar progress-bar-striped active" role="progressbar"
                  aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
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


<script>
$(document).ready(function(){
$(".chosen-select").chosen({width: "100%"});
});

</script>


@endsection
