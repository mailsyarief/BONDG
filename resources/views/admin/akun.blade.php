@extends('layouts.dashboard')

@section('css-ext')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap4.css')}}">
@endsection
@section('content')
<title>Daftar Akun | Akun Petugas</title>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <button class="btn btn-success" type="button" onclick="window.location.href='{{url('tambah-akun')}}'">Tambah Akun</button>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Akun Petugas</li>
                        <li class="breadcrumb-item active">Daftar Akun</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fa fa-ban"></i> Peringatan!</h5>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <!-- general form elements -->
                    @include('layouts.alert')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Akun Petugas</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">No.</th>
                                        <th>Nama Petugas</th>
                                        <th>Username</th>
                                        <th>E-mail</th>
                                        <th>Jenis Akun</th>
                                        <th>Pilihan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($akun as $data)
                                    <tr>
                                        <td style="width: 5%;">{{$no++}}.</td>
                                        <td>{{$data->name}}</td>
                                        <td>{{$data->username}}</td>
                                        <td>{{$data->email}}</td>
                                        @if ($data->role==0)
                                        <td> Petugas Lapangan </td>
                                        @elseif ($data->role == 1)
                                        <td> Admin </td>
                                        @else
                                        <td> Viewer </td>
                                        @endif
                                        <td style="width: 10%" class="text-center">
                                            <div class="btn-group">
                                                @if ($data->active==1)
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalActivate{{$data->id}}"><i class="fa fa-times"></i>
                                                    Hapus
                                                </button>
                                                @endif
                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalResetPassword{{$data->id}}"><i class="fa fa-key"></i>
                                                    Reset Password
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modalActivate{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    @if ($data->active==1)
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Nonaktifkan Akun</h5>
                                                    @else
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Aktifkan Akun</h5>
                                                    @endif
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @if ($data->active==1)
                                                    Apakah anda yakin ingin menghapus akun ini?
                                                    @else
                                                    Apakah anda yakin ingin mengaktifkan akun ini?
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                    <form action="{{url('aktifkan-akun')}}" method="POST">
                                                        @csrf
                                                        <input type="text" value="{{$data->id}}" name="id" hidden>
                                                        <button type="submit" class="btn btn-danger">Ya</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="modalResetPassword{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    Reset Password
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{url('ganti-password-akun')}}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Password <small>Password minimal 8 karakter</small></label>
                                                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Masukkan password..." name="password" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Confirm Password</label>
                                                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Masukkan password kembali..." name="password_confirmation" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <input type="text" value="{{$data->id}}" name="id" hidden>
                                                        <button type="submit" class="btn btn-success">Simpan</button>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.card -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

@section('js-ext')
<!-- DataTables -->
<script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/datatables/dataTables.bootstrap4.js')}}"></script>
<script>
    $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>
@endsection