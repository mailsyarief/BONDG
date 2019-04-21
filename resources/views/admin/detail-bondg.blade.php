@extends('layouts.dashboard')

@section('css-ext')
<!-- DataTables -->
<link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap4.css">
@endsection
@section('content')
<title>Detail | BON DG</title>
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
                        <li class="breadcrumb-item"><a href="../bondg">BON DG</a></li>
                        <li class="breadcrumb-item active">No. DG: {{$bondg->nodg}}</li>
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
                            <h3 class="card-title">Detail BON DG</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Posko:</th>
                                    <td>{{$bondg->posko}}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal laporan:</th>
                                    <td>{{$bondg->tgldg}}</td>
                                </tr>
                                <tr>
                                    <th>No. BON DG:</th>
                                    <td>{{$bondg->nodg}}</td>
                                </tr>
                                <tr>
                                    <th>Nama Pelapor:</th>
                                    <td>{{$bondg->namapel}}</td>
                                </tr>
                                <tr>
                                    <th>ID Pelanggan:</th>
                                    <td>{{$bondg->idpel}}</td>
                                </tr>
                                <tr>
                                    <th>No. HP:</th>
                                    <td>{{$bondg->nohp}}</td>
                                </tr>
                                <tr>
                                    <th>No. Meter Lama:</th>
                                    <td>{{$bondg->nometerlama}}</td>
                                </tr> 
                                <tr>
                                    <th>Gardu:</th>
                                    <td>{{$bondg->gardu}}</td>
                                </tr>
                                <tr>
                                    <th>Tarif:</th>
                                    <td>{{$bondg->tarif}}</td>
                                </tr>
                                <tr>
                                    <th>Daya:</th>
                                    <td>{{$bondg->daya}}</td>
                                </tr>                             
                            </table>
                        </div>
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

@endsection