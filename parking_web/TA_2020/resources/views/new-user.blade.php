@extends('template.main')

@section('header-title')
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{$title}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a> / <a href="{{url('user/create')}}">New User</a></li>
              <!-- <li class="breadcrumb-item active">Dashboard v2</li> -->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
@endsection

@section('content')
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">

            <!-- Horizontal Form -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{$subtitle}}</h3>
              </div>
              <!-- /.card-header -->

              <!-- form start -->
              <form class="form-horizontal" method="POST" action="{{route('user.store')}}">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control @error('inputName') is-invalid @enderror" id="inputName" name="inputName" placeholder="Name">
                      @error('inputName')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control @error('inputEmail') is-invalid @enderror" id="inputEmail" name="inputEmail" placeholder="Email">
                      @error('inputEmail')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPhone" class="col-sm-3 col-form-label">Phone Number</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control @error('inputPhone') is-invalid @enderror" id="inputPhone" name="inputPhone" placeholder="Phone Number">
                      @error('inputPhone')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputLevel" class="col-sm-3 col-form-label">User Level</label>
                    <div class="col-sm-9">
                      <select class="form-control @error('inputLevel') is-invalid @enderror" id="inputLevel" name="inputLevel">
                        <option value="">- Select user level -</option>
                        <option value="admin">Admin</option>
                        <option value="customer">Customer</option>
                      </select>
                      @error('inputLevel')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control @error('inputPassword') is-invalid @enderror" id="inputPassword" name="inputPassword" placeholder="Password" maxlength="8">
                      @error('inputPassword')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">Password Confirmation</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control @error('inputPasswordConfirm') is-invalid @enderror" id="inputPasswordConfirm" name="inputPasswordConfirm" placeholder="Password Confirmation" maxlength="8">
                      @error('inputPasswordConfirm')
                          <div class="text-danger" id="errorConfirm">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info float-right">Submit</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
@endsection

@section('javascript')
  <script type="text/javascript">
    $(document).ready(function(){
      $("#inputPasswordConfirm").keyup(function(){
        var password = $("#inputPassword").val();
        var passwordConfirm = $("#inputPasswordConfirm").val();

        if (passwordConfirm!=password) {
          $("#inputPasswordConfirm").addClass("is-invalid");
        }else if(passwordConfirm=password){
          $("#inputPasswordConfirm").removeClass("is-invalid");
          $("#inputPasswordConfirm").addClass("is-valid");
        }
      });
    });
  </script>
@endsection