<!DOCTYPE html>
<html lang="pt-br" ng-app="ctfplatform">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
      @yield('titulo')
    </title>
    <!-- Styles and Fonts -->
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/css/beautify.min.css') !!}" />
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/css/font-awesome.min.css') !!}" />
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/css/main.css') !!}" />
    <!-- Scripts -->
    <script src="{!! asset('assets/js/beautify.min.js') !!}"></script>
</head>
<body>
<header>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        <i class="fa fa-flag fa-lg"></i>
                        {{getenv('CTF_NAME', true)}}
                    </a>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="@yield('home')"><a href="{{route('root')}}"><i class="fa fa-dashboard" aria-hidden="true"></i> @lang('admin.home')<span class="sr-only">(current)</span></a></li>
                    <li class="@yield('permissions')"><a href="{{route('permissions')}}"><i class="fa fa-users" aria-hidden="true"></i> @lang('admin.permissions')</a></li>
                    <li class="@yield('maestrias')"><a href="{{route('maestrias')}}"><i class="fa fa-certificate" aria-hidden="true"></i> @lang('admin.maestria')</a></li>
                    <li class="@yield('categories')"><a href="{{route('categorias')}}"><i class="fa fa-group" aria-hidden="true"></i> @lang('admin.categories')</a></li>
                    <li class="@yield('challs')"><a href="{{route('adminChall')}}"><i class="fa fa-flag" aria-hidden="true"></i> @lang('admin.challs')</a></li>
                    <li class="@yield('team')"><a href=""><i class="fa fa-users" aria-hidden="true"></i> @lang('admin.team')</a></li>
                    <li class="@yield('users')"><a href=""><i class="fa fa-user" aria-hidden="true"></i> @lang('admin.users')</a></li>
                    <li><a href="{{route('logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i> @lang('admin.logout')</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>
<div class="container-fluid">
    @yield('conteudo')
    <div class="espacos"></div><div class="espacos"></div>
</div>
@include('layout.footer')
</body>
</html>
