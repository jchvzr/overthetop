
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
<h2>Lista de compromisos de hoy</h2>

</div>
</div>

<div class="wrapper wrapper-content">
 <div class="ibox-content inspinia-timeline" id="compromisoslistado">
<?php foreach($compromisos as $compromisodetalle): ?>
<div class="timeline-item">
   <div class="row">

       <div class="col-xs-6 date">

<input type="checkbox" class="js-switch_3" value = "<?=$compromisodetalle->id?>"  onchange="cambio(<?=$compromisodetalle->id ?>);"  <?php if ($compromisodetalle->hecho == 1) {echo("checked");}  ?>/>
           <?=$compromisodetalle->fechaFin ?>
           <br/>
       </div>
       <div class="col-xs-7 content no-top-border">
           <p class="m-b-xs"><strong><?=$compromisodetalle->nombre ?></strong> </p>
           <p>Cuenta: <?=$compromisodetalle->customerid ?> - Nombre:  <?=$compromisodetalle->nombreCliente ?></p>
           <p>Comentario: <?=$compromisodetalle->comentario ?> Monto: <?=$compromisodetalle->monto ?></p>


       </div>
       <div id="review<?=$compromisodetalle->id?>" name="review<?=$compromisodetalle->id ?>" class="col-xs-3">
         <?php if ($compromisodetalle->hecho == 1) {echo("<strong>Revisado</trong>");} else{echo("<strong>Pendiente de revisi&oacute;n<strong/>");}  ?>
       </div>
   </div>
 </div>

<?php endforeach?>
</div>
</div>

@endsection
