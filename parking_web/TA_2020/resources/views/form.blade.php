@extends('main')

@section('content')
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">{{$title}}</h3>
          <br>
        </div>
        <div class="box-body">
          
          {!! form_start($form) !!}
          {!! form_rest($form) !!}
          
            <div class="form-group col-sm-12">
                <button type="submit" class="btn-success btn">Simpan</button>
                <a href="{{$cancel}}" type="button" class="btn-default btn" style="float: right; margin-left: 5px;">Batal</a>
                <button type="reset" class="btn-danger btn" style="float: right;">Reset</button>
            </div>
          
          {!! form_end($form, false) !!}

        </div>
      </div>
      <!-- /.box -->
@endsection
