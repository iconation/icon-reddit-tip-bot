<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{env('APP_NAME')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        <link rel="stylesheet" href="https://iconation.team/css/leaflet.css" />
        <link rel="stylesheet" href="https://iconation.team/css/animate.css">
        <link rel="stylesheet" href="https://iconation.team/css/icomoon.css">
        <link rel="stylesheet" href="https://iconation.team/css/simple-line-icons.css">
        <link rel="stylesheet" href="https://iconation.team/css/magnific-popup.css">
        <link rel="stylesheet" href="https://iconation.team/css/bootstrap.css">
        <link rel="stylesheet" href="https://iconation.team/css/style4.css">
        <script src="https://code.iconify.design/1/1.0.0-rc7/iconify.min.js"></script>
        <link rel="stylesheet" href="https://iconation.team/css/custom1.css">
        <link rel="stylesheet" href="https://iconation.team/css/custom2.css">
        <script src="https://iconation.team/js/modernizr-2.6.2.min.js"></script>



    </head>
    <body>
    <header role="banner" id="fh5co-header" class="">
        <div class="container">

            <nav class="navbar navbar-default">
                <div class="navbar-header">

                    <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"><i></i></a>
                    <a class="navbar-brand" href="{{route('dashboard')}}">ICONation</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="{{route('reddit.login', 'reddit')}}"><span>Login</span></a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <section id="fh5co-home" data-section="home" data-stellar-background-ratio="0.5" class="animated" style="background-position: 0 0;">

        <div class="gradient video-container">
            <video playsinline="" autoplay="" muted="" loop="" poster="https://iconation.team/images/flag_static.png" id="bgvideo" width="x" height="y">
                <source src="https://iconation.team/video/ICONation.mp4" type="video/mp4">
            </video>
        </div>

        <div class="container">
            <div class="text-wrap">
                <div class="text-inner">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h1 class="to-animate iconation_title fadeInUp animated">ICONation Reddit Tipper</h1>
                            <h2 class="to-animate iconation_title fadeInUp animated">Tip reddit users, using ICX</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="slant"></div>
    </section>
    </body>
</html>
