@extends('layouts.navbar')

@section('content')
    <div class="row">
        <div class="col-lg-8 ml-auto mr-auto">
            <section class="content" >
                <div class="container-fluid">
                            <!-- Small Box (Stat card) -->
                            <h5 class="mt-4 mb-0 text-center">Nama Petugas: {{Auth::user()->name}}</h5>
                            <h5 class="mt-0 mb-0 text-center">Username Petugas: {{Auth::user()->username}}</h5>
                            <h5 class="mb-4 text-center">E-mail Petugas: {{Auth::user()->email}}</h5>
                        <div class="row">
                            <div class="col-lg-4 col-4 ml-auto mr-auto">
                                <!-- small card -->
                                <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{$tugas}}</h3>
                    
                                    <p class="mb-0">Jumlah pekerjaan harus dikerjakan</p>
                                    <small class="mt-0"> Segera lihat di android anda! </small>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-sticky-note"></i>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">                            
                            <!-- ./col -->
                            <div class="col-lg-4 col-4 ml-auto mr-0">
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
                            <div class="col-lg-4 col-4 ml-0 mr-auto">
                                <!-- small card -->
                                <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{$batal}}</h3>
                    
                                    <p>Pengerjaan Dibatalkan</p>
                                </div>
                                <div class="icon">
                                        <i class="fa fa-times"></i>
                                </div>
                                </div>
                            </div>                            
                        <!-- ./col -->
                        </div>
                </div>
            </section>
        </div>
    </div>
@endsection