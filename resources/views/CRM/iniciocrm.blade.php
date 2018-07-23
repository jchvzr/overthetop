
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
<script src="js/jsespecificos/CRM/CRMInicio.js"></script>


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


@if (session('mensaje'))
  <div class="alert alert-warning" role="alert">
        <div>{{ session('mensaje') }}</div>
  </div>
@endif

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

    <form id="buscaclienteform" name="buscaclienteform"class="form-inline" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
          <input onkeypress="return pulsar(event)" type="text" placeholder="N&uacute;mero de cuenta..." class="form-control required" name="buscaclientetxt" id="buscaclientetxt">
          <button name="buscacliente" type="button" class="btn btn-primary" id="buscacliente" style="font-family: Arial;">Buscar cliente</button>
          <input onkeypress="return pulsar(event)" type="number" min="0000000000" max="9999999999" placeholder="Tel&eacute;fono a 10 digitos..." class="form-control required" name="buscatelinput" id="buscatelinput">
          <button name="buscatelefonobtn" type="button" class="btn btn-primary" id="buscatelefonobtn" style="font-family: Arial;">Buscar tel&eacute;fono</button>
    </form>
</div>
</div>

</div>

<div class="row">

    <div class="col-lg-12">
        <div class="panel blank-panel">
            <div class="panel-heading">
                <div class="panel-title m-b-md"><h4>CRM Ver cliente</h4></div>
                <div class="panel-options">
                    <ul class="nav nav-tabs">
                        <li class="active"><a id="elementobuscado" data-toggle="tab" href="#tab-1">Datos generales del cliente</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-2">Bit&aacute;cora de interacciones</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-3">Resumen de cliente</a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">

                <div class="tab-content">

                    <div id="tab-1" class="tab-pane active">
                    <div id="datos">
                      <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Cuenta: </label>
                                <input id="customerid" name="customerid" type="text" class="form-control" disabled="disabled">
                            </div>
                        </div>
                          <div class="col-lg-4">
                              <div class="form-group">
                                  <label>Nombre: </label>
                                  <input id="nombreCliente" name="nombreCliente" type="text" class="form-control" disabled="disabled">
                              </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="form-group">
                                  <label>Domicilio casa: </label>
                                  <input id="calleCasa" name="calleCasa" type="text" class="form-control" disabled="disabled">
                              </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="form-group">
                                  <label>Colonia casa: </label>
                                  <input id="coloniaCasa" name="coloniaCasa" type="text" class="form-control" disabled="disabled">
                              </div>
                          </div>

                          <div class="col-lg-4">
                              <div class="form-group">
                                  <label>Ciudad casa: </label>
                                  <input id="ciudadCasa" name="ciudadCasa" type="text" class="form-control" disabled="disabled">
                              </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="form-group">
                                  <label>CP casa: </label>
                                  <input id="cpCasa" name="cpCasa" type="text" class="form-control" disabled="disabled">
                              </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="form-group">
                                  <label>Domiclio trabajo: </label>
                                  <input id="calleTrabajo" name="calleTrabajo" type="text" class="form-control" disabled="disabled">
                              </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="form-group">
                                  <label>Colonia trabajo: </label>
                                  <input id="coloniaTrabajo" name="coloniaTrabajo" type="text" class="form-control" disabled="disabled">
                              </div>
                          </div>

                          <div class="col-lg-4">
                              <div class="form-group">
                                  <label>Ciudad trabajo: </label>
                                  <input id="ciudadTrabajo" name="ciudadTrabajo" type="text" class="form-control" disabled="disabled">
                              </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="form-group">
                                  <label>CP trabajo: </label>
                                  <input id="cpTrabajo" name="cpTrabajo" type="text" class="form-control" disabled="disabled">
                              </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="form-group">
                                  <label>Tel&eacute;fono1: </label>
                                  <input id="telefono1" name="telefono1" type="text" class="form-control" disabled="disabled">
                              </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="form-group">
                                  <label>Tel&eacute;fono2: </label>
                                  <input id="telefono2" name="telefono2" type="text" class="form-control" disabled="disabled">
                              </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="form-group">
                                  <label>Tel&eacute;fono3: </label>
                                  <input id="telefono3" name="telefono3" type="text" class="form-control" disabled="disabled">
                              </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="form-group">
                                  <label>Tel&eacute;fono4: </label>
                                  <input id="telefono4" name="telefono4" type="text" class="form-control" disabled="disabled">
                              </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="form-group">
                                  <label>Custom1: </label>
                                  <input id="custom1" name="custom1" type="text" class="form-control" disabled="disabled">
                              </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="form-group">
                                  <label>Custom2: </label>
                                  <input id="custom2" name="custom2" type="text" class="form-control" disabled="disabled">
                              </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="form-group">
                                  <label>Custom3: </label>
                                  <input id="custom3" name="custom3" type="text" class="form-control" disabled="disabled">
                              </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="form-group">
                                  <label>Custom4: </label>
                                  <input id="custom4" name="custom4" type="text" class="form-control" disabled="disabled">
                              </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="form-group">
                                  <label>Custom5: </label>
                                  <input id="custom5" name="custom5" type="text" class="form-control" disabled="disabled">
                              </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="form-group">
                                  <label>Custom6: </label>
                                  <input id="custom6" name="custom6" type="text" class="form-control" disabled="disabled">
                              </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="form-group">
                                  <label>Custom7: </label>
                                  <input id="custom7" name="custom7" type="text" class="form-control" disabled="disabled">
                              </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="form-group">
                                  <label>Custom8: </label>
                                  <input id="custom8" name="custom8" type="text" class="form-control" disabled="disabled">
                              </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="form-group">
                                  <label>Custom9: </label>
                                  <input id="custom9" name="custom9" type="text" class="form-control" disabled="disabled">
                              </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="form-group">
                                  <label>Custom10: </label>
                                  <input id="custom10" name="custom10" type="text" class="form-control" disabled="disabled">
                              </div>
                          </div>
                      </div>
                     </div>
                    </div>


                    <div id="tab-2" class="tab-pane">

                      <div id="bitacora">
                        <div class="row">

                       <div class="row">
                         <center>
                          <div class="col-lg-4">
                              <div class="form-group">
                                  <label>Cuenta: </label>
                                  <input id="customerid2" name="customerid2" type="text" class="form-control" disabled="disabled">
                              </div>
                          </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Nombre: </label>
                                    <input id="nombreCliente2" name="nombreCliente2" type="text" class="form-control" disabled="disabled">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {{-- <a id="irencuestaarrenda" href=""><button name="agregaInt" type="button" class="btn btn-primary" id="agregaInt" style="font-family: Arial;">Ir a encuesta ARRENDA +</button></a> --}}
                                    <button name="agregaInt" type="button" class="btn btn-primary" id="agregaInt" style="font-family: Arial;" data-toggle="modal" data-target="#agregaIntModal" onclick="chosechido()">Agregar Interacción</button>
                                </div>
                            </div>
                        </center>
                        </div>


                        <table class="table table-striped table-bordered table-hover dataTables-example"  id="interactiontable">
                                            <thead>
                                            <tr>

                                              <th>Fecha</th>
                                              <th>Tipo de interacci&oacute;n</th>
                                              <th>Usuario</th>
                                              <th>C&oacute;digo</th>
                                              <th>Comentario</th>



                                            </tr>
                                            </thead>
                                            <tbody id="tableInteraccion">


                                            </tbody>
                                            <tfoot>
                                            <tr>
                                              <th>Fecha</th>
                                              <th>Usuario</th>
                                              <th>Tipo de interacci&oacute;n</th>
                                              <th>C&oacute;digo</th>
                                              <th>Comentario</th>

                                            </tr>
                                            </tfoot>
                                            </table>

                      </div>
                    </div>

                    </div>


                    <div id="tab-3" class="tab-pane">
                      <div class="row">
                       <div id="graficocodificaciones">
                        <center> <h2>Resumen de codigos &uacute;ltimo mes</h2> </center>
                        <div class="flot-chart">
                            <div class="flot-chart-content" id="flot-bar-chart" height=500px></div>
                        </div>
                       </div>
                      </div>
                   </div>
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
                <h4 class="modal-title">Agrega los resultados de la interacci&oacute;n</h4>
            </div>
            <div class="modal-body">
            <form id="formagregainteraccion" action="/crm/guardainteraccion" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
             <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
             <input id="customerid3" name="customerid3" type="hidden" class="form-control">

              <div class="row">
               <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Cuenta: </label>
                        <input id="customeridmodal" name="customeridmodal" type="text" class="form-control" disabled="disabled">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Nombre: </label>
                        <input id="nombreClienteModal" name="nombreClienteModal" type="text" class="form-control" disabled="disabled">
                    </div>
                </div>
              </div>

              <div class="col-lg-6">
                  <div class="form-group">
                      <label>Tipo de interacci&oacute;n *</label>
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
                      <label>C&oacute;digo *</label>
                      <select id="dispositions" name="dispositions" class="chosen-select form-control required" tabindex="2">
                        <option value="" ></option>

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
                <button type="submit" class="btn btn-primary" id="guarda" name="guarda" onclick="guardainteraccion()">Guardar interacci&oacute;n</button>
                <!--<button type="button" class="btn btn-primary" id="guarda" name="guarda" onclick="guardainteraccion()">Guardar interaccion</button>-->
            </div>
            </form>
        </div>
    </div>
</div>



<!-- modal busqueda telefono -->


<div class="modal inmodal" id="buscatelefonomodal" name="buscatelefono" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated flipInX">
            <div class="modal-header">
                <button type="button" class="close" onclick="cierramodal();"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Lista de tel&eacute;fonos encontrados</h4>
                <h5 class="modal-title">Elige el cliente a buscar</h5>
            </div>
            <div class="modal-body">

              <table class="table table-striped table-bordered table-hover dataTables-example"  id="clientetable">
                                  <thead>
                                  <tr>

                                    <th>Cuenta/n&uacute;mero cliente</th>
                                    <th>Nombre cliente</th>

                                  </tr>
                                  </thead>
                                  <tbody id="clientetablebody">



                                  </tbody>
                                  <tfoot>
                                  <tr>

                                    <th>Cuenta/n&uacute;mero cliente</th>
                                    <th>Nombre cliente</th>

                                  </tr>
                                  </tfoot>
                                  </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal" id="closebuscatelefono" name="closebuscatelefono" onclick="cierramodal();" >Close</button>
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
