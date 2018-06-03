<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>RedFlox</title>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
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
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <!--Container Ini-->
        <div class="container">
        <!--Row Ini 1-->
            <div class="row">
              
            </div>
        <!--Row Fin 1-->
        <!--Row Ini 2-->
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Dashboard</div>

                        <div class="panel-body">
                           
                        </div>
                    </div>
                </div>
            </div>
        <!--Row Fin 2-->
        <!--Row Ini 3-->
            <div class="row">
              <div class="col-md-1">.col-md-1</div>
              <div class="col-md-1">.col-md-1</div>
              <div class="col-md-1">.col-md-1</div>
              <div class="col-md-1">.col-md-1</div>
              <div class="col-md-1">.col-md-1</div>
              <div class="col-md-1">.col-md-1</div>
              <div class="col-md-1">.col-md-1</div>
              <div class="col-md-1">.col-md-1</div>
              <div class="col-md-1">.col-md-1</div>
              <div class="col-md-1">.col-md-1</div>
              <div class="col-md-1">.col-md-1</div>
              <div class="col-md-1">.col-md-1</div>
            </div>
        <!--Row Fin 3-->
        <!--Row Ini 4-->
            <div class="row">
              <div class="col-md-8">.col-md-8</div>
              <div class="col-md-4">.col-md-4</div>
            </div>
        <!--Row Fin 4-->
        <!--Row Ini 5-->
            <div class="row">
              <div class="col-md-4">.col-md-4</div>
              <div class="col-md-4">.col-md-4</div>
              <div class="col-md-4">.col-md-4</div>
            </div>
        <!--Row Fin 5-->
        <!--Row Ini 6-->
            <div class="row">
              <div class="col-md-6">.col-md-6</div>
              <div class="col-md-6">.col-md-6</div>
            </div>
        <!--Row Ini 6-->
        </div>
        <!--Container Fin-->
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
