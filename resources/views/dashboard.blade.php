<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Welcome</title>
    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">
    <!-- Styles -->
    <link href="{{asset('focus/assets/css/lib/calendar2/pignose.calendar.min.css')}}" rel="stylesheet">
    <link href="{{asset('focus/assets/css/lib/chartist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{asset('focus/assets/css/lib/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('focus/assets/css/lib/themify-icons.css')}}" rel="stylesheet">
    <link href="{{asset('focus/assets/css/lib/owl.carousel.min.css')}}" rel="stylesheet" />
    <link href="{{asset('focus/assets/css/lib/owl.theme.default.min.css')}}" rel="stylesheet" />
    <link href="{{asset('focus/assets/css/lib/weather-icons.css')}}" rel="stylesheet" />
    <link href="{{asset('focus/assets/css/lib/menubar/sidebar.css')}}" rel="stylesheet">
    <link href="{{asset('focus/assets/css/lib/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('focus/assets/css/lib/helper.css')}}" rel="stylesheet">
    <link href="{{asset('focus/assets/css/style.css')}}" rel="stylesheet">
</head>

<body>

    <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
        <div class="nano">
            <div class="nano-content">
                <ul>
                    <div class="logo"><a href="index.html">
                            <!-- <img src="assets/images/logo.png" alt="" /> --><span>BAPPEDA</span>
                        </a>
                    </div>
                    <li class="label">Main</li>
                    <li>
                        <a href="/"><i class="ti-home"></i> Dashboard</a>
                    </li>
                    <li class="label">Apps</li>
                    <li>
                        <a href="/ikp"><i class="ti-plus"></i> Indeks Kualitas Perencanaan </a>
                    </li>
                    <li><a href="{{route('logout')}}"><i class="ti-power-off"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /# sidebar -->

    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="float-left">
                        <div class="hamburger sidebar-toggle">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        </div>
                    </div>
                    <div class="float-right">
                        <div class="dropdown dib">
                            <div class="header-icon" data-toggle="dropdown">
                                <span class="user-avatar">
                                    <strong>{{auth()->user()->name}}</strong>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Selamat Datang, <b>{{auth()->user()->name}}</b></h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Home</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">
                    <div class="row">
                        
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- jquery vendor -->
    <script src="{{asset('focus/assets/js/lib/jquery.min.js')}}"></script>
    <script src="{{asset('focus/assets/js/lib/jquery.nanoscroller.min.js')}}"></script>
    <!-- nano scroller -->
    <script src="{{asset('focus/assets/js/lib/menubar/sidebar.js')}}"></script>
    <script src="{{asset('focus/assets/js/lib/preloader/pace.min.js')}}"></script>
    <!-- sidebar -->

    <script src="{{asset('focus/assets/js/lib/bootstrap.min.js')}}"></script>
    <script src="{{asset('focus/assets/js/scripts.js')}}"></script>
    <!-- bootstrap -->

    <script src="{{asset('focus/assets/js/lib/calendar-2/moment.latest.min.js')}}"></script>
    <script src="{{asset('focus/assets/js/lib/calendar-2/pignose.calendar.min.js')}}"></script>
    <script src="{{asset('focus/assets/js/lib/calendar-2/pignose.init.js')}}"></script>

    <script src="{{asset('focus/assets/js/lib/weather/jquery.simpleWeather.min.js')}}"></script>
    <script src="{{asset('focus/assets/js/lib/weather/weather-init.js')}}"></script>
    <script src="{{asset('focus/assets/js/lib/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{asset('focus/assets/js/lib/circle-progress/circle-progress-init.js')}}"></script>
    <script src="{{asset('focus/assets/js/lib/chartist/chartist.min.js')}}"></script>
    <script src="{{asset('focus/assets/js/lib/sparklinechart/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('focus/assets/js/lib/sparklinechart/sparkline.init.js')}}"></script>
    <script src="{{asset('focus/assets/js/lib/owl-carousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('focus/assets/js/lib/owl-carousel/owl.carousel-init.js')}}"></script>
    <!-- scripit init-->
    <script src="{{asset('focus/assets/js/dashboard2.js"></script>
</body>

</html>