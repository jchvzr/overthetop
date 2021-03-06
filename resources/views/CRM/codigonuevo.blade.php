
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

<!-- especificos -->

<script src="js/jsespecificos/CRM/CRMCrearcodigo.js"></script>


@if($errors->has())
    <div class="alert alert-warning" role="alert">
       @foreach ($errors->all() as $error)
          <div>{{ $error }}</div>
      @endforeach
    </div>
@endif </br>

<div id="pruebasjquery"></div>
<div class="row border-bottom white-bg dashboard-header">
<div class="row">
<h2>Crear un nuevo c&oacute;digo<small> Aqu&iacute; se crean los c&oacute;digos de resultado de las interacciones.</h2>

</div>
</div>

<div class="wrapper wrapper-content">
 <div class="ibox-content inspinia-timeline" id="paranuevocodigo">
<form id="creacodigo" name="creacodigo" class="" method="post" accept-charset="UTF-8" enctype="multipart/form-data" action="/CRM/creacodigo/">
  <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
<div class="row">

<div class="checkbox col-lg-3"></div>
  <div class="form-group col-lg-6">
    <label>Nombre del c&oacute;digo: *</label>
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
       <?php foreach ($dispositiontratamientos as $dispositionTratamiento): ?>
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
  <!--  <button name="guardacodigo" type="submit" class="btn btn-primary" id="guardacodigo" style="font-family: Arial;">Guardar codigo submit</button>-->

    <button name="guardacodigo" type="button" class="btn btn-primary" id="guardacodigo" style="font-family: Arial;" onclick="guardaformulariocodigo()">Guardar nuevo c&oacute;digo</button>
  </center>
</div>
<div class="checkbox col-lg-3"></div>
</div>
</form>
</div>
</div>


<div class="row  border-bottom white-bg dashboard-header">
<div class="row">
<h2>Editar c&oacute;digos</h2>

</div>
</div>


<div class="wrapper wrapper-content">
 <div class="ibox-content inspinia-timeline" id="paranuevocodigo">

   <table class="table table-striped table-bordered table-hover dataTables-example" >
   <thead>
   <tr>
     <th>Nombre</th>
     <th>Contacto</th>
     <th>RPC</th>
     <th>Exito</th>
     <th>Tramiento</th>
   </tr>
   </thead>
   <tbody id="tablacodigos">
    <?php foreach ($dispositions as $disposition): ?>
       <tr id="fila<?=$disposition->id ?>" class="gradeX" onclick="openmodal(<?=$disposition->id ?>)"><strong>
         <td><?=$disposition->nombre ?></td>
         <td><?=$disposition->contacto ?></td>
         <td><?=$disposition->rpc ?></td>
         <td><?=$disposition->exito ?></td>
         <td><?=$disposition->tratamiento ?></td></a>
       </strong></tr>
    <?php endforeach ?>
     </tbody>
     <tfoot>
     <tr>
       <th>Nombre</th>
       <th>Contacto</th>
       <th>RPC</th>
       <th>Exito</th>
       <th>Tramiento</th>
     </tr>
     </tfoot>
     </table>

</div>
</div>

<!--modal para edicion -->

<div class="modal inmodal" id="modaledita" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated flipInY">
            <div class="modal-header">

                <button type="button" class="close" onclick="cerrarmodal()" ><span aria-hidden="true">&times;</span><span class="sr-only" >Close</span></button>
                <h4 class="modal-title">Editar codigo</h4>
            </div>
            <div class="modal-body">

              <form id="editacodigomodal" name="editacodigomodal" method="PUT"  accept-charset="UTF-8" enctype="multipart/form-data" action="/newcode/editacodigo/">
                <input type="hidden" name="hdnid" value="" id="hdnid">
                <input type="hidden" name="_method" value="post" id="_method">
                {{ method_field('PUT') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
              <div class="row">

              <div class="checkbox col-lg-3"></div>
              <div class="form-group col-lg-6">
                  <label>Codigo: </label>
                  <input id="codigomodal" name="codigomodal" type="text" class="form-control" required>
              </div>
              <div class="checkbox col-lg-3"></div>
              </div>

              <div class="row">

              <div class="checkbox col-lg-6">
              <center><label > Reportar como: </label></center>
              <center><label class="checkbox-inline"> <input type="checkbox" name="modalcontacto"  id="modalcontacto" value="1"> Contacto </label>
              <label class="checkbox-inline"> <input type="checkbox" name="modalrpc"  id="modalrpc" value="1"> RPC </label>
              <label class="checkbox-inline"> <input type="checkbox" name="modalexito"  id="modalexito" value="1"> Exito </label></center>
              </div>

              <div class="checkbox col-lg-6">
                <br>
                <div class="form-group">
                    <label>Tratamiento *</label>
                    <br>
                    <select id="modaldispositionTratamiento" name="modaldispositionTratamiento" class="form-control required">

                    </select>
                </div>
              </div>
              </div>
            <!--  <button type="submit" class="btn btn-primary" id="guarda" name="guarda">Guardar interaccion submit</button> -->
              </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white"  id="closeguarda" name="closeguarda" onclick="cerrarmodal() ">Close</button>
                <button type="button" class="btn btn-primary" id="guardamodal" name="guardamodal" onclick="guardacambio()">Guardar interaccion</button>

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
