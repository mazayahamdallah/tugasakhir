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

  <script src="mqttws31.js" type="text/javascript"></script>
<script src="jquery.min.js" type="text/javascript"></script>
<script src="config.js" type="text/javascript"></script>

<script type="text/javascript">
  var mqtt;
  var reconnectTimeout = 2000;
  var client_name = "web_" + parseInt(Math.random() * 100, 10);
  var dataChart = [0,1,2,4];

  function MQTTconnect(){
    if (typeof path == "undefined"){
      path = '/mqtt';
    }

    mqtt = new Paho.MQTT.Client(
      host "192.168.1.9",
      port "1883",
      path,
      client_name
      );
    var options = {
      timeout: 3,
      useSSL: useTLS,
      cleanSession: cleansession,
      onSuccess: onConnect,
      onFailure: function (message) {
        $('#status').val("Connection failed: " + message.errorMessage + "Retrying");
        setTimeout(MQTTconnect, reconnectTimeout);
    }
  };

  mqtt.onConnectionLost = onConnectionLost;
  mqtt.onMessageArrived = onMessageArrived;

   if (username != null) {
      options.userName = username;
      options.password = password;
    }
    console.log("Host="+ host + ", port=" + port + ", path=" + path + " TLS = " + useTLS + " username=" + username + " password=" + password);
    mqtt.connect(options);

     document.getElementById('name').innerHTML = "I am "+client_name;
  }
  function onConnect() {
    $('#status').val('Connected to ' + host + ':' + port + path);
    // Connection succeeded; subscribe to our topic
    mqtt.subscribe(topic1, {qos: 0});
    mqtt.subscribe(topic2, {qos: 0});

    $('#topic1').val(topic1);
    $('#topic2').val(topic2);

    //use the below if you want to publish to a topic on connect
    //message = new Paho.MQTT.Message("Hello World");
    //  message.destinationName = topic;
    //  mqtt.send(message);
  }

  function entranceGateOpen(e){
    //use the below if you want to publish a topic on a connect
    var key=e.keyCode || e.which;
    var Message = '1';

    // message = new Paho.MQTT.Message(client_name+" : "+Message);
    message = new Paho.MQTT.Message(Message);
    message.destinationName = topic1;
    mqtt.send(message); 
  }

  function entranceGateClose(e){
    //use the below if you want to publish a topic on a connect
    var key=e.keyCode || e.which;
    var Message = '0';

    // message = new Paho.MQTT.Message(client_name+" : "+Message);
    message = new Paho.MQTT.Message(Message);
    message.destinationName = topic1;
    mqtt.send(message); 
  }

  function exitGateOpen(e){
    //use the below if you want to publish a topic on a connect
    var key=e.keyCode || e.which;
    var Message = '1';

    // message = new Paho.MQTT.Message(client_name+" : "+Message);
    message = new Paho.MQTT.Message(Message);
    message.destinationName = topic2;
    mqtt.send(message); 
  }

  function exitGateClose(e){
    //use the below if you want to publish a topic on a connect
    var key=e.keyCode || e.which;
    var Message = '0';

    // message = new Paho.MQTT.Message(client_name+" : "+Message);
    message = new Paho.MQTT.Message(Message);
    message.destinationName = topic2;
    mqtt.send(message); 
  }

  $(document).ready(function() {
    MQTTconnect();
  });


</script>
</body>
</html>
