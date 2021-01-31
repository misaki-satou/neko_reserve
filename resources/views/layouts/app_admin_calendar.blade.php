<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>【ねこの病院 Tom＆Tabby Suginami】ねこの病院 トムアンドタビー 杉並-@yield('title')</title>
    @if(app('env')=='local')
    <!-- css -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/fullcalendar.css') }}" rel="stylesheet" >
    <link href="{{ asset('/css/main.css') }}" rel="stylesheet" >    
    <!-- Scripts -->
    <script src="{{ asset('/js/admin_fullcalendar.js') }}" defer></script>
    <script src="{{ asset('/js/app.js') }}" defer></script>

    <!--<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.2/gcal.js"></script>-->
    @endif
    @if(app('env')=='production')
    <!-- css -->
    <link href="{{ secure_asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('/css/fullcalendar.css') }}" rel="stylesheet" >
    <link href="{{ secure_asset('/css/main.css') }}" rel="stylesheet" >      
    <!-- Scripts -->
    <script src="{{ secure_asset('/js/admin_fullcalendar.js') }}" defer></script>
    <script src="{{ secure_asset('/js/app.js') }}" defer></script>
    @endif
    <script type="text/javascript">
    </script>
  </head>
  <body>
    <div id="app">
      <div class="container-field">     
        <nav class="navbar navbar-expand-md navbar-dark bg-neko shadow-sm">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                  <a class="nav-link" href="https://nekosuginami.com/">ねこの病院</a>
             　</li>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
              <!-- Authentication Links -->
              <li>
                <a href="{{ route('admin.logout') }}">ログアウト</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
      <main class="py-4">
        @yield('content')
      </main>
    </div>
  </body>
</html>