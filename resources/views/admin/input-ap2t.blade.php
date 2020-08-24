@extends('layouts.dashboard')

@section('css-ext')
<!-- DataTables -->
<link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap4.css">
@endsection
@section('content')
<title>Input | AP2T</title>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Input AP2T</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">Input</li>
                            <li class="breadcrumb-item active">AP2T</li>
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
                        <!-- general form elements -->
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
                        @include('layouts.alert')
                        <div class="card">                           
                            <!-- /.card-header -->
                            <div class="card-body" style="overflow-x: auto">                                
                                <table id="example1" class="table table-bordered table-striped" >
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">No.</th>
                                            <th>Tgl. Laporan</th>
                                            <th>No. DG</th>
                                            <th>Nama Pelapor</th>
                                            <th>ID Pelanggan</th>
                                            <th>Status</th>
                                            <th style="width: 10%;">Waktu Pengerjaan</th>
                                            <th>Pilihan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bondg as $data)
                                        <tr>
                                            <td style="width: 5%;">{{$count++}}.</td>
                                            <td><?php echo Carbon\Carbon::createFromDate($data->tgldg)->format('d M Y');?></td>
                                            <td>
                                                @if (strlen($data->nodg)==7)
                                                    0{{$data->nodg}}
                                                @else
                                                    {{$data->nodg}}
                                                @endif                                               
                                            </td>
                                            <td>{{$data->namapel}}</td>
                                            <td>{{$data->idpel}}</td>
                                            <td>{{str_pad('k', 8, '0', STR_PAD_LEFT)}}</td>
                                            <td>
                                                {{$data->waktupengerjaan}} hari
                                            </td>
                                            <td style="width: 10%" class="text-center">
                                                <div class="btn-group">
                                                    <form action = "../form-ap2t" method="POST">
                                                    @csrf
                                                    @if (strlen($data->nodg)==7)
                                                        <input type="text" value="0{{$data->nodg}}" name="id" hidden>
                                                    @else 
                                                        <input type="text" value="{{$data->nodg}}" name="id" hidden>
                                                    @endif                                                    
                                                        <button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Input AP2T</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
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
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
    $(function () {
    $('#example1').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true
    });
    });
</script>
@endsection