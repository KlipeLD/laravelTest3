<!DOCTYPE html>
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License

Name       : SimpleWork
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20140225

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
    <link href="/css/default.css" rel="stylesheet" type="text/css" media="all" />
    <link href="/css/fonts.css" rel="stylesheet" type="text/css" media="all" />
    <link href="/css/sty.css" rel="stylesheet" type="text/css" media="all" />
    <link href="/css/footer.css" rel="stylesheet" type="text/css" media="all" />
    <link href="/css/left-nav-style.css" rel="stylesheet" type="text/css" media="all" />
    <script src='http://html5shiv.googlecode.com/svn/trunk/html5.js'></script>
    <script src='http://code.jquery.com/jquery-1.11.1.min.js'></script>
    <script src="https://use.fontawesome.com/ce3d8a7c5c.js"></script>
    @yield('head')


    <!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>
<body>
@auth
    <input type="checkbox" id="nav-toggle" hidden>
    <nav class='nav'>
        <label for='nav-toggle' class='nav-toggle' onclick></label>
        <div class='logo'>
            <a href='https://klipeld.github.io/'>Test Project 3</a> <br><br>
        </div>
        <ul>
            <li><a href='/aarticles'>Публикации</a>
            <li><a href='/acomments'>Комментарии</a>
            <li><a href='/acategory'>Категории</a>
            <li><a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                   {{ __('Выход') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
        </ul>
    </nav>
@endauth
<div id="app">

</div>
<div id="header-wrapper">
    <div id="header" class="container">
        <div id="menuAuth">
            <ul>
                @auth
                    <li class=""><a href="/home" accesskey="1" title="">Добро пожаловать на сайт, {{auth()->user()->name}}</a></li>
                @else
                    <li class=""><a href="/login" accesskey="1" title="">Авторизация</a></li>
                    <li class=""><a href="/register" accesskey="2" title="">Регистрация</a></li>
                @endauth

            </ul>
        </div>
        <div id="logo">
            <h1><a href="/">SimpleWork</a></h1><br>

        </div>

        <div>
            <form class="searchC" method="GET" action="{{route('articles.index')}}">
                <input class="searchC" type="text" name="search1" id="search1" placeholder="Искать здесь...">
                <button class="searchC" type="submit"></button>
            </form>
        </div>
        <div id="menu">
            <ul>
                <li class="{{Request::path() === '/' ? 'current_page_item' : ''}}"><a href="/" accesskey="1" title="">Главная страница</a></li>
                <li class="{{request()->is('articles*') ? 'current_page_item' : ''}}"><a href="/articles" accesskey="2" title="">Каталог статей</a></li>
            </ul>
        </div>
    </div>

</div>
@yield('content')
</body>
<footer>
   <center> <section class='contact'>
        <ul class='icons'>
            Для связи со мной:<br>
            <li><a href="https://github.com/KlipeLD" class="icon fa-github"><span class="label">Github</span></a></li>
            <li><a href="https://bitbucket.org/Klipe_LD/" class="icon fa-bitbucket"><span class="label">Bitbucket</span></a></li>
            <li><a href="https://www.drive2.ru/users/klipe-ld" class="icon fa-car"><span class="label">Drive2</span></a></li>
            <li><a href="https://vk.com/klipe_ld" class="icon fa-vk"><span class="label">Vk</span></a></li>
            <li><a href="skype://klipe_ld?chat" class="icon fa-skype"><span class="label">Skype</span></a></li>
            <li><a href="viber://add?number=375257932803" class="icon fa-phone"><span class="label">Viber</span></a></li>
            <li><a href="https://t.me/Klipe_LD" class="icon fa-paper-plane"><span class="label">Telegram</span></a></li>
            <li><a href="https://www.instagram.com/klipe_ld" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
            <li><a href="https://www.facebook.com/klipe.ld" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
            <li><a href="https://plus.google.com/u/0/108435129923345144325" class="icon fa-google-plus"><span class="label">Google</span></a></li>
        </ul>
    </section>
    <p>made with love by - <a href='https://klipeld.github.io/'>Y.Yantsevich</a></p></center>
</footer>
</html>
