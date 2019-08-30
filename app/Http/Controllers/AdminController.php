<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use \Auth;
use \Session;
use App\bondg;
use App\User;
use App\JenisGangguan;
use App\JenisPerbaikan;
use Carbon\Carbon;
use Storage;
use File;
use Excel;
use App\Exports\BondgExports;
use App\Exports\PenagihanExports;
use App\Imports\BondgImport;
use App\Notifications\OrderNotif;
use Notification;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'checkactivestatus']);
        $this->middleware('admin');
    }


    public function index()
    {
        $today = Carbon::today();
        $bondg = count(bondg::whereDate('tgldg', '=', $today)->get());
        $ap2t = count(bondg::whereDate('tglpk', '=', $today)->get());
        $kirimorang = count(bondg::whereDate('tglkirimpetugas', '=', $today)->get());
        $terpasang = count(bondg::whereDate('tglterpasang', '=', $today)->get());
        // dd(bondg::find('01234568'));
        $remaja = count(bondg::whereDate('tglremaja', '=', $today)->get());
        $batal = count(bondg::whereDate('tglbatal', '=', $today)->orWhere('tglbatal1', '=', $today)->get());
        return view('admin.dashboard', compact('bondg', 'ap2t', 'kirimorang', 'terpasang', 'remaja', 'batal'));
    }
    //bondg
    public function showform_bondg()
    {
        $keluhan = JenisGangguan::all();
        $perbaikan = JenisPerbaikan::all();
        return view('admin.input-bondg', compact('keluhan', 'perbaikan'));
    }

    public function input_bondg(Request $request)
    {
        $bond_aktif = bondg::where('idpel', '=', $request->idpel)->where('status', '!=', 'Remaja')->get()->count();
        if ($bond_aktif > 0) {
            return redirect('/input-gangguan')->with('danger', 'Mohon maaf! Masih ada laporan aktif dengan ID Pelanggan: ' . $request->idpel);
        }
        //if perbaikan sama dengan bondg
        if ($request->keluhan == 1) {
            $nomordg = $request->nodg;
            $nomorKeluhan = 1;
        }
        //if nambah jenis gangguan
        else if ($request->keluhan == "other") {
            DB::BeginTransaction();
            try {
                $data = JenisGangguan::where('nama_gangguan', $request->gangguanLainnya)->get();
                if (count($data) > 0) {
                    return redirect('/input-bondg')->with('danger', 'Jenis gangguan sudah ada!');
                }
                $keluhan = new JenisGangguan();
                $keluhan->nama_gangguan = $request->gangguanLainnya;
                $keluhan->save();
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
            }

            $nomorKeluhan = $keluhan->id;
            $nomordg = $nomorKeluhan . Carbon::now()->format('YmdHis');
        }
        //selain bondg tapi keluhan sudah ada
        else {
            $nomorKeluhan = $request->keluhan;
            $nomordg = $nomorKeluhan . Carbon::now()->format('YmdHis');
            //dd($nomordg, Carbon::now());                
        }

        //perbaikan
        //kalo baru
        if ($request->perbaikan == "other") {
            DB::BeginTransaction();
            try {
                $data = JenisPerbaikan::where('nama_perbaikan', $request->perbaikanLainnya)->get();
                if (count($data) > 0) {
                    return redirect('/input-bondg')->with('danger', 'Jenis perbaikan sudah ada!');
                }
                $perbaikan = new JenisPerbaikan();
                $perbaikan->nama_perbaikan = $request->perbaikanLainnya;
                $perbaikan->save();
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
            }

            $nomorPerbaikan = $perbaikan->id;
        } else {
            $nomorPerbaikan = $request->perbaikan;
        }

        DB::BeginTransaction();
        try {
            $bondg = new bondg;
            $bondg->posko = $request->posko;
            $bondg->tgldg = $request->tgldg;
            $bondg->nodg = $nomordg;
            $bondg->namapel = $request->namapel;
            $bondg->idpel = $request->idpel;
            $bondg->gardu = $request->gardu;
            $bondg->tarif = $request->tarif;
            $bondg->daya = $request->daya;
            $bondg->nohp = $request->nohp;
            $bondg->nometerlama = $request->nometerlama;
            $bondg->alamat = $request->alamat;
            $bondg->id_jenis_gangguan = $nomorKeluhan;
            $bondg->id_jenis_perbaikan = $nomorPerbaikan;
            $bondg->status = "Laporan";
            $bondg->kwhmeterlama_merk = $request->merk;
            $bondg->kwhmeterlama_type = $request->type;
            $bondg->kwhmeterlama_th = $request->tahun;
            $bondg->kwhmeterlama_sisakwh = $request->sisakwh;
            $bondg->waktupengerjaan = 0;
            $bondg->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return redirect('/input-gangguan')->with('success', 'BON DG Berhasil Disimpan');
    }

    public function status_bondg()
    {
        $bondg = bondg::with('jenisGangguan')->with('jenisPerbaikan')->orderBy('tgldg', 'desc')->get();
        $datefrom = null;
        $datetill = null;
        $keluhan = JenisGangguan::all();
        $perbaikan = JenisPerbaikan::all();
        $status = "Semua Status";
        $no = 1;
        return view('admin.status-bondg', compact('bondg', 'no', 'datefrom', 'datetill', 'status', 'keluhan', 'perbaikan'));
    }

    public function filter_bondg(Request $request)
    {
        if ($request->status != 'Semua Status') {
            if ($request->datefrom != NULL) {
                $this->validate($request, [
                    'datetill' => ['required'],
                ]);
                $bondg = bondg::with('jenisGangguan')->with('jenisPerbaikan')->where('status', '=', $request->status)
                    ->whereDate("tgldg", '<=',  $request->datetill)
                    ->whereDate("tgldg", '>=',   $request->datefrom)
                    ->orderBy('tgldg', 'desc')
                    ->get();
            } else if ($request->datetill != NULL) {
                $this->validate($request, [
                    'datefrom' => ['required'],
                ]);
                $bondg = bondg::with('jenisGangguan')->with('jenisPerbaikan')->where('status', '=', $request->status)
                    ->whereDate("tgldg", "<=", $request->datetill)
                    ->whereDate("tgldg", ">=", $request->datefrom)
                    ->orderBy('tgldg', 'desc')
                    ->get();
            } else {
                $bondg = bondg::with('jenisGangguan')->with('jenisPerbaikan')->where('status', '=', $request->status)->orderBy('tgldg', 'desc')->get();
            }
        } else {
            if ($request->datefrom != NULL) {
                $this->validate($request, [
                    'datetill' => ['required'],
                ]);
                $bondg = bondg::with('jenisGangguan')->with('jenisPerbaikan')->whereDate("tgldg", "<=",  $request->datetill)
                    ->whereDate("tgldg", ">=", $request->datefrom)
                    ->orderBy('tgldg', 'desc')
                    ->get();
            } else if ($request->datetill != NULL) {
                $this->validate($request, [
                    'datefrom' => ['required'],
                ]);
                $bondg = bondg::with('jenisGangguan')->with('jenisPerbaikan')->whereDate("tgldg", "<=",  $request->datetill)
                    ->whereDate("tgldg", ">=",  $request->datefrom)
                    ->orderBy('tgldg', 'desc')
                    ->get();
            } else {
                $bondg = bondg::with('jenisGangguan')->with('jenisPerbaikan')->orderBy('tgldg', 'desc')->get();
            }
        }
        $no = 1;
        $datefrom = $request->datefrom;
        $datetill = $request->datetill;
        $status = $request->status;
        return view('admin.status-bondg', compact('bondg', 'no', 'datefrom', 'datetill', 'status'));
    }

    public function detail_bondg(Request $request)
    {
        $id = $request->id;
        $bondg = bondg::with('petugas')->with('jenisGangguan')->with('jenisPerbaikan')->find($id);
        if ($bondg->id_petugasbatal != null) {
            $batal = bondg::with('petugasBatal')->find($id);
            return view('admin.detail-bondg', compact('bondg', 'batal'));
        } else {
            return view('admin.detail-bondg', compact('bondg'));
        }
    }

    public function hapus_bondg(Request $request)
    {
        $id = $request->id;
        $bondg = bondg::find($id);
        $bondg->delete();
        return redirect('/statusbondg')->with('success', 'BON DG Berhasil Dihapus');
    }

    public function edit_bondg(Request $request, $id)
    {
        DB::BeginTransaction();
        try {
            $bondg = bondg::find($id);
            $bondg->posko = $request->posko;
            $bondg->nodg = $request->nodg_new;
            $bondg->namapel = $request->namapel;
            $bondg->idpel = $request->idpel;
            $bondg->gardu = $request->gardu;
            $bondg->tarif = $request->tarif;
            $bondg->daya = $request->daya;
            $bondg->nohp = $request->nohp;
            $bondg->alamat = $request->alamat;
            $bondg->nometerlama = $request->nometerlama;
            $bondg->kwhmeterlama_merk = $request->merk;
            $bondg->kwhmeterlama_type = $request->type;
            $bondg->kwhmeterlama_th = $request->tahun;
            $bondg->kwhmeterlama_sisakwh = $request->sisakwh;
            $bondg->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        ///$admin->notify(new OrderNotif($bondg));
        return redirect('/statusbondg')->with('success', 'BON DG Berhasil Diubah');
    }

    //ap2t
    public function showform_ap2t()
    {
        $bondg = bondg::where('status', '=', 'Laporan')->get();
        $count = 1;
        return view('admin.input-ap2t', compact('bondg', 'norows', 'count'));
    }

    public function search_bondg(Request $request)
    {
        $nobondg = $request->id;
        $bondg = bondg::find($nobondg);
        return view('admin.form-ap2t', compact('bondg'));
    }

    //petugas
    public function search_bondg_2(Request $request)
    {
        $nobondg = $request->nodg;
        $bondg = bondg::where('nodg', '=', $nobondg)->get();
        $norows = count($bondg);
        $petugas = user::where('role', '=', '0')->get();
        $count = 1;
        return view('admin.input-petugas', compact('bondg', 'norows', 'count', 'petugas'));
    }

    public function input_ap2t(Request $request)
    {
        $id = $request->id;
        $bondg = bondg::find($id);
        $validator = Validator::make($request->all(), [
            'noagenda' => ['required', 'string', 'min:18', 'max:18'],
            'nometerbaru' => ['required', 'string', 'min:11', 'max:11'],
            'noagenda' => ['required', 'unique:bondg'],
        ]);

        if ($validator->fails()) {
            return redirect('/input-ap2t')
                ->withErrors($validator)
                ->withInput();
        }
        DB::BeginTransaction();
        try {
            $bondg->noagenda = $request->noagenda;
            $bondg->nometerbaru = $request->nometerbaru;
            $bondg->tglpk = now();
            $bondg->kwhmeterbaru_merk = $request->merk;
            $bondg->kwhmeterbaru_type = $request->type;
            $bondg->kwhmeterbaru_th = $request->tahun;
            $bondg->status = "Cetak PK";
            $bondg->waktupengerjaan = Carbon::now()->diffIndays($bondg->tgldg);
            $bondg->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return redirect('/input-ap2t')->with('success', 'AP2T Berhasil Disimpan');
    }

    public function showform_akun()
    {
        return view('admin.input-akun');
    }

    public function register_akun(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'max:255'],
        ]);
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'active' => 1,
        ]);

        return redirect('/register-akun')->with('success', 'Akun Berhasil Didaftarkan');
    }
    public function gantiPassword(Request $request)
    {
        $this->validate($request, [
            'id' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        DB::BeginTransaction();
        try {
            $user = user::find($request->id);
            $user->password = Hash::make($request->password);
            $user->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return redirect('/daftar-akun')->with('success', 'Password berhasil diubah.');
    }

    public function akun()
    {
        $no = 1;
        $akun = user::where('id', '!=', Auth::user()->id)->where('active', '=', 1)->get();
        return view('admin.akun', compact('no', 'akun'));
    }

    public function activate_akun(Request $request)
    {
        $id = $request->id;
        $user = user::find($id);
        if ($user->active == 1) {
            DB::BeginTransaction();
            try {
                $user->active = 0;
                $user->save();
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
            }
            return redirect('/daftar-akun')->with('success', 'Akun berhasil dinonaktifkan');
        } else {
            DB::BeginTransaction();
            try {
                $user->active = 1;
                $user->save();
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
            }
            return redirect('/daftar-akun')->with('success', 'Akun berhasil diaktifkan');
        }
    }

    public function test($id)
    {
        $bondg = bondg::find($id);
        return view('test', compact('bondg'));
    }

    public function showform_petugas()
    {
        $bondg = bondg::where('status', '=', 'Pengajuan Batal')->orWhere('status', '=', 'Cetak PK')->get();
        $petugas = user::where('role', '=', '0')->where('active', '=', '1')->get();
        $no = 1;
        return view('admin.input-petugas', compact('bondg', 'no', 'petugas'));
    }

    public function tambah_petugas(Request $request)
    {
        $id = $request->id;
        $petugas = user::find($request->petugas);
        $bondg = bondg::find($id);
        DB::BeginTransaction();
        try {
            $bondg->id_petugas = $request->petugas;
            $bondg->status = "Pengiriman WO";
            $bondg->tglkirimpetugas = Carbon::now();
            $bondg->waktupengerjaan = Carbon::now()->diffIndays($bondg->tgldg);
            $bondg->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        //buat kirim notif
        $token = $petugas->token_hp;
        $head = "Ada tugas baru!";
        $body = "Rincian tugas:\nNama Pelanggan: " . $bondg->namapel . "\nAlamat Pelanggan: " . $bondg->alamat;
        $this->kirimnotif($token, $head, $body);

        return redirect('/input-petugas')->with('success', 'Petugas berhasil ditambahkan');
    }

    public function show_remaja()
    {
        $bondg = bondg::where('status', '=', 'Terpasang')->get();
        $no = 1;
        return view('admin.remaja', compact('bondg', 'no'));
    }

    public function remaja(Request $request)
    {
        $this->validate($request, [
            'remaja' => ['required'],
        ]);
        foreach ($request->remaja as $key) {
            $bondg = bondg::find($key);
            DB::BeginTransaction();
            try {
                $bondg->status = "Remaja";
                $bondg->tglremaja = Carbon::now();
                $bondg->filename_kwhlama = null;
                $bondg->filename_kwhbaru = null;
                $bondg->filename_ba = null;
                $bondg->waktupengerjaan = Carbon::now()->diffIndays($bondg->tgldg);
                $bondg->save();
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
            }
        }
        return redirect('/remaja')->with('success', 'Berhasil meremajakan.');
    }

    public function ExportBondg(Request $request)
    {
        if ($request->status != 'Semua Status') {
            if ($request->datefrom != NULL) {
                $this->validate($request, [
                    'datetill' => ['required'],
                ]);
                $bondg = bondg::with('jenisGangguan')->with('jenisPerbaikan')->with('petugas')->where('status', '=', $request->status)
                    ->where("tgldg", '<=',  $request->datetill)
                    ->where("tgldg", '>=',   $request->datefrom)
                    ->get();
            } else if ($request->datetill != NULL) {
                $this->validate($request, [
                    'datefrom' => ['required'],
                ]);
                $bondg = bondg::with('jenisGangguan')->with('jenisPerbaikan')->with('petugas')->where('status', '=', $request->status)
                    ->whereDate("tgldg", "<=", $request->datetill)
                    ->whereDate("tgldg", ">=", $request->datefrom)
                    ->get();
            } else {
                $bondg = bondg::with('petugas')->where('status', '=', $request->status)->get();
            }
        } else {
            if ($request->datefrom != NULL) {
                $this->validate($request, [
                    'datetill' => ['required'],
                ]);
                $bondg = bondg::with('jenisGangguan')->with('jenisPerbaikan')->with('petugas')->whereDate("tgldg", "<=",  $request->datetill)
                    ->whereDate("tgldg", ">=", $request->datefrom)
                    ->get();
            } else if ($request->datetill != NULL) {
                $this->validate($request, [
                    'datefrom' => ['required'],
                ]);
                $bondg = bondg::with('jenisGangguan')->with('jenisPerbaikan')->with('petugas')->whereDate("tgldg", "<=",  $request->datetill)
                    ->whereDate("tgldg", ">=",  $request->datefrom)
                    ->get();
            } else {
                $bondg = bondg::with('jenisGangguan')->with('jenisPerbaikan')->with('petugas')->get();
            }
        }

        $nama_file = 'laporan_bondg_' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new BondgExports($bondg), $nama_file);
    }

    public function penagihan()
    {
        $bondg = bondg::where('status', 'Remaja')->where('downloaded', null)->orWhere('downloaded', 0)->orderBy('tgldg', 'desc')->get();
        $datefrom = null;
        $datetill = null;
        $no = 1;
        return view('admin.penagihan', compact('bondg', 'no', 'datefrom', 'datetill', 'status'));
    }

    public function filter_penagihan(Request $request)
    {

        if ($request->datefrom != NULL) {
            $this->validate($request, [
                'datetill' => ['required'],
            ]);
            $bondg = bondg::where('status', 'Remaja')->whereDate("tgldg", "<=",  $request->datetill)
                ->whereDate("tgldg", ">=", $request->datefrom)->orderBy('tgldg', 'desc')->where('downloaded', null)->get();
        } else if ($request->datetill != NULL) {
            $this->validate($request, [
                'datefrom' => ['required'],
            ]);
            $bondg = bondg::where('status', 'Remaja')->whereDate("tgldg", "<=",  $request->datetill)
                ->whereDate("tgldg", ">=", $request->datefrom)->orderBy('tgldg', 'desc')->where('downloaded', null)->get();
        } else {
            $bondg = bondg::where('status', 'Remaja')->orderBy('tgldg', 'desc')->where('downloaded', null)->get();
        }
        $no = 1;
        $datefrom = $request->datefrom;
        $datetill = $request->datetill;
        $status = $request->status;
        return view('admin.penagihan', compact('bondg', 'no', 'datefrom', 'datetill', 'status'));
    }

    public function ExportPenagihan(Request $request)
    {
        if ($request->datefrom != NULL) {
            $this->validate($request, [
                'datetill' => ['required'],
            ]);
            $bondg = bondg::with('jenisGangguan')->with('jenisPerbaikan')->where('status', 'Remaja')->whereDate("tgldg", "<=",  $request->datetill)
                ->whereDate("tgldg", ">=", $request->datefrom)->orderBy('tgldg', 'desc')->where('downloaded', null)->get();
        } else if ($request->datetill != NULL) {
            $this->validate($request, [
                'datefrom' => ['required'],
            ]);
            $bondg = bondg::with('jenisGangguan')->with('jenisPerbaikan')->where('status', 'Remaja')->whereDate("tgldg", "<=",  $request->datetill)
                ->whereDate("tgldg", ">=", $request->datefrom)->orderBy('tgldg', 'desc')->where('downloaded', null)->get();
        } else {
            $bondg = bondg::with('jenisGangguan')->with('jenisPerbaikan')->where('status', 'Remaja')->orderBy('tgldg', 'desc')->where('downloaded', null)->get();
        }

        $nama_file = 'laporan_penagihan_' . date('Y-m-d_H-i-s') . '.xlsx';

        foreach ($bondg as $item) {
            DB::BeginTransaction();
            try {
                $item->downloaded = 1;
                $item->save();
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
            }
        }
        return Excel::download(new PenagihanExports($bondg), $nama_file);
    }


    private function kirimnotif($hp_param, $title_param, $body_param)
    {

        // $hp_param = "fiwMSdIClyY:APA91bHMf6M0SYtw3txQldAwbtMwjWsSzhnguYaoVKXSNPyXfMwOw5GNakCaSy7-e6WlC3KVgV1H2PRPNwdqbthnpf3_2YY2jFICh9rJufnxKWF0D9V1cxIOJrhX_EO_e6PBN0DY_gPH";
        // $title_param = "Tugas Baru Menanti!";
        // $body_param = "Ada tugas dikecamatan asem asem";

        $url = "http://fcm.googleapis.com/fcm/send";
        $token = $hp_param;
        $serverKey = 'AAAA8LSvV4c:APA91bGOuxL0K4yU1GVBJoXp5hSsnl41l6HYPcdfpGnR1JFtM3jto0Ygf9aGEfOlO_92aETHAcCBrNsG55QFvInuFbCazAqlh2dIub5LhJbSt6C073GBLT3zHTuVcVWXYIR23d6sESRI';
        $title = $title_param;
        $body = $body_param;
        $notification = array('title' => $title, 'body' => $body, 'sound' => 'default', 'badge' => '1');
        $arrayToSend = array('to' => $token, 'notification' => $notification, 'priority' => 'high');
        $json = json_encode($arrayToSend);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key=' . $serverKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        //Send the request
        $response = curl_exec($ch);
        //Close request
        if ($response === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
    }
    public function fotoBeritaAcara($id)
    {
        $bondg = bondg::find($id);
        return view('admin/foto-berita-acara', compact('bondg'));
    }

    public function remaja2(Request $request)
    {
        $bondg = bondg::find($request->remaja);
        DB::BeginTransaction();
        try {
            $bondg->status = "Remaja";
            $bondg->tglremaja = Carbon::now();
            $bondg->waktupengerjaan = Carbon::now()->diffIndays($bondg->tgldg);
            $bondg->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return redirect('/remaja')->with('success', 'Berhasil meremajakan.');
    }

    public function importGangguan(Request $request)
    {
        try {
            $excel = Excel::import(new BondgImport, $request->file('file_bondg'));
            return redirect()->back()->with('success', 'Laporan gangguan berhasil dimasukkan!');
        } catch (\InvalidQueryException $e) {
            return redirect()->back()->withErrors('danger', 'Laporan gangguan berhasil huaa!');
        }
        
    }

    public function unduhTemplate()
    {
        
        $path = public_path() . '/Template Input Komunal Gangguan.xls';
        return response()->download($path);
    }
}
