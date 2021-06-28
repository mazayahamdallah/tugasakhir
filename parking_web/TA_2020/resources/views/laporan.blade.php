@extends('main')
@section('content-title')
  
@endsection
@section('content')
          <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Daftar Parkir</h3>
        </div>
        <div class="box-body">
          <div class="col-md-12">
           <!-- <div class="col-md-6">
              <a href="" type="button" class="btn btn-sm btn-success" style="margin-bottom: 20px">
              Tambah</a>
            </div>
             <div class="col-md-6" style="text-align: right;">
              <b>Saldo saat ini : Rp 2000</b>
            </div> -->
          </div>
          

          <form class="form-horizontal" method="GET" action="{{route('laporan.index')}}"  accept-charset="UTF-8">
          {{csrf_field()}}
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                        <label class="control-label col-sm-3" for="tgl_awal">Tanggal Awal:</label>
                        <div class="col-sm-6">
                        <input class="form-control" id="tgl_awal" required="required" name="tgl_awal" type="date">
                        
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="tgl_akhir">Tanggal Akhir:</label>
                        <div class="col-sm-6">
                        
                        <input class="form-control" id="tgl_akhir" required="required" name="tgl_akhir" type="date">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3"></label>
                        <div class="col-sm-6">
                        <button class="btn btn-success" type="submit" id="submit-laporan">Filter</button>
                        </div>
                    </div>

                </div>
              </div>
          </form>

<h4> <b>{{ $hasil ?? '' }}</b> </h4>
<br>

          <table class="table table-bordered">
            <thead>
                <tr>
                    <th>UID</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Angkatan</th>
                    <th>Fakultas</th>
                    <th>Plat Nomor</th>
                    <th>Seri Motor</th>
                    <th>Warna</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                </tr>
            </thead>
            <tbody>
              @foreach($parkir as $key => $data)
                <tr>
                    <td>{{$pengguna[$key]->uid}}</td>
                    <td>{{$pengguna[$key]->pengguna->nama_pengguna}}</td>
                    <td>{{$pengguna[$key]->pengguna->nim}}</td>
                    <td>{{$pengguna[$key]->pengguna->angkatan}}</td>
                    <td>{{$pengguna[$key]->pengguna->fakultas}}</td>
                    <td>{{$data->plat_no}}</td>
                    <td>{{$data->plat_nomor->seri_motor}}</td>
                    <td>{{$data->plat_nomor->warna}}</td>
                    <td>{{$pengguna[$key]->waktu_in}}</td>
                    <td>{{$pengguna[$key]->waktu_out}}</td>
                </tr>
              @endforeach
                
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->

        <div id="chart1"></div>
        
        
      </div>
      <!-- /.box -->

@endsection
