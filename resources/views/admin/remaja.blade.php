@extends('layouts.dashboard')

@section('css-ext')
<!-- DataTables -->
<link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap4.css">
@endsection
@section('content')
<title>Remaja | BON DG</title>
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
                            <form acton="../remaja" method="POST">
                            @csrf
                                <div class="card-body" style="overflow-x: auto">                                
                                    <table id="example1" class="table table-bordered table-striped" >
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">No.</th>
                                                <th>Tgl. Laporan</th>
                                                <th>No. DG</th>
                                                <th>Nama Pelapor</th>
                                                <th>ID Pelanggan</th>
                                                <th>Petugas</th>
                                                <th style="width: 15%" >Status</th>
                                                <th>Check</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($bondg as $data)
                                            <tr>
                                                <td style="width: 5%;">{{$no++}}.</td>
                                                <td><?php echo Carbon\Carbon::createFromDate($data->tgldg)->toFormattedDateString(); ?></td>
                                                <td>{{$data->nodg}}</td>
                                                <td>{{$data->namapel}}</td>
                                                <td>{{$data->idpel}}</td>
                                                <td>{{$data->petugas->name}}</td>
                                                <td>{{$data->status}} <button type="button" data-toggle="modal" data-target="#modalBA{{$data->nodg}}" class=" btn btn-sm btn-primary"> Lihat Foto Berita Acara </button></td>
                                                <td style="width: 10%" class="text-center">
                                                    <label>
                                                        <input type="checkbox" class="flat-red" name="remaja[]" value="{{$data->nodg}}">
                                                    </label>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="modalBA{{$data->nodg}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Foto Berita Acara</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{$data->nodg}}
                                                            <div class="row">
                                                                <div class="col-md-12 text-center">
                                                                    <p class="text-center">Foto KWH Meter Lama</p>
                                                                    <img src="{{$data->filename_kwhlama}}" style="width:75%"> <br>
                                                                </div>
                                                                <div class="col-md-12 text-center">
                                                                    <p class="text-center">Foto KWH Meter Baru</p>
                                                                    <img src="{{$data->filename_kwhbaru}}" style="width:75%"> <br>
                                                                </div>
                                                                <div class="col-md-12 text-center">
                                                                    <p class="text-center">Foto Berita Acara</p>
                                                                    <img src="{{$data->filename_ba}}" style="width:75%"> <br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>                
                                                      </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th style="width: 5%;">No.</th>
                                                <th>Tgl. Laporan</th>
                                                <th>No. DG</th>
                                                <th>Nama Pelapor</th>
                                                <th>ID Pelanggan</th>
                                                <th>Petugas</th>
                                                <th>Status</th>
                                                <th>Check</th>                                            
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group text-center">
                                                <button type="button" data-toggle="modal" data-target="#modalRemaja" class=" btn btn-success"> Remaja </button>
                                            </div>
                                        </div>
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
                                                    <button type="submit" class="btn btn-danger">Ya</button>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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