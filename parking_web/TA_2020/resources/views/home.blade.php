@extends('main')
@section('content-title')
  
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
                    <button class="btn btn-success" type="button" id="opengate" name="opengate">Buka Gerbang</button>
                <!-- </a> -->
                    <button class="btn btn-danger" type="button" id="closegate" name="closegate">Tutup Gerbang</button>
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
