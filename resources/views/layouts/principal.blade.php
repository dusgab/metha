<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{url('recursos/images/favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{url('recursos/images/favicon.ico')}}" type="image/x-icon">

    <title>METH - Mercado Electrónico de Transacciones Hortícolas</title>
    
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/Pretty-Footer.css')}}">
    <link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/css?family=Cookie')}}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome.min.css')}}">
    
    <script type="text/javascript" src="{{ asset('assets/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/miscript.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
   
</head>

<body>
        
    <div class="container-fluid trans">
        
    <nav class="navbar navbar-default">
        
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand navbar-link" href="{{ url('/') }}" target="_parent"><img src="{{url('recursos/images/banner.png')}}" class="img-logo"></a>
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>

                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav navbar-right">
                        @guest
                                <li role="presentation"><a href="{{ route('login') }}">Acceder</a></li>
                                <li role="presentation"><a href="{{ route('register') }}">Registrarme</a></li>
                        @elseif (Auth::user()->admin === 1)

                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }}<span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                Cerrar Sesion
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </li>

                        @else
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li role="presentation"><a href="/usuario/show/{{Auth::user()->id}}">Perfil</a></li>
                                        <li>
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                Cerrar Sesion
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
            
            
        </div>

    </nav>
    @guest

    @elseif(Auth::user()->admin === 1)
        @include('admin.menu')
    @else
        @include('usuario.menu')
        @if(Auth::user()->activo === 0)
                            
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger activo" role="alert">
                            <strong>Su cuenta aún no esta activa para realizar operaciones. Un Administrador verificará sus datos.</strong>
                            </div>
                        </div>
                    </div>
        @endif
    @endguest
    <div class="container-fluid principal">
        
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>{{Session::get('message')}}</strong>
            </div>
        @endif
        @yield('content')

    </div>

        <footer>
            <div class="row">
                <div class="col-md-4 col-sm-6 footer-navigation">
                    <h3><a href="{{ url('/') }}"><span>METHA </span></a></h3>
                    <p class="links"><a href="{{ url('/') }}">Inicio </a><strong> · </strong><a href="{{ url('/ofertas') }}">Ofertas </a><strong> · </strong><a href="{{ url('/demandas') }}">Demandas </a><strong> · </strong><a href="{{ url('/precios') }}">Precios </a><strong> · </strong><a href="{{ url('/operaciones') }}">Operaciones </a></p>
                    <p class="company-name">METHA © <?php echo Date("Y"); ?></p>
                </div>
                <div class="col-md-4 col-sm-6 footer-contacts">
                    <div><span class="fa fa-map-marker footer-contacts-icon"> </span>
                        <p>Perú 1186, Corrientes, Argentina</p>
                    </div>
                    <div><i class="fa fa-phone footer-contacts-icon"></i>
                        <p class="footer-center-info email text-left">+54 03794-4431360</p>
                    </div>
                    <div><i class="fa fa-envelope footer-contacts-icon"></i>
                        <p> <a href="#" target="_blank">dircoopctes@gmail.com</a></p>
                    </div>
                </div>
                <div class="clearfix visible-sm-block"></div>
                <div class="col-md-4 footer-about">
                    <div class="col-md-12 footer-logo">
                        <img class="img-responsive img-logo-ctes" src="{{url('recursos/images/logo.png')}}">
                    </div>
                    <div class="col-md-12">
                        <p class="titulos-logo">Dirección de Cooperativas</p>
                        <p class="titulos-logo">Ministerio de Producción</p>
                    </div>
                    <div class="social-links social-icons"><a href="https://www.facebook.com/Ministerio-de-Producción-de-Corrientes-1424236394481898/"><i class="fa fa-facebook"></i></a><a href="https://twitter.com/uopcorrientes"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-linkedin"></i></a></div>
                </div>
            </div>
            
        </footer>
    </div>

    </body>
</html>