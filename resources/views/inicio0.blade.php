
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
<script src="js/jsespecificos/layoutarriba/inicio0.js"></script>

<div class="row  border-bottom white-bg dashboard-header">

<div class="row">

       <div class="col-sm-3">

           <h2>Bienvenido <?=$datauser->nombre ?></h2>

       </div>
 </div>
 </div>


<!--
       <div class="col-sm-3">
           <div class="statistic-box">
           <h4>
               Project Beta progress
           </h4>
           <p>
               You have two project with not compleated task.
           </p>
               <div class="row text-center">
                   <div class="col-lg-6">
                       <canvas id="polarChart" width="80" height="80"></canvas>
                       <h5 >Kolter</h5>
                   </div>
                   <div class="col-lg-6">
                       <canvas id="doughnutChart" width="78" height="78"></canvas>
                       <h5 >Maxtor</h5>
                   </div>
               </div>
               <div class="m-t">
                   <small>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
               </div>

           </div>
       </div>
     -->
<div class="wrapper wrapper-content">
     <div class="row">
                 <div class="col-sm-6">
                     <div class="ibox float-e-margins">
                         <div class="ibox-title">
                             <span class="label label-success pull-right">Hoy</span>
                             <h5>Compromisos</h5>
                         </div>
                         <div class="ibox-content">
                             <h1 class="no-margins"><span style="float:left">#<?=$countcompro?></span><span style="float:right">$<?=$sum?> </span></h1>
                           </br>
                           </br>
                             <div class="stat-percent font-bold text-success"><?php if($countcompro == 0): echo(0); else: echo($sum/$countcompro); endif?> <i class="fa fa-usd"></i></div>
                             <small>Monto Promedio</small>
                         </div>
                     </div>
                 </div>
                 <div class="col-sm-6">
                     <div class="ibox float-e-margins">
                         <div class="ibox-title">
                             <span class="label label-info pull-right">Proximos 7 dias</span>
                             <h5>Compromisos</h5>
                         </div>
                         <div class="ibox-content">
                             <h1 class="no-margins"><span style="float:left">#<?=$countcomprow?></span><span style="float:right">$<?=$sumw?> </span></h1>
                           </br>
                           </br>
                             <div class="stat-percent font-bold text-info"><?php if($countcomprow == 0): echo(0); else: echo($sumw/$countcomprow); endif?>  <i class="fa fa-usd"></i></div>
                             <small>Monto Promedio</small>
                         </div>
                     </div>
                 </div>
      <!--
                 <div class="col-sm-3">
                     <div class="ibox float-e-margins">
                         <div class="ibox-title">
                             <span class="label label-primary pull-right">Hoy</span>
                             <h5># 1 en compromisos</h5>
                         </div>
                         <div class="ibox-content">
                            <h1 class="no-margins"><img alt="image" class="img-circle" src="/img/overthetop60.jpg" />5</h1>
                             <div class="stat-percent font-bold text-navy">100 <i class="fa fa-usd"></i></div>
                             <small>Monto</small>
                         </div>
                     </div>
                 </div>
                 <div class="col-sm-3">
                     <div class="ibox float-e-margins">
                         <div class="ibox-title">
                             <span class="label label-danger pull-right">Semana</span>
                             <h5># 1 en compromisos</h5>
                         </div>
                         <div class="ibox-content">
                             <h1 class="no-margins"><img alt="image" class="img-circle" src="/img/overthetop60.jpg" /> 5</h1>
                             <div class="stat-percent font-bold text-danger">80<i class="fa fa-usd"></i></div>
                             <small>Monto</small>
                         </div>
                     </div>
         </div>-->
     </div>
     </div>
                <div class="row">

                        <div class="col-lg-9">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Resumen de compromisos del: <?=$inicio ?> al <?=$final ?></h5>

                                </div>
                                <div class="ibox-content">

                                    <div class="row">

                                    <div class="col-lg-9">
                                      <div class="flot-chart">

                                          <div class="flot-chart-content" id="flot-dashboard-chart" ></div>
                                      </div>

                                    </div>
                                    </div>
                                </div>
                             </div>
                        </div>

                                    <div class="col-lg-3">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-title">
                                              <h5>Resumen de hoy:</h5>
                                          <!--<div class="btn-group">
                                              <button id="1" type="button" class="btn btn-xs btn-white" value="1" onclick="filtra(this.value);">Hoy</button>
                                              <button id="2" type="button" class="btn btn-xs btn-white" value="2" onclick="filtra(this.value);">Ultimos 7 dias </button>
                                          </div>-->
                                      </div>
                                      <div class="ibox-content">
                                        <ul class="stat-list">
                                            <li>
                                                <h2 class="no-margins"><?=$clientesinteraccion->codigos ?></h2>
                                                <small>Total de codigos ingresados</small>
                                                <h2 class="no-margins"><?=$clientesinteraccion->contacto ?></h2>
                                                <small>Total de contactos</small>
                                                <div class="stat-percent"><?php if (($clientesinteraccion->codigos)==0): echo(0); else: echo(($clientesinteraccion->contacto / $clientesinteraccion->codigos) * 100 );endif ?>% <i class="fa fa-level-down text-navy"></i></div>
                                                  <div class="progress progress-mini">
                                                      <div style="width: <?php if (($clientesinteraccion->codigos)==0): echo(0); else: echo(($clientesinteraccion->contacto / $clientesinteraccion->codigos) * 100 );endif ?>%;" class="progress-bar"></div>
                                                  </div>
                                                </li>
                                                <li>
                                                    <h2 class="no-margins "><?=$clientesinteraccion->rpc ?></h2>
                                                    <small>Total de rpc</small>
                                                    <div class="stat-percent"><?php if ($clientesinteraccion->contacto==0): echo(0); else: echo(($clientesinteraccion->rpc / $clientesinteraccion->contacto) * 100); endif?>% <i class="fa fa-level-down text-navy"></i></div>
                                                      <div class="progress progress-mini">
                                                          <div style="width: <?php if ($clientesinteraccion->contacto==0): echo(0); else: echo(($clientesinteraccion->rpc / $clientesinteraccion->contacto) * 100); endif?>%;" class="progress-bar"></div>
                                                      </div>
                                                </li>
                                                <li>
                                                  <h2 class="no-margins "><?=$clientesinteraccion->exito ?></h2>
                                                   <small>Total de exitos</small>
                                                   <div class="stat-percent"><?php if ($clientesinteraccion->rpc==0): echo(0); else: echo(($clientesinteraccion->exito / $clientesinteraccion->rpc) * 100); endif?>% <i class="fa fa-bolt text-navy"></i></div>
                                                   <div class="progress progress-mini">
                                                       <div style="width: <?php if ($clientesinteraccion->rpc==0): echo(0); else: echo(($clientesinteraccion->exito / $clientesinteraccion->rpc) * 100); endif?>%;" class="progress-bar"></div>
                                                   </div>
                                               </li>

                                            </ul>
                                        </div>
            </div>
</div>
</div>


  <div class="row">
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Resumen de compromisos para hoy</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>

                    </div>
                </div>
                <div class="ibox-content">

                    <table class="table table-hover no-margins">
                        <thead>
                        <tr>
                            <th>Fecha y hora</th>
                            <th>Monto</th>
                            <th>Cuenta </th>
                            <th>Nombre</th>
                            <th>Comentario</th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php foreach($compromisos as $compromiso): ?>
                        <tr>
                            <td><i class="fa fa-clock-o"></i> <?=$compromiso->fechaFin ?></td>
                            <td><i class="fa fa-usd"></i> <?=$compromiso->monto ?></td>
                            <th><?=$compromiso->customerid ?> </th>
                            <th><?=$compromiso->nombreCliente ?></th>
                            <td class="text-navy"> <?=$compromiso->comentario ?> </td>
                        </tr>
                        <?php endforeach ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


  <div class="col-lg-6">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
              <h5>Resumen de compromisos para los siguientes 7 dias</h5>
              <div class="ibox-tools">
                  <a class="collapse-link">
                      <i class="fa fa-chevron-up"></i>
                  </a>

              </div>
          </div>
          <div class="ibox-content">
              <table class="table table-hover no-margins">
                  <thead>
                  <tr>
                    <th>Fecha y hora</th>
                    <th>Monto</th>
                    <th>Cuenta </th>
                    <th>Nombre</th>
                    <th>Comentario</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($compromisosw as $compromiso): ?>
                  <tr>
                    <td><i class="fa fa-clock-o"></i> <?=$compromiso->fechaFin ?></td>
                    <td><i class="fa fa-usd"></i> <?=$compromiso->monto ?></td>
                    <th><?=$compromiso->customerid ?> </th>
                    <th><?=$compromiso->nombreCliente ?></th>
                    <td class="text-navy"> <?=$compromiso->comentario ?> </td>
                  </tr>
                  <?php endforeach ?>

                  </tbody>
              </table>
          </div>
      </div>
  </div>
</div>



@endsection
