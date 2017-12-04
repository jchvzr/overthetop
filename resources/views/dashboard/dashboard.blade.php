
@extends('layouts.principal')

@section('title', 'Main page')

@section('content')


<!-- Flot -->
<script src="js/plugins/flot/jquery.flot.js"></script>
<script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="js/plugins/flot/jquery.flot.resize.js"></script>
<script src="js/plugins/flot/jquery.flot.pie.js"></script>
<script src="js/plugins/flot/jquery.flot.time.js"></script>

<!-- EayPIE -->
<script src="js/plugins/easypiechart/jquery.easypiechart.js"></script>

<!-- jscript especifico -->
<script src="js/jsespecificos/dashboard/dashboard.js"></script>

<div class="row  border-bottom white-bg dashboard-header">

<div class="row">

       <div class="col-sm-3">

           <h2>Bienvenido <?=$datauser->nombre ?></h2>

       </div>
 </div>
 </div>


@endsection
