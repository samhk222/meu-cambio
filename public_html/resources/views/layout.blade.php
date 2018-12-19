<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','SEM NENHUM')</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style type="text/css">
        img {
            max-width: 800px;
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 40%;
        }
    </style>
  </head>
  <body>
    <div class="container-fluid" style="padding-top: 10px;">
        @yield('content')
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
  </body>


</html>