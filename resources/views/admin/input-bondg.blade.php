@extends('layouts.dashboard')

@section('css-ext')

@endsection
@section('content')
<title>Input | Gangguan</title>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Input Gangguan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Input</li>
                        <li class="breadcrumb-item active">Gangguan</li>
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
                        <h5>
                            <i class="icon fa fa-ban"></i> Peringatan!
                        </h5>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @include('layouts.alert')
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Input dengan File</h3>
                        </div>
                        <div class="card-body">
                            <p> Pastikan file berformat .xlsx/isi format/format dan menggunakan file template yang tersedia di bawah:</p>
                            <form action="{{url('upload-gangguan')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="file" class="form-control" name="file_bondg" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Unggah</button>
                                </div>
                            </form>
                            <p class="mt-3"> Unduh file template:</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-success" onclick="window.location.href='{{url('unduh-template')}}'">Unduh Template</button>
                                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#tataCara">Tata Cara Pengisian Excel</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Laporan Gangguan</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="/input-bondg" name="bondg" id="bondg" onsubmit="validate(event)">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Posko</label>
                                    <select class="form-control select2" style="width: 100%;" name="posko">
                                        <option>Labuan</option>
                                        <option>Menes</option>
                                        <option>Panimbang</option>
                                        <option>Cibaliung</option>
                                        <option>Sumur</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tanggal lapor</label>
                                    <input type="date" class="form-control" id="exampleInputEmail1" placeholder="Masukkan tanggal..." data-date-format="DD-MM-YYYY" name="tgldg" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Keluhan</label>
                                    <select class="form-control select2" style="width: 100%;" name="keluhan">
                                        @foreach($keluhan as $item)
                                        <option value="{{$item->id}}"> {{$item->nama_gangguan}}</option>
                                        @endforeach
                                        <option value="other">Lainnya...</option>
                                    </select>
                                    <input type="text" class="form-control mt-2" id="exampleInputPassword1" placeholder="Masukkan jenis gangguan lainnya" name="gangguanLainnya" hidden>
                                </div>
                                <div class="form-group" id="nodg">
                                    <label for="exampleInputPassword1">Nomor DG <small>*jika bukan laporan Bon DG harap dikosongi</small></label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Masukkan nomor DG (8 digit)..." name="nodg">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Perbaikan</label>
                                    <select class="form-control select2" style="width: 100%;" name="perbaikan">
                                        @foreach($perbaikan as $item)
                                        <option value="{{$item->id}}"> {{$item->nama_perbaikan}}</option>
                                        @endforeach
                                        <option value="other">Lainnya...</option>
                                        <input type="text" class="form-control mt-2" id="exampleInputPassword1" placeholder="Masukkan jenis perbaikan lainnya" name="perbaikanLainnya" hidden>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nama</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Masukkan nama..." name="namapel" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">ID pelanggan</label>
                                    <input type="text" class="form-control" id="idpelanggan" placeholder="Masukkan id pelanggan (12 digit)..." name="idpel" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Alamat</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Masukkan alamat..." name="alamat" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Gardu</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Masukkan gardu..." name="gardu" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tarif</label>
                                    <select class="form-control select2" style="width: 100%;" name="tarif">
                                        <option>R1</option>
                                        <option>R1M</option>
                                        <option>R2</option>
                                        <option>R3</option>
                                        <option>R1T</option>
                                        <option>R1MT</option>
                                        <option>R2T</option>
                                        <option>R3T</option>
                                        <option>S1</option>
                                        <option>S2</option>
                                        <option>S3</option>
                                        <option>S1T</option>
                                        <option>S2T</option>
                                        <option>P1</option>
                                        <option>P2</option>
                                        <option>P3</option>
                                        <option>P1T</option>
                                        <option>P2T</option>
                                        <option>P3T</option>
                                        <option>I1</option>
                                        <option>I2</option>
                                        <option>I3</option>
                                        <option>I1T</option>
                                        <option>I2T</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Daya</label>
                                    <select class="form-control select2" style="width: 100%;" name="daya">
                                        <option>450</option>
                                        <option>900</option>
                                        <option>1300</option>
                                        <option>2200</option>
                                        <option>3500</option>
                                        <option>4400</option>
                                        <option>5500</option>
                                        <option>6600</option>
                                        <option>7700</option>
                                        <option>10600</option>
                                        <option>11000</option>
                                        <option>13200</option>
                                        <option>15400</option>
                                        <option>16500</option>
                                        <option>17600</option>
                                        <option>22000</option>
                                        <option>23000</option>
                                        <option>27800</option>
                                        <option>33000</option>
                                        <option>35200</option>
                                        <option>41500</option>
                                        <option>44000</option>
                                        <option>53000</option>
                                        <option>66000</option>
                                        <option>82500</option>
                                        <option>105000</option>
                                        <option>131000</option>
                                        <option>145500</option>
                                        <option>147000</option>
                                        <option>164000</option>
                                        <option>197000</option>
                                        <option>233000</option>
                                        <option>240000</option>
                                        <option>279000</option>
                                        <option>329000</option>
                                        <option>345000</option>
                                        <option>414000</option>
                                        <option>415000</option>
                                        <option>526000</option>
                                        <option>555000</option>
                                        <option>690000</option>
                                        <option>865000</option>
                                        <option>1110000</option>
                                        <option>1385000</option>
                                        <option>1455000</option>
                                        <option>1660000</option>
                                        <option>1730000</option>
                                        <option>2180000</option>
                                        <option>2770000</option>
                                        <option>3465000</option>
                                        <option>4330000</option>
                                        <option>4670000</option>
                                        <option>5540000</option>
                                        <option>6930000</option>
                                        <option>8660000</option>
                                        <option>10380000</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">No. HP</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Masukkan no. hp..." name="nohp" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">No. meter lama</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Masukkan no. meter lama (11 digit)..." name="nometerlama" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Merk KWH meter lama</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Masukkan merk KWH meter lama..." name="merk">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Type KWH meter lama</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Masukkan type KWH meter lama..." name="type">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tahun buat KWH meter lama</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Masukkan tahun KWH meter lama..." name="tahun">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Sisa KWH meter lama</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Masukkan sisa KWH meter lama..." name="sisakwh">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- The Modal -->
<div class="modal fade" id="tataCara">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tata Cara Pengisian Excel</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <table class="table-bordered w-100">
                    <thead class="text-center">
                        <th style="width: 40%"> Warna</th>
                        <th> Keterangan</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="background-color: red" class="p-0"></td>
                            <td>Wajib diisi</td>
                        </tr>
                        <tr>
                            <td style="background-color: yellow" class="p-0"></td>
                            <td>Jika gangguan bukan kWh Meter Rusak Ex Bon DG", maka tidak perlu diisi</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table-bordered w-100">
                    <thead class="text-center">
                        <th style="width: 40%"> Item</th>
                        <th> Keterangan</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Sheet Pengisian</td>
                            <td>Pengisian hanya bisa dilakukan di 'Sheet1'</td>
                        </tr>
                        <tr>
                            <td>Baris Pengisian</td>
                            <td>Pengisian bisa dilakukan mulai baris 2</td>
                        </tr>
                        <tr>
                            <td>Pengisian Gangguan dan Perbaikan</td>
                            <td>Gangguan dan perbaikan bisa dilihat di menu input gangguan di website. Apabila jenis gangguan/perbaikan sudah ada di dropdown pilihan di website, harap menuliskan disini secara sama. Agar tidak terjadi penduplikatan data dengan maksud yang sama</td>
                        </tr>
                        <tr>
                            <td>Penghapusan Data</td>
                            <td>Jika ingin menghapus data, harap menggunakan fitur delete row</td>
                        </tr>
                    </tbody>
                </table>

                <h6 class="text-bold text-center"> Pastikan tidak ada nomor dg yang sudah ada dan pastikan tidak terjadi pengulangan data </h6>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
@endsection

@section('js-ext')
<script>
    $('form').on('submit', function(event) {
        $('[type=submit]').attr('disabled', 'disabled');
        $(this).submit();
    });
    $('[name=keluhan]').on('change', function(event) {
        console.log($('[name=keluhan] option:selected').val());
        if ($('[name=keluhan] option:selected').val() == "other") {
            $('[name=gangguanLainnya]').removeAttr('hidden');
            $('[name=gangguanLainnya]').attr('required', 'required');
            $('[id=nodg]').attr('hidden', 'hidden');
            $('[name=nodg]').removeAttr('required');
        } else if ($('[name=keluhan] option:selected').val() == 1) {
            $('[id=nodg]').removeAttr('hidden');
            $('[name=nodg]').attr('required', 'required');
            $('[name=gangguanLainnya]').attr('hidden', 'hidden');
            $('[name=gangguanLainnya]').removeAttr('required');
        } else {
            $('[name=gangguanLainnya]').attr('hidden', 'hidden');
            $('[name=gangguanLainnya]').removeAttr('required');
            $('[id=nodg]').attr('hidden', 'hidden');
            $('[name=nodg]').removeAttr('required');
        }

    });
    $('[name=perbaikan]').on('change', function(event) {
        console.log($('[name=keluhan] option:selected').val());
        if ($('[name=perbaikan] option:selected').val() == "other") {
            $('[name=perbaikanLainnya]').removeAttr('hidden');
            $('[name=perbaikanLainnya]').attr('required', 'required');
        } else {
            $('[name=perbaikanLainnya]').attr('hidden', 'hidden');
            $('[name=perbaikanLainnya]').removeAttr('required');
        }
    });

    function validate(e) {
        var message = '';
        var error = 0;
        e.preventDefault();
        var x = document.forms["bondg"]["nodg"].value.length;
        var xrequired = document.forms["bondg"]["nodg"];
        var y = document.forms["bondg"]["nometerlama"].value.length;
        var z = document.forms["bondg"]["idpel"].value.length;
        if ((x != 8) && xrequired.hasAttribute('required')) {
            error++;
            message += 'Nomor dg harus 8 digit!\n';
        }
        if (y != 11) {
            error++;
            message += 'Nomor meter lama harus 11 digit!\n';
        }
        if (z != 12) {
            error++;
            message += 'Nomor ID Pelanggan harus 12 digit!\n';
        }
        if (error > 0) {
            alert(message);
        } else {
            document.getElementById("bondg").submit();
        }
    }
</script>
<script>
    $(function() {

        $('.select2').select2()
        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {
            'placeholder': 'dd/mm/yyyy'
        })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {
            'placeholder': 'mm/dd/yyyy'
        })
        //Money Euro
        $('[data-mask]').inputmask()
        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            format: 'MM/DD/YYYY h:mm A'
        })
        //Date range as a button
        $('#daterange-btn').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        )
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        })
        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()
        //Timepicker
        $('.timepicker').timepicker({
            showInputs: false
        })
    })
</script>
@endsection