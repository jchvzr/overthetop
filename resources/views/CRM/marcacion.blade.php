<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/font-awesome/css/font-awesome.css" rel="stylesheet">
  <meta name="_token" content="{!! csrf_token() !!}"/>
  <link rel="shortcut icon" href="/img/solologooverthetop.png" />
  <!-- Toastr style -->
  <link href="/css/plugins/toastr/toastr.min.css" rel="stylesheet">

  <!-- Gritter -->
  <link href="/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

  <link href="/css/animate.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet">

      <!-- Mainly scripts -->
      <script src="js/jquery-2.1.1.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
      <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

      <!-- Flot -->
      <script src="js/plugins/flot/jquery.flot.js"></script>
      <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
      <script src="js/plugins/flot/jquery.flot.spline.js"></script>
      <script src="js/plugins/flot/jquery.flot.resize.js"></script>
      <script src="js/plugins/flot/jquery.flot.pie.js"></script>

      <!-- Peity -->
      <script src="js/plugins/peity/jquery.peity.min.js"></script>
      <script src="js/demo/peity-demo.js"></script>

      <!-- Custom and plugin javascript -->
      <script src="js/inspinia.js"></script>
      <script src="js/plugins/pace/pace.min.js"></script>

      <!-- jQuery UI -->
      <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

      <!-- GITTER -->
      <script src="js/plugins/gritter/jquery.gritter.min.js"></script>

      <!-- Sparkline -->
      <script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>

      <!-- Sparkline demo data  -->
      <script src="js/demo/sparkline-demo.js"></script>

      <!-- ChartJS-->
      <script src="js/plugins/chartJs/Chart.min.js"></script>

      <!-- Toastr -->
      <script src="js/plugins/toastr/toastr.min.js"></script>

      <script>


        initControls();

      function initControls(){
      window.location.hash="red";
      window.location.hash="Red" //chrome
      window.onhashchange=function(){window.location.hash="red";}
      }

      </script>


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
      <script src="js/jsespecificos/CRM/CRMMarcacion.js"></script>


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



</head>
<body>

  <!-- Wrapper-->

    <!-- End wrapper-->


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
      <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
          <button class="btn btn-danger" onclick=location="/bienvenida"  type="button" name="regresar"><i class="fa fa-arrow-left" aria-hidden="true"></i> regresar</button>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
          <h2>Marcacion</h2>
      </div>
    </div>
    </div>

    @if($cliente)
    <div class="wrapper wrapper-content">
     <div class="ibox-content inspinia-timeline" id="compromisoslistado">
       <div class="row">

         <div class="col-lg-12">
             <div class="form-group">
                 <button name="agregaInt" type="button" class="btn btn-primary" id="agregaInt" style="font-family: Arial;" data-toggle="modal" data-target="#agregaIntModal" onclick="chosechido()">Agregar Interaccion</button>
             </div>
         </div>

         <div class="col-lg-4">
             <div class="form-group">
                 <label>Cuenta: </label>
                 <input id="mcustomerid" name="mcustomerid" type="text" class="form-control" disabled="disabled" value="<?=$cliente->customerid?>">
             </div>
         </div>
           <div class="col-lg-4">
               <div class="form-group">
                   <label>Nombre: </label>
                   <input id="mnombreCliente" name="mnombreCliente" type="text" class="form-control" disabled="disabled" value="<?=$cliente->nombreCliente?>">
               </div>
           </div>
           <div class="col-lg-4">
               <div class="form-group">
                   <label>Domicilio casa: </label>
                   <input id="mcalleCasa" name="mcalleCasa" type="text" class="form-control" disabled="disabled" value="<?=$cliente->calleCasa?>">
               </div>
           </div>
           <div class="col-lg-4">
               <div class="form-group">
                   <label>Colonia casa: </label>
                   <input id="mcoloniaCasa" name="mcoloniaCasa" type="text" class="form-control" disabled="disabled" value="<?=$cliente->coloniaCasa?>">
               </div>
           </div>

           <div class="col-lg-4">
               <div class="form-group">
                   <label>Ciudad casa: </label>
                   <input id="mciudadCasa" name="mciudadCasa" type="text" class="form-control" disabled="disabled" value="<?=$cliente->ciudadCasa?>">
               </div>
           </div>
           <div class="col-lg-4">
               <div class="form-group">
                   <label>CP casa: </label>
                   <input id="mcpCasa" name="mcpCasa" type="text" class="form-control" disabled="disabled" value="<?=$cliente->cpCasa?>">
               </div>
           </div>
           <div class="col-lg-4">
               <div class="form-group">
                   <label>Domiclio trabajo: </label>
                   <input id="mcalleTrabajo" name="mcalleTrabajo" type="text" class="form-control" disabled="disabled" value="<?=$cliente->calleTrabajo?>">
               </div>
           </div>
           <div class="col-lg-4">
               <div class="form-group">
                   <label>Colonia trabajo: </label>
                   <input id="mcoloniaTrabajo" name="mcoloniaTrabajo" type="text" class="form-control" disabled="disabled" value="<?=$cliente->coloniaTrabajo?>">
               </div>
           </div>

           <div class="col-lg-4">
               <div class="form-group">
                   <label>Ciudad trabajo: </label>
                   <input id="mciudadTrabajo" name="mciudadTrabajo" type="text" class="form-control" disabled="disabled" value="<?=$cliente->ciudadTrabajo?>">
               </div>
           </div>
           <div class="col-lg-4">
               <div class="form-group">
                   <label>CP trabajo: </label>
                   <input id="mcpTrabajo" name="mcpTrabajo" type="text" class="form-control" disabled="disabled" value="<?=$cliente->cpTrabajo?>">
               </div>
           </div>
           <div class="col-lg-4">
               <div class="form-group">
                   <label>Tel&eacute;fono1: </label>
                   <input id="mtelefono1" name="mtelefono1" type="text" class="form-control" disabled="disabled" value="<?=$cliente->telefono1?>">
               </div>
           </div>
           <div class="col-lg-4">
               <div class="form-group">
                   <label>Tel&eacute;fono2: </label>
                   <input id="mtelefono2" name="mtelefono2" type="text" class="form-control" disabled="disabled" value="<?=$cliente->telefono2?>">
               </div>
           </div>
           <div class="col-lg-4">
               <div class="form-group">
                   <label>Tel&eacute;fono3: </label>
                   <input id="mtelefono3" name="mtelefono3" type="text" class="form-control" disabled="disabled" value="<?=$cliente->telefono3?>">
               </div>
           </div>
           <div class="col-lg-4">
               <div class="form-group">
                   <label>Tel&eacute;fono4: </label>
                   <input id="mtelefono4" name="mtelefono4" type="text" class="form-control" disabled="disabled" value="<?=$cliente->telefono4?>">
               </div>
           </div>
           <div class="col-lg-4">
               <div class="form-group">
                   <label>Custom1: </label>
                   <input id="mcustom1" name="mcustom1" type="text" class="form-control" disabled="disabled" value="<?=$cliente->custom1?>">
               </div>
           </div>
           <div class="col-lg-4">
               <div class="form-group">
                   <label>Custom2: </label>
                   <input id="mcustom2" name="mcustom2" type="text" class="form-control" disabled="disabled" value="<?=$cliente->custom2?>">
               </div>
           </div>
           <div class="col-lg-4">
               <div class="form-group">
                   <label>Custom3: </label>
                   <input id="mcustom3" name="mcustom3" type="text" class="form-control" disabled="disabled" value="<?=$cliente->custom3?>">
               </div>
           </div>
           <div class="col-lg-4">
               <div class="form-group">
                   <label>Custom4: </label>
                   <input id="mcustom4" name="mcustom4" type="text" class="form-control" disabled="disabled" value="<?=$cliente->custom4?>">
               </div>
           </div>
           <div class="col-lg-4">
               <div class="form-group">
                   <label>Custom5: </label>
                   <input id="mcustom5" name="mcustom5" type="text" class="form-control" disabled="disabled" value="<?=$cliente->custom5?>">
               </div>
           </div>
           <div class="col-lg-4">
               <div class="form-group">
                   <label>Custom6: </label>
                   <input id="mcustom6" name="mcustom6" type="text" class="form-control" disabled="disabled" value="<?=$cliente->custom6?>">
               </div>
           </div>
           <div class="col-lg-4">
               <div class="form-group">
                   <label>Custom7: </label>
                   <input id="mcustom7" name="mcustom7" type="text" class="form-control" disabled="disabled" value="<?=$cliente->custom7?>">
               </div>
           </div>
           <div class="col-lg-4">
               <div class="form-group">
                   <label>Custom8: </label>
                   <input id="mcustom8" name="mcustom8" type="text" class="form-control" disabled="disabled" value="<?=$cliente->custom8?>">
               </div>
           </div>
           <div class="col-lg-4">
               <div class="form-group">
                   <label>Custom9: </label>
                   <input id="mcustom9" name="mcustom9" type="text" class="form-control" disabled="disabled" value="<?=$cliente->custom9?>">
               </div>
           </div>
           <div class="col-lg-4">
               <div class="form-group">
                   <label>Custom10: </label>
                   <input id="mcustom10" name="mcustom10" type="text" class="form-control" disabled="disabled" value="<?=$cliente->custom10?>">
               </div>
           </div>
       </div>
     </div>
    </div>

    <!-- modal agrega interaccion -->


    <div class="modal inmodal" id="agregaIntModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Agrega los resultados de la interaccion</h4>
                </div>
                <div class="modal-body">
                <form id="formagregainteraccion" action="/crm/Marcacion" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                 <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                 <input id="customerid3" name="customerid3" type="hidden" class="form-control">

                  <div class="row">
                   <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Cuenta: </label>
                            <input id="customeridmodal" name="customeridmodal" type="text" class="form-control" disabled="disabled" value="<?=$cliente->customerid?>">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Nombre: </label>
                            <input id="nombreClienteModal" name="nombreClienteModal" type="text" class="form-control" disabled="disabled" value="<?=$cliente->nombreCliente?>">
                        </div>
                    </div>
                  </div>

                  <div class="col-lg-6">
                      <div class="form-group">
                          <label>Tipo de interaccion *</label>
                          <select id="tipoInte" name="tipoInte" class="chosen-select form-control required">
                            <option value="" ></option>
                          <?php foreach($tipoint as $tipoi): ?>
                            <option value=<?=$tipoi->id?> ><?=$tipoi->tipo?>" - "<?=$tipoi->descripcion?></option>
                          <?php     endforeach ?>
                          </select>
                      </div>
                  </div>

                  <div class="col-lg-6">
                      <div class="form-group">
                          <label>Codigo *</label>
                          <select id="dispositions" name="dispositions" class="chosen-select form-control required" tabindex="2">
                            <option value="" ></option>
                          <?php foreach($dispositions as $disp): ?>
                            <option value=<?=$disp->id?> ><?=$disp->nombre?></option>
                          <?php     endforeach ?>
                          </select>
                      </div>
                  </div>



                  <div class="col-lg-12">
                      <div class="form-group">
                          <label>Comentario: *</label>
                          <textarea id="comentario" name="comentario" type="text" class="form-control required"></textarea>
                      </div>
                  </div>
               </div>
              <div  class="modal-footer">
              <div id="compromiso">
               <div class="row">
                 <div class="col-lg-4" id="divmonto">
                     <div class="form-group">
                         <label>Monto Promesa: * (solo monto)</label>
                         <input id="monto" name="monto" type="text" disabled="disabled" class="form-control required" data-mask="$ 999,999,999.99" >
                     </div>
                 </div>
             </div>
          <div class="row">
                  <div style="overflow:hidden;">
                      <div class="form-group">
                          <div class="row">
                              <div class="col-md-6">
                                  <div id="datetimepicker12"></div>
                              </div>
                          </div>
                      </div>
                  </div>
            </div>
            <input type="hidden" name="fechapp" id="fechapp" >
          </div>
              </div>

        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal" id="closeguarda" name="closeguarda" >Close</button>
                    <button type="submit" class="btn btn-primary" id="guarda" name="guarda" onclick="guardainteraccion()">Guardar interaccion</button>
                    <!--<button type="button" class="btn btn-primary" id="guarda" name="guarda" onclick="guardainteraccion()">Guardar interaccion</button>-->
                </div>
                </form>
            </div>
        </div>
    </div>
@else
<div class="wrapper wrapper-content">
 <div class="ibox-content inspinia-timeline" id="compromisoslistado">
   <div class="row">
     <center>
     <div class="col-lg-4">
         <div class="form-group">
             <label>Sin registros para marcar </label>
         </div>
     </div>
   </center>
   </div>
 </div>
</div>
@endif

</body>


</html>
