
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

<!-- especificos

<script src="js/jsespecificos/CRM/newcampaign.js"></script>
-->



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
         <h2><label for="Usuario" class="control-label">Campaña:</label></h2>
         <input class="form-control" id="campana" type="text" placeholder="Nombre de la campaña" name="campana" required>
       </div>

       <div class="col-lg-8 col-md-8">
         <h2><label for="Usuario" class="control-label">Descripcion:</label></h2>
         <textarea class="form-control" rows="3" id="descripcion" name="descripcion" placeholder="Máximo 500 caracteres" maxlength="500" required></textarea>
       </div>

       <div class="col-lg-8 col-md-8">
         <h2><label for="Usuario" class="control-label">Disposition Plan:</label></h2>
         <select class="form-control  input-lg" id="disposition" name="disposition" required>
           <option value=""></option>
           <?php foreach ($dispositionplan as $dispositionplans): ?>
             <option value="<?=$dispositionplans->id?>"><?=$dispositionplans->nombre?></option>
           <?php endforeach ?>
         </select>
       </div>

       <div class="col-lg-12 col-md-12">
         <button type="submit" class="btn btn-success" id="button">Subir</button>
       </div>
     </form>
   </div>
 </div>
</div>

@endsection
