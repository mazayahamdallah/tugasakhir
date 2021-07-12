@extends('main')
@section('content-title')
<script src="mqttws31.js" type="text/javascript"></script>
<script src="jquery.min.js" type="text/javascript"></script>
<script src="config.js" type="text/javascript"></script>
<script type="text/javascript">
var mqtt;
var reconnectTimeout = 2000;
var client_name = "web_" + parseInt(Math.random() * 100, 10);
var dataChart = [0,1,2,4];
function MQTTconnect() {
  if (typeof path == "undefined") {
    path = '/mqtt';
  }
  mqtt = new Paho.MQTT.Client(
    MQTTbroker,
    MQTTport,
    path,
    client_name
  );
  var options = {
    timeout: 3,
    useSSL: useTLS,
    cleanSession: cleansession,
    onSuccess: onConnect,
    onFailure: function (message) {
    //   $('#status').val("Connection failed: " + message.errorMessage + "Retrying");
      setTimeout(MQTTconnect, reconnectTimeout);
    }
  };
  mqtt.onConnectionLost = onConnectionLost;
  mqtt.onMessageArrived = onMessageArrived;
  if (username != null) {
    options.userName = username;
    options.password = password;
  }
  console.log("Host="+ MQTTbroker + ", port=" + MQTTport + ", path=" + path + " TLS = " + useTLS + " username=" + username + " password=" + password);
  mqtt.connect(options);
//   document.getElementById('name').innerHTML = "I am "+client_name;
}
function onConnect() {
//   $('#status').val('Connected to ' + host + ':' + port + path);
  mqtt.subscribe(MQTTsubTopic1, {qos: 0});
  mqtt.subscribe(MQTTsubTopic2, {qos: 0});
//   $('#topic1').val(topic1);
//   $('#topic2').val(topic3);

}
function entranceGateOpen(e){
    var Message = '1';
    message = new Paho.MQTT.Message(Message);
    message.destinationName = MQTTsubTopic1;
    mqtt.send(message);
}

function entranceGateClose(e){
    var Message = '0';
    message = new Paho.MQTT.Message(Message);
    message.destinationName = MQTTsubTopic1;
    mqtt.send(message);
}

function exitGateOpen(e){
    var Message = '1';
    message = new Paho.MQTT.Message(Message);
    message.destinationName = MQTTsubTopic2;
    mqtt.send(message);
}

function exitGateClose(e){
    var Message = '0';
    message = new Paho.MQTT.Message(Message);
    message.destinationName = MQTTsubTopic2;
    mqtt.send(message);
}
function onMessageArrived(message) {
    var topic = message.destinationName;
    var payload = message.payloadString;
   console.log(`topic : ${topic} \nmessage : ${payload}`)
};

function onConnectionLost(response) {
  setTimeout(MQTTconnect, reconnectTimeout);
//   $('#status').val("connection lost: " + responseObject.errorMessage + ". Reconnecting");
};

$(document).ready(function() {
  MQTTconnect();
});
</script>
@endsection

@section('content')
          <!-- Default box -->
      <div class="box">

 <!--UI untuk menampilkan error -->
        @if(Session::has('error'))
        <div class="alert alert-error">
          {{ Session::get('error') }}
        </div>
        @endif

        <div class="box-header with-border">
          <h3 class="box-title">Tombol Kontrol Gerbang</h3>
        </div>
        <div class="box-body">

              <div class="box-body">
                <div class="col-md-6">
                <!-- <a href="{{url('laporan')}}"> -->
                    <button onclick="entranceGateOpen(event)">Buka Gerbang Masuk
                    </button>


                <!-- </a> -->
                    <button onclick="entranceGateClose(event)">Tutup Gerbang Masuk</button>
                </div>
              </div>

               <div class="box-body">
                <div class="col-md-6">
                <!-- <a href="{{url('laporan')}}"> -->
                    <button onclick="exitGateOpen(event)">Buka Gerbang Keluar</button>
                <!-- </a> -->
                    <button onclick="exitGateClose(event)">Tutup Gerbang Keluar</button>
                </div>
              </div>

        </div>

      </div>

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Informasi Kendaraan Masuk</h3>
        </div>

        <div class="box-body">
          <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Plat Nomor</th>
                    <th>Seri Motor</th>
                    <th>Warna</th>
                    <th>Jam Masuk</th>
                </tr>

            </thead>
            <tbody>
              @foreach($track_plat as $data)
                <tr>
                    <td>{{$data->plat_no}}</td>
                    <td>{{$data->plat_nomor->seri_motor}}</td>
                    <td>{{$data->plat_nomor->warna}}</td>
                    <td>{{$data->waktu_datang}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>

        </div>
      </div>
        <!-- /.box-body -->

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Informasi Pengendara Masuk</h3>
        </div>

        <div class="box-body">
          <table class="table table-bordered">
            <thead>
                <tr>
                    <th>UID</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Angkatan</th>
                    <th>Fakultas</th>
                    <th>Jam Masuk</th>
                </tr>

            </thead>
            <tbody>
              @foreach($card as $data1)
              <tr>
                    <td>{{$data1->pengguna->uid}}</td>
                    <td>{{$data1->pengguna->nama_pengguna}}</td>
                    <td>{{$data1->pengguna->nim}}</td>
                    <td>{{$data1->pengguna->angkatan}}</td>
                    <td>{{$data1->pengguna->fakultas}}</td>
                    <td>{{$data1->waktu_in}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

        <div id="chart1"></div>


      </div>

@endsection
@section("script")



@endsection
