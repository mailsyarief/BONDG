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
                        <li class="breadcrumb-item active">No. DG: <td>
                                @if (strlen($bondg->nodg)==7)
                                    0{{$bondg->nodg}}
                                @else
                                    {{$bondg->nodg}}
                                @endif                                               
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
                        <div class="card-header">
                            <h3 class="card-title">Detail BON DG</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Posko:</th>
                                            <td>{{$bondg->posko}}</td>
                                        </tr>                                        
                                        <tr>
                                            <th>No. BON DG:</th>
                                            <td>
                                                @if (strlen($bondg->nodg)==7)
                                                    0{{$bondg->nodg}}
                                                @else
                                                    {{$bondg->nodg}}
                                                @endif                                               
                                            </td>
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
                                            <th>Alamat:</th>
                                            <td>{{$bondg->alamat}}</td>
                                        </tr>
                                        <tr>
                                            <th>No. Meter Lama:</th>
                                            <td>{{$bondg->nometerlama}}</td>
                                        </tr>                                          
                                        <tr>
                                            <th>No. Meter Baru:</th>
                                            <td>{{$bondg->nometerbaru}}</td>
                                        </tr> 
                                        <tr>
                                            <th>No. Agenda:</th>
                                            <td>{{$bondg->noagenda}}</td>
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
                                        <tr>
                                            <th>Merek KWH Meter Lama:</th>
                                            <td>{{$bondg->kwhmeterlama_merk}}</td>
                                        </tr>  
                                        <tr>
                                            <th>Type KWH Meter Lama:</th>
                                            <td>{{$bondg->kwhmeterlama_type}}</td>
                                        </tr>  
                                        <tr>
                                            <th>Tahun Buat KWH Meter Lama:</th>
                                            <td>{{$bondg->kwhmeterlama_th}}</td>
                                        </tr>       
                                        <tr>
                                            <th>Sisa KWH Meter Lama:</th>
                                            <td>{{$bondg->kwhmeterlama_sisakwh}}</td>
                                        </tr>                          
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Status:</th>
                                            <td>{{$bondg->status}}</td>
                                        </tr>
                                        <tr>
                                                <th>Tanggal laporan:</th>
                                                <td><?php echo Carbon\Carbon::createFromDate($bondg->tgldg)->toFormattedDateString(); ?></td>
                                        </tr>
                                        @if($bondg->status != "Laporan")
                                        <tr>
                                            <th>Tanggal Cetak PK:</th>
                                            <td><?php if($bondg->tglpk!= NULL) echo Carbon\Carbon::createFromDate($bondg->tglpk)->toFormattedDateString(); ?></td>
                                        </tr>
                                        @endif
                                        @if($bondg->status != "Laporan" && $bondg->status != "Cetak PK" )
                                        <tr>
                                            <th>Tanggal Pengiriman WO:</th>
                                            <td><?php if($bondg->tglkirimpetugas!= NULL) echo Carbon\Carbon::createFromDate($bondg->tglkirimpetugas)->toFormattedDateString(); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Petugas:</th>
                                            @if ($bondg->petugas != NULL)
                                                <td>{{$bondg->petugas->name}}</td>
                                            @else
                                                <td></td>
                                            @endif
                                        </tr> 
                                        @endif
                                        @if($bondg->status == "Terpasang" || $bondg->status == "Remaja")
                                        <tr>
                                            <th>Tanggal Terpasang:</th>
                                            <td><?php if($bondg->tglterpasang!= NULL) echo Carbon\Carbon::createFromDate($bondg->tglterpasang)->toFormattedDateString(); ?></td>
                                        </tr>
                                        @endif
                                        @if($bondg->status == "Remaja")
                                        <tr>
                                            <th>Tanggal Remaja:</th>
                                            <td><?php if($bondg->tglremaja!= NULL) echo Carbon\Carbon::createFromDate($bondg->tglremaja)->toFormattedDateString(); ?></td>
                                        </tr>
                                        @endif
                                        @if($bondg->status == "Pengajuan Batal")
                                        <tr>
                                            <th>Tanggal Batal 1:</th>
                                            <td><?php if($bondg->tglbatal1!= NULL) echo Carbon\Carbon::createFromDate($bondg->tglbatal)->toFormattedDateString(); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Alasan Batal 1:</th>
                                            <td>{{$bondg->cancel_1}}</td>
                                        </tr>
                                        <tr>
                                            <th>Petugas Batal 1:</th>
                                            <td>{{$batal->petugasBatal->name}}</td>
                                        </tr>
                                        @endif
                                        @if($bondg->status == "Batal")
                                        <tr>
                                            <th>Tanggal Batal 1:</th>
                                            <td><?php if($bondg->tglbatal1!= NULL) echo Carbon\Carbon::createFromDate($bondg->tglbatal)->toFormattedDateString(); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Alasan Batal 1:</th>
                                            <td>{{$bondg->cancel_1}}</td>
                                        </tr>
                                        <tr>
                                            <th>Petugas Batal 1:</th>
                                            <td>{{$batal->petugasBatal->name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Batal 2:</th>
                                            <td><?php if($bondg->tglbatal!= NULL) echo Carbon\Carbon::createFromDate($bondg->tglbatal)->toFormattedDateString(); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Alasan Batal 2:</th>
                                            <td>{{$bondg->cancel_2}}</td>
                                        </tr>
                                        @endif                                       
                                        <tr>
                                            <th>Keluhan:</th>
                                            <td>{{$bondg->keluhan}}</td>
                                        </tr>
                                        <tr>
                                            <th>Perbaikan:</th>
                                            <td>{{$bondg->perbaikan}}</td>
                                        </tr>
                                        <tr>
                                            <th>Waktu Pengerjaan:</th>
                                            <td>{{$bondg->waktupengerjaan}} hari</td>
                                        </tr>
                                        <tr>
                                            <th>Merek KWH Meter Baru:</th>
                                            <td>{{$bondg->kwhmeterbaru_merk}}</td>
                                        </tr>  
                                        <tr>
                                            <th>Type KWH Meter Baru:</th>
                                            <td>{{$bondg->kwhmeterbaru_type}}</td>
                                        </tr>  
                                        <tr>
                                            <th>Tahun Buat KWH Meter Baru:</th>
                                            <td>{{$bondg->kwhmeterbaru_th}}</td>
                                        </tr>                            
                                    </table>
                                </div>
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
@endsection

@section('js-ext')

@endsection