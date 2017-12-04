
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
                             <div class="stat-percent font-bold text-success"><?=$sum/$countcompro?> <i class="fa fa-usd"></i></div>
                             <small>Monto Promedio</small>
                         </div>
                     </div>
                 </div>
                 <div class="col-sm-6">
                     <div class="ibox float-e-margins">
                         <div class="ibox-title">
                             <span class="label label-info pull-right">A 7 dias</span>
                             <h5>Compromisos</h5>
                         </div>
                         <div class="ibox-content">
                             <h1 class="no-margins"><span style="float:left">#<?=$countcomprow?></span><span style="float:right">$<?=$sumw?> </span></h1>
                           </br>
                           </br>
                             <div class="stat-percent font-bold text-info"><?=$sumw/$countcomprow?>  <i class="fa fa-usd"></i></div>
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
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Resumen del: <?=$inicio ?> al <?=$final ?></h5>
                                    <div class="pull-right">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-white">Hoy</button>
                                            <button type="button" class="btn btn-xs btn-white active">Semana anterior</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="ibox-content">
                                    <div class="row">
                                    <div class="col-lg-9">
                                        <div class="flot-chart">
                                            <div class="flot-chart-content" id="flot-dashboard-chart" ></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <ul class="stat-list">
                                            <li>
                                                <h2 class="no-margins"><?=$clientesinteraccion->codigos ?></h2>
                                                <small>Total de codigos ingresados</small>
                                                <h2 class="no-margins"><?=$clientesinteraccion->contacto ?></h2>
                                                <small>Total de contactos</small>
                                                <div class="stat-percent"><?=($clientesinteraccion->contacto / $clientesinteraccion->codigos) * 100?>% <i class="fa fa-level-down text-navy"></i></div>
                                                <div class="progress progress-mini">
                                                    <div style="width: <?=($clientesinteraccion->contacto / $clientesinteraccion->codigos) * 100?>%;" class="progress-bar"></div>
                                                </div>
                                            </li>
                                            <li>
                                                <h2 class="no-margins "><?=$clientesinteraccion->rpc ?></h2>
                                                <small>Total de rpc</small>
                                                <div class="stat-percent"><?=($clientesinteraccion->rpc / $clientesinteraccion->contacto) * 100?>% <i class="fa fa-level-down text-navy"></i></div>
                                                <div class="progress progress-mini">
                                                    <div style="width: <?=($clientesinteraccion->rpc / $clientesinteraccion->contacto) * 100?>%;" class="progress-bar"></div>
                                                </div>
                                            </li>
                                            <li>
                                                <h2 class="no-margins "><?=$clientesinteraccion->exito ?></h2>
                                                <small>Total de exitos</small>
                                                <div class="stat-percent"><?=($clientesinteraccion->exito / $clientesinteraccion->rpc) * 100?>% <i class="fa fa-bolt text-navy"></i></div>
                                                <div class="progress progress-mini">
                                                    <div style="width: <?=($clientesinteraccion->exito / $clientesinteraccion->rpc) * 100?>%;" class="progress-bar"></div>
                                                </div>
                                            </li>
                                            </ul>
                                        </div>
                                    </div>
                                    </div>

                                </div>
                            </div>
                        </div>


  <div class="row">
        <div class="col-lg-12">
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
                            <th>Revisado</th>
                            <th>Fecha y hora</th>
                            <th>Comentario</th>
                            <th>Monto</th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php foreach($compromisos as $compromiso): ?>
                        <tr>
                            <td><small><?=$compromiso->hecho ?></small></td>
                            <td><i class="fa fa-clock-o"></i> <?=$compromiso->fechaFin ?></td>
                            <td><?=$compromiso->comentario ?></td>
                            <td class="text-navy"> <i class="fa fa-usd"></i> <?=$compromiso->monto ?> </td>
                        </tr>
                        <?php endforeach ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>

<div class="row">

  <div class="col-lg-12">
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
                      <th>Revisado</th>
                      <th>Fecha y hora</th>
                      <th>Comentario</th>
                      <th>Monto</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($compromisosw as $compromiso): ?>
                  <tr>
                      <td><small><?=$compromiso->hecho ?></small></td>
                      <td><i class="fa fa-clock-o"></i> <?=$compromiso->fechaFin ?></td>
                      <td><?=$compromiso->comentario ?></td>
                      <td class="text-navy"> <i class="fa fa-usd"></i> <?=$compromiso->monto ?> </td>
                  </tr>
                  <?php endforeach ?>

                  </tbody>
              </table>
          </div>
      </div>
  </div>
</div>


<script>
    $(document).ready(function() {

    //  <!-- Enable portlets --
WinMove();
    /*    setTimeout(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
            };
            toastr.error('Responsive Admin Theme', 'Bienvenido');

        }, 1300);*/


        var route3 = "/buscaclienteinteraccionresumen"
        $.get(route3, function(res){
          //Flot Bar Chart

          var barOptions = {
              series: {
                  bars: {
                      show: true,
                      barWidth: 0.6,
                      fill: true,
                      fillColor: {
                          colors: [{
                              opacity: 0.8
                          }, {
                              opacity: 0.8
                          }]
                      }
                  }
              },
              xaxis: {
                  mode: "categories",
                  tickDecimals: 0,
                  tickLength: 1
              },
              colors: ["#1ab394"],
              grid: {
                  color: "#999999",
                  hoverable: true,
                  clickable: true,
                  tickColor: "#D4D4D4",
                  borderWidth:0
              },
              legend: {
                  show: false
              },
              tooltip: true,
              tooltipOpts: {
                  content: "x: %x, y: %y"
              }
          };

        //  $.plot($("#flot-bar-chart"), [res], barOptions);
        });


    });




/*
var data2 = [
    [gd(2012, 1, 1), 7], [gd(2012, 1, 2), 6], [gd(2012, 1, 3), 4], [gd(2012, 1, 4), 8],
    [gd(2012, 1, 5), 9], [gd(2012, 1, 6), 7], [gd(2012, 1, 7), 5], [gd(2012, 1, 8), 4],
    [gd(2012, 1, 9), 7], [gd(2012, 1, 10), 8], [gd(2012, 1, 11), 9], [gd(2012, 1, 12), 6],
    [gd(2012, 1, 13), 4], [gd(2012, 1, 14), 5], [gd(2012, 1, 15), 11], [gd(2012, 1, 16), 8],
    [gd(2012, 1, 17), 8], [gd(2012, 1, 18), 11], [gd(2012, 1, 19), 11], [gd(2012, 1, 20), 6],
    [gd(2012, 1, 21), 6], [gd(2012, 1, 22), 8], [gd(2012, 1, 23), 11], [gd(2012, 1, 24), 13],
    [gd(2012, 1, 25), 7], [gd(2012, 1, 26), 9], [gd(2012, 1, 27), 9], [gd(2012, 1, 28), 8],
    [gd(2012, 1, 29), 5], [gd(2012, 1, 30), 8], [gd(2012, 1, 31), 25]
];

var data3 = [
    [gd(2012, 1, 1), 800], [gd(2012, 1, 2), 500], [gd(2012, 1, 3), 600], [gd(2012, 1, 4), 700],
    [gd(2012, 1, 5), 500], [gd(2012, 1, 6), 456], [gd(2012, 1, 7), 800], [gd(2012, 1, 8), 589],
    [gd(2012, 1, 9), 467], [gd(2012, 1, 10), 876], [gd(2012, 1, 11), 689], [gd(2012, 1, 12), 700],
    [gd(2012, 1, 13), 500], [gd(2012, 1, 14), 600], [gd(2012, 1, 15), 700], [gd(2012, 1, 16), 786],
    [gd(2012, 1, 17), 345], [gd(2012, 1, 18), 888], [gd(2012, 1, 19), 888], [gd(2012, 1, 20), 888],
    [gd(2012, 1, 21), 987], [gd(2012, 1, 22), 444], [gd(2012, 1, 23), 999], [gd(2012, 1, 24), 567],
    [gd(2012, 1, 25), 786], [gd(2012, 1, 26), 666], [gd(2012, 1, 27), 888], [gd(2012, 1, 28), 900],
    [gd(2012, 1, 29), 178], [gd(2012, 1, 30), 555], [gd(2012, 1, 31), 993]
];
*/

var data2 = [
  [gd(2017, 11, 29), 5], [gd(2017, 12, 1), 8], [gd(2017, 12, 2), 1]
];

var data3 = [
[gd(2017, 11, 29), 800], [gd(2017, 12, 1), 500], [gd(2017, 12, 2), 1000]
];


var dataset = [
    {
        label: "Monto",
        data: data3,
        color: "#1ab394",
        bars: {
            show: true,
            align: "center",
            barWidth: 24 * 60 * 60 * 600,
            lineWidth:0
        }

    }, {
        label: "Cantidad de compromisos",
        data: data2,
        yaxis: 2,
        color: "#464f88",
        lines: {
            lineWidth:1,
                show: true,
                fill: true,
            fillColor: {
                colors: [{
                    opacity: 0.2
                }, {
                    opacity: 0.2
                }]
            }
        },
        splines: {
            show: false,
            tension: 0.6,
            lineWidth: 1,
            fill: 0.1
        },
    }
];


var options = {
    xaxis: {
        mode: "time",
        tickSize: [1, "day"],
        tickLength: 0,
        axisLabel: "Date",
        axisLabelUseCanvas: true,
        axisLabelFontSizePixels: 12,
        axisLabelFontFamily: 'Arial',
        axisLabelPadding: 10,
        color: "#d5d5d5"
    },
    yaxes: [{
        position: "left",
        max: 1070,
        color: "#d5d5d5",
        axisLabelUseCanvas: true,
        axisLabelFontSizePixels: 12,
        axisLabelFontFamily: 'Arial',
        axisLabelPadding: 3
    }, {
        position: "right",
        clolor: "#d5d5d5",
        axisLabelUseCanvas: true,
        axisLabelFontSizePixels: 12,
        axisLabelFontFamily: ' Arial',
        axisLabelPadding: 67
    }
    ],
    legend: {
        noColumns: 1,
        labelBoxBorderColor: "#000000",
        position: "nw"
    },
    grid: {
        hoverable: true,
        borderWidth: 0
    },
    tooltip: true,
    tooltipOpts: {
        content: "x: %x, y: %y"
    }
};

            function gd(year, month, day) {
                return new Date(year, month - 1, day).getTime();
            }

            var previousPoint = null, previousLabel = null;

            $.plot($("#flot-dashboard-chart"), dataset, options);
</script>


@endsection
