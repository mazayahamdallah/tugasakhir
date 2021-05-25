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
          <h3 class="box-title">Data Masuk Kendaraan</h3>
        </div>
        <div class="box-body">
         <form class="form-horizontal" method="POST" action="{{route('home.store')}}"  accept-charset="UTF-8">
          {{csrf_field()}}
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                        <label class="control-label col-sm-3" for="NIM">NIM:</label>
                        <div class="col-sm-6">
                          <input class="form-control" id="nim" required="required" name="nim" type="text" maxlength="18">
                        
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="plat_nomor">Plat Nomor:</label>
                        <div class="col-sm-6">
                        
                          <input class="form-control" id="plat_nomor" required="required" name="plat_nomor" type="text" maxlength="11">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3"></label>
                        <div class="col-sm-6">
                        <button class="btn btn-success" type="submit" id="submit-laporan">Input</button>
                        </div>
                    </div>

                </div>
              </div>
          </form>
        </div>

      </div>

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Kendaraan Masuk</h3>
        </div>
        <div class="box-body">
          <div class="col-md-12">
            <!-- <div class="col-md-6">
              <a href="" type="button" class="btn btn-sm btn-success" style="margin-bottom: 20px">
              Tambah</a>
            </div> -->
          </div>
          


          <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Fakultas</th>
                    <th>Angkatan</th>
                    <th>Plat Nomor</th>
                    <th>Jam Masuk</th>
                    <th>Status</th>
                    <!-- <th>Aksi</th> -->
                </tr>
            </thead>
            <tbody>
              @foreach($parkir as $data)
                <tr>
                    <td>{{$data->nim}}</td>
                    <td>{{$data->mahasiswa->nama}}</td>
                    <td>{{$data->mahasiswa->fakultas}}</td>
                    <td>{{$data->mahasiswa->angkatan}}</td>
                    <td>{{$data->plat_nomor}}</td>
                    <td>{{$data->jam_masuk}}</td>
                    <td>{{$data->status}}</td>
                    <!-- <td>
                      <a href="" class="btn btn-sm btn-primary">Ubah</a>
                      <form style="display:inline-block" action="" method="GET">
                        {{csrf_field().method_field('DELETE')}}
                        <button class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure want to delete this data?\'')">Hapus</button>
                      </form>
                    </td> -->
                </tr>
              @endforeach
                
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->

        <div id="chart1"></div>
        
        
      </div>

@endsection