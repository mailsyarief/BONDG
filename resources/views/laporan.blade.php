@extends('layouts.navbar')

@section('content')

    <div class="row">
        <div class="col-lg-12 ml-auto mr-auto">
            <!-- Main content -->
            <section class="content mt-5">
                <div class="">
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
                                                <td>{{$data->status}}</td>
                                                <td>
                                                    {{$data->waktupengerjaan}} hari
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
                                                <th>Waktu Pengerjaan</th>                                          
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
        </div>
    </div>
    <!-- DataTables -->
    
@endsection



