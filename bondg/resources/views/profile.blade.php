@extends('layouts.navbar')

@section('content')
    <div class="row">
        <div class="col-lg-10 ml-auto mr-auto mt-5">
            <!-- Main content -->
            @include('layouts.alert')
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fa fa-ban"></i> Alert!</h5>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>                            
            @endif
            <section class="content">
                <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Sunting Profil</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="../profile" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nama</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Nama" name="nama" value="{{Auth::user()->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email" value="{{Auth::user()->email}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Username</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Username" name="username" value="{{Auth::user()->username}}">
                                </div>
                            </div>
                            <!-- /.card-body -->
            
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
        
        
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Ganti Password</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="" action="../password" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputPassword3" class="control-label">Password Sekarang</label>               
                                    <input type="password" class="form-control" id="inputPassword3" placeholder="Password Sekarang" name="password_now">
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="control-label">Password Baru</label>              
                                    <input type="password" class="form-control" id="inputPassword3" placeholder="Password Baru" name="password">
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="control-label">Konfirmasi Password Baru</label>                
                                    <input type="password" class="form-control" id="inputPassword3" placeholder="Konfirmasi Password Baru" name="password_confirmation">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Ganti Password</button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    <!-- /.card -->
                    
                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
    </div>
@endsection