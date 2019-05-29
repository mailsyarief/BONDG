@extends('layouts.dashboard')

@section('css-ext')
<!-- DataTables -->
<link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap4.css">
@endsection
@section('content')
<title>Status | BON DG</title>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">Remaja</li>
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
                                            <th>Detail</th>
                                            <th style="width: 30%;">Tambah Petugas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bondg as $data)
                                        <tr>
                                            <td style="width: 5%;">{{$no++}}.</td>
                                            <td><?php echo Carbon\Carbon::createFromDate($data->tgldg)->toFormattedDateString(); ?></td>
                                            @if (strlen($data->nodg)==7)
                                                <td>0{{$data->nodg}}</td>
                                            @else
                                                <td>{{$data->nodg}}</td>
                                            @endif    
                                            <td>{{$data->namapel}}</td>
                                            <td>{{$data->idpel}}</td>
                                            <td>{{$data->status}}</td>
                                            <td>
                                                <form action = "../detail-bondg" method="POST">
                                                    @csrf
                                                    @if (strlen($data->nodg)==7)
                                                        <input type="text" value="0{{$data->nodg}}" name="id" hidden>
                                                    @else 
                                                        <input type="text" value="{{$data->nodg}}" name="id" hidden>
                                                    @endif                                                    
                                                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Lihat Detail</button>
                                                </form>
                                            </td>
                                            <td>                                                    
                                                <form method="POST" action="../tambah-petugas">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <div class="form-group">
                                                                <select class="form-control select2" style="width: 100%;" name="petugas">
                                                                @foreach ($petugas as $item)
                                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                                @endforeach
                                                                </select>
                                                            </div>
                                                        </div>  
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                @if (strlen($bondg[0]->nodg)==7)
                                                                    <input type="text" name="id" value="0{{$bondg[0]->nodg}}" hidden>
                                                                @else
                                                                    <input type="text" name="id" value="{{$bondg[0]->nodg}}" hidden>
                                                                @endif 
                                                                <button type="submit" class="btn btn-primary btn-sm" style="width:100%; height:auto">Tambah Petugas</button>
                                                            </div>
                                                        </div>
                                                    </div>                                               
                                                </form>                                             
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th style="width: 5%;">No.</th>
                                            <th>Tgl. Laporan</th>
                                            <th>No. DG</th>
                                            <th>Nama Pelapor</th>
                                            <th>ID Pelanggan</th>
                                            <th>Status</th>
                                            <th>Detail</th>
                                            <th>Tambah Petugas</th>                                            
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
    $('#example1').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": true
    });
    });
</script>
@endsection