@extends('layouts.dashboard')

@section('css-ext')
<!-- DataTables -->
<link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap4.css">
@endsection
@section('content')
<title>Input | BON DG</title>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">Status</li>
                            <li class="breadcrumb-item active">BON DG</li>
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
                        <!-- general form elements -->
                        @include('layouts.alert')
                        <div class="card">
                            <div class="card-header">
                              <h3 class="card-title">Status BON DG</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">No.</th>
                                            <th>Posko</th>
                                            <th>Tgl. Laporan</th>
                                            <th>No.DG</th>
                                            <th>Nama Pelapor</th>
                                            <th>ID Pelanggan</th>
                                            <th>Status</th>
                                            <th>Pilihan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bondg as $data)
                                        <tr>
                                            <td style="width: 5%;">{{$no++}}.</td>
                                            <td>{{$data->posko}}
                                            </td>
                                            <td>{{$data->tgldg}}</td>
                                            <td>{{$data->nodg}}</td>
                                            <td>{{$data->namapel}}</td>
                                            <td>{{$data->idpel}}</td>
                                            <td>{{$data->status}}</td>
                                            <td style="width: 10%" class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
                                                    <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                                                    <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th style="width: 5%;">No.</th>
                                            <th>Posko</th>
                                            <th>Tgl. Laporan</th>
                                            <th>No.DG</th>
                                            <th>Nama Pelapor</th>
                                            <th>ID Pelanggan</th>
                                            <th>Status</th>
                                            <th>Pilihan</th>
                                        </tr>
                                    </tfoot>
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
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
    $(function () {
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