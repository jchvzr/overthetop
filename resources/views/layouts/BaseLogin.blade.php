
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <link rel="shortcut icon" href="/img/solologooverthetop.png" />
    <title>OVER THE TOP SERVICES</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/login.css">

</head>

<body class="gray-bg">

    <div class="card card-container text-center loginscreen  animated fadeInDown">
        <div>
            <div>


            </div>
            <h3 style="color:white;">OVER THE TOP SERVICES</h3>

            <p style="color:white;">Login in</p>


@yield('content')

        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="/js/jquery-2.1.1.js"></script>
    <script src="/js/bootstrap.min.js"></script>

</body>

</html>
