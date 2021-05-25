<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="{{ asset('images/logo.png')}}">
  <title>Sistem Kantong Parkir UGM - SKKK</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

@include('header')
@include('sidebar')
  
<!-- MAIN PAGE -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('content-title')
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol> -->
    </section>
    
    <section class="content">
      @yield('content')
    </section>
  </div>
  
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('AdminMirna/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('AdminMirna/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script>

</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('AdminMirna/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('js/adminlte.min.js') }}"></script>

<script type="text/javascript" src="{{asset('AdminMirna/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('AdminMirna/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendor/datatables/buttons.server-side.js')}}"></script>
<script src="{{asset('AdminMirna/datatables/buttons.server-side.js')}}"></script>

@yield('script')

  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</body>
</html>
