<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>OVER THE TOP SERVICES - @yield('title')</title>

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

      <!-- notificaciones menu arriba -->
      <script src="js/jsespecificos/layoutarriba/notificacionesarriba.js"></script>
      <script>


        initControls();

      function initControls(){
      window.location.hash="red";
      window.location.hash="Red" //chrome
      window.onhashchange=function(){window.location.hash="red";}
      }

      </script>


</head>
<body>

  <!-- Wrapper-->
    <div id="wrapper">

        <!-- Menu izquierda -->
        @include('layouts.menuizquierda')

        <!-- Page wraper -->
        <div id="page-wrapper" class="gray-bg">

            <!-- Page wrapper -->
            @include('layouts.menuarriba')

            <!-- Main view  -->
            @yield('content')

            <!-- Footer -->
            @include('layouts.footer')

        </div>
        <!-- End page wrapper-->

    </div>
    <!-- End wrapper-->


@show

</body>


</html>
