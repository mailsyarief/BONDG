@extends('layouts.dashboard')

@section('css-ext')

@endsection
@section('content')
<title>Input | AP2T</title>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        
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
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Input AP2T</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                 <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th style="width: 25%">Posko:</th>
                                                <td>{{$bondg->posko}}</td>
                                            </tr>
                                            <tr>
                                                <th style="width: 25%">Tanggal laporan:</th>
                                                <td>{{$bondg->tgldg}}</td>
                                            </tr>
                                            <tr>
                                                <th style="width: 25%">No. BON DG:</th>
                                                @if (strlen($bondg->nodg)==7)
                                                    <td>0{{$bondg->nodg}}</td>
                                                @else
                                                    <td>{{$bondg->nodg}}</td>
                                                @endif 
                                            </tr>
                                            <tr>
                                                <th style="width: 25%">Nama Pelapor:</th>
                                                <td>{{$bondg->namapel}}</td>
                                            </tr>
                                            <tr>
                                                <th style="width: 25%">ID Pelanggan:</th>
                                                <td>{{$bondg->idpel}}</td>
                                            </tr>
                                            <tr>
                                                <th style="width: 25%">No. HP:</th>
                                                <td>{{$bondg->nohp}}</td>
                                            </tr>
                                            <tr>
                                                <th style="width: 25%">No. Meter Lama:</th>
                                                <td>{{$bondg->nometerlama}}</td>
                                            </tr> 
                                            <tr>
                                                <th style="width: 25%">Gardu:</th>
                                                <td>{{$bondg->gardu}}</td>
                                            </tr>
                                            <tr>
                                                <th style="width: 25%">Tarif:</th>
                                                <td>{{$bondg->tarif}}</td>
                                            </tr>
                                            <tr>
                                                <th style="width: 25%">Daya:</th>
                                                <td>{{$bondg->daya}}</td>
                                            </tr>     
                                            <tr>
                                                <th style="width: 25%">Jenis keluhan:</th>
                                                <td>{{$bondg->keluhan}}</td>
                                            </tr>                          
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <form method="POST" action="../tambah-ap2t">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">No. agenda</label>
                                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Masukkan no. agenda (18 digit)..." name="noagenda" required>
                                            </div>                                            
                                            <hr>
                                            <p><strong> KWH Meter Dipasang</strong></p>      
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nomor KWH meter baru</label>
                                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Masukkan nomor KWH meter baru (11 digit)..." name="nometerbaru" required>
                                            </div>                                      
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Merk</label>
                                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Masukkan merk KWH meter baru..." name="merk">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Type</label>
                                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Masukkan type KWH meter baru..." name="type">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Tahun buat</label>
                                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Masukkan tahun KWH meter baru..." name="tahun">
                                            </div>
                                            <div class="form-group">
                                                @if (strlen($bondg->nodg)==7)
                                                    <input type="text" name="id" value="0{{$bondg->nodg}}" hidden>
                                                @else
                                                    <input type="text" name="id" value="{{$bondg->nodg}}" hidden>
                                                @endif 
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('js-ext')
<script>
    var cars = ["hai", "bye"];
 
console.log(cars);
</script>
@endsection