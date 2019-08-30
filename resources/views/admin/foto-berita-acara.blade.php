@extends('layouts.dashboard')

@section('css-ext')
<!-- DataTables -->
<link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap4.css">
@endsection
@section('content')
<title>Foto Berita Acara | BON DG</title>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Foto Berita Acara</li>
                        <li class="breadcrumb-item active">Nomor: <td>
                            {{str_pad($bondg->nodg, 8, '0', STR_PAD_LEFT)}}                                              
                            </td>
                        </li>
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
                        <div class="card-header ">
                            <div class="row">
                                <div class="col-md-6 d-flex align-items-center">
                                    <h3 class="card-title">Foto Berita Acara</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="button" data-toggle="modal" data-target="#modalRemaja" class=" btn btn-success"> Remaja </button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">                                
                                <h6> Foto KWH Meter Lama</h6><br>
                                <img src="data:image/jpeg;base64, {{$bondg->filename_kwhlama}}" style="width:50%"> 
                            </div>
                            <div class="row">                                
                                <h6> Foto KWH Meter Baru</h6><br>
                                <img src="data:image/jpeg;base64, {{$bondg->filename_kwhbaru}}" style="width:50%"> 
                            </div>
                            <div class="row">                                
                                <h6> Foto Berita Acara</h6><br>
                                <img src="data:image/jpeg;base64, {{$bondg->filename_ba}}" style="width:50%"> 
                            </div>
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
<div class="modal fade" id="modalRemaja" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Remajakan BON DG</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin meremajakan BON DG tersebut?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button> 
            <form action="../remaja2" method="POST">  
            @csrf
                <input type="text" name="remaja" value="{{$bondg->nodg}}" hidden>
                <button type="submit" class="btn btn-success">Ya</button>
            </form>
          </div>
        </div>
    </div>
</div>
@endsection

@section('js-ext')

@endsection