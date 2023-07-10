<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Institut Teknologi Garut">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="{{ url('images/favicon.ico" type="image/ico') }}" />

  
  <title>PKM-PPKH - @yield('title')</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="{{ url('assets/bootstrap/dist/css/bootstrap.min.css') }} ">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('assets/font-awesome/css/font-awesome.min.css') }} ">
  <!-- NProgress -->
  <link rel="stylesheet" href="{{ url('assets/nprogress/nprogress.css') }} ">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ url('assets/iCheck/skins/flat/green.css') }} ">
  
  <!-- bootstrap-progressbar -->
  <link rel="stylesheet" href="{{ url('assets/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }} ">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ url('assets/jqvmap/dist/jqvmap.min.css') }} ">
  <!-- bootstrap-daterangepicker -->
  <link rel="stylesheet" href="{{ url('assets/bootstrap-daterangepicker/daterangepicker.css') }} ">

  <!-- Custom Theme Style -->
  <link rel="stylesheet" href="{{ url('build/css/custom.min.css') }} ">

  @stack('css')
</head>