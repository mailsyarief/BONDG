@extends('layouts.dashboard')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">

        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#"></a>Admin Dashboard</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content" >
        <div class="container-fluid">
            <!-- Small Box (Stat card) -->
            <h5 class="mt-4 text-center">Statistik hari ini:</h5>
            <h5 class="text-center mb-4" id="date"></h5>
            <h5 class="mb-2 text-center" id="txt" style="display: none"></h5>
            <div class="row">
            <div class="col-lg-4 col-4">
                <!-- small card -->
                <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$bondg}}</h3>

                    <p>Laporan BON DG Masuk</p>
                </div>
                <div class="icon">
                    <i class="fa fa-sticky-note"></i>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-4">
                <!-- small card -->
                <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$ap2t}}</h3>

                    <p>AP2T</p>
                </div>
                <div class="icon">
                    <i class="fa fa-sticky-note"></i>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-4">
                <!-- small card -->
                <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$kirimorang}}</h3>

                    <p>Pengiriman Petugas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-4">
                <!-- small card -->
                <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$terpasang}}</h3>

                    <p>Laporan Selesai Dikerjakan</p>
                </div>
                <div class="icon">
                    <i class="fa fa-check"></i>
                </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-4">
                <!-- small card -->
                <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$remaja}}</h3>

                    <p>Laporan Diremajakan</p>
                </div>
                <div class="icon">
                    <span class="oi oi-circle-check"></span>
                </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-4">
                <!-- small card -->
                <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$batal}}</h3>

                    <p>Pengerjaan Dibatalkan</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                </div>
            </div>
            <!-- ./col -->
            </div>
            <!-- /.row -->

            <!-- =========================================================== -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script>
    function startTime() {

        var today = new Date();
        document.getElementById("date").innerHTML = today;
        
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('txt').innerHTML =
        h + ":" + m + ":" + s;
        var t = setTimeout(startTime, 500);
    }
    function checkTime(i) {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
    }
</script>
@endsection
