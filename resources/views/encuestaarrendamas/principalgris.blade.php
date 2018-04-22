
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>
  <link rel="shortcut icon" href="/img/solologooverthetop.png" />
    <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/css/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{asset('/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('/css/style.css')}}" rel="stylesheet">

    @stack('css-adicional')


</head>

<body class="@yield('body-class')">


    @yield('content')


  <!-- Mainly scripts -->
  <script src="{{asset('/js/jquery-2.1.1.js')}}"></script>
  <script src="{{asset('/js/bootstrap.min.js')}}"></script>



    @stack('script-adicional')


  </body>

  </html>
