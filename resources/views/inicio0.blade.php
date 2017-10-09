
@extends('layouts.principal')

@section('title', 'Main page')

@section('content')


<!-- Flot -->
<script src="js/plugins/flot/jquery.flot.js"></script>
<script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="js/plugins/flot/jquery.flot.resize.js"></script>
<script src="js/plugins/flot/jquery.flot.pie.js"></script>
<script src="js/plugins/flot/jquery.flot.time.js"></script>

<div class="row  border-bottom white-bg dashboard-header">
<div class="row">
       <div class="col-sm-3">
           <h2>Bienvenido <?=$datauser->nombre ?></h2>
      <!--     <small>You have 42 messages and 6 notifications.</small>
           <ul class="list-group clear-list m-t">
               <li class="list-group-item fist-item">
                   <span class="pull-right">
                       09:00 pm
                   </span>
                   <span class="label label-success">1</span> Please contact me
               </li>
               <li class="list-group-item">
                   <span class="pull-right">
                       10:16 am
                   </span>
                   <span class="label label-info">2</span> Sign a contract
               </li>
               <li class="list-group-item">
                   <span class="pull-right">
                       08:22 pm
                   </span>
                   <span class="label label-primary">3</span> Open new shop
               </li>
               <li class="list-group-item">
                   <span class="pull-right">
                       11:06 pm
                   </span>
                   <span class="label label-default">4</span> Call back to Sylvia
               </li>
               <li class="list-group-item">
                   <span class="pull-right">
                       12:00 am
                   </span>
                   <span class="label label-primary">5</span> Write a letter to Sandra
               </li>
           </ul> -->
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

     <div class="row">
     <div class="flot-chart-content" id="flot-bar-chart" style="height:300px;"></div>
      </div>
</div>



<script>
    $(document).ready(function() {
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

          $.plot($("#flot-bar-chart"), [res], barOptions);
        });


    });
</script>


@endsection
