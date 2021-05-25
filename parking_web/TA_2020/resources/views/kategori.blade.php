@extends('main')
@section('content-title')
  
@endsection
@section('content')
          <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Daftar Kategori</h3>
        </div>
        <div class="box-body">
          <a href="{{$tambah}}" type="button" class="btn btn-sm btn-success" style="margin-bottom: 20px">
          Tambah</a>
          <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Kategori</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Deskripsi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach($kategori as $value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->nama}}</td>
                    <td>{{$value->jenis}}</td>
                    <td>{{$value->deskripsi}}</td>
                    <td>
                      <a href="{{route('kategori.edit',$value->id)}}" class="btn btn-sm btn-primary">Ubah</a>
                      <form style="display:inline-block" action="{{url('kategori/'.$value->id.'/delete')}}" method="GET">
                        <!-- {{csrf_field().method_field('DELETE')}} -->
                        <button class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure want to delete this data?\'')">Hapus</button>
                      </form>
                    </td>
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
