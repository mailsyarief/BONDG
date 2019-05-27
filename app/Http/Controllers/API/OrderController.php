<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\bondg;
use App\User;
use Carbon\Carbon;
use Validator;
use Storage;
use File;
use DB;

class OrderController extends Controller
{
    public function login(Request $request)
    {
        $validate = [
            'username'=>'required|string',
            'password'=>'required|min:8'
        ];

        $validator = Validator::make($request->all(), $validate);
        if ($validator->fails()) 
        {
            // Validation failed
            return response()->json([
                'error' => 1,
                'message' => [
                    "id"=> 0,
                    "name" => "-",
                    "email" => "-",
                    "email_verified_at" => null,
                    "remember_token" => "-",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now(),
                    "role" => 0,
                    "active" => 0,
                    "username" => "-"
                ],
            ]); 
        } 
        else
        {
            $user = User::where('username',$request->username)->first();
            if($user)
            {
                if($user->active == 1)
                {
                    if( password_verify($request->password, $user->password) )
                    {
                        $token = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 10);
                        $postArray = ['remember_token' => $token, 'token_hp'=> $request->token_hp];
                        $login = User::where('username',$request->username)->update($postArray);
                        $user = User::where('username',$request->username)->first();
                        if($login) 
                        {
                            return response()->json([
                                'error' => 0,
                                'message' => $user,
                            ]);
                            
                        }
                    }   
                    else
                    {

                        return response()->json([
                            'error' => 1,
                            'message' => [
                                "id"=> 0,
                                "name" => "-",
                                "email" => "-",
                                "email_verified_at" => null,
                                "remember_token" => "-",
                                "created_at" => Carbon::now(),
                                "updated_at" => Carbon::now(),
                                "role" => 0,
                                "active" => 0,
                                "username" => "-"
                            ],
                        ]); 
                    } 
                }
                else
                {
                    return response()->json([
                        'error' => 1,
                        'message' => [
                            "id"=> 0,
                            "name" => "-",
                            "email" => "-",
                            "email_verified_at" => null,
                            "remember_token" => "-",
                            "created_at" => Carbon::now(),
                            "updated_at" => Carbon::now(),
                            "role" => 0,
                            "active" => 0,
                            "username" => "-"
                        ],
                    ]); 
                }                           
            }
            else
            {
                return response()->json([
                    'error' => 1,
                    'message' => [
                        "id"=> 0,
                        "name" => "-",
                        "email" => "-",
                        "email_verified_at" => null,
                        "remember_token" => "-",
                        "created_at" => Carbon::now(),
                        "updated_at" => Carbon::now(),
                        "role" => 0,
                        "active" => 0,
                        "username" => "-"
                    ],
                ]); 
            } 
        }
    }

    public function logout(Request $request)
    {
        $token = $request->token;
        $user = User::where('remember_token',$token)->first();
        if($user) 
        {
            $postArray = ['remember_token' => null];
            $logout = User::where('id',$user->id)->update($postArray);
            if($logout) {
                return response()->json([
                    'error' => 0,
                    'message' => 'User Logged Out',
                ]);
            }
        } 
        else {
            return response()->json([
                'error' => 1,
                'message' => 'User not found',
            ]);
        }
    }
    
    public function GetOrder(Request $request)
    {   
        $user = User::where('remember_token', $request->token)->where('active', 1)->first();
        if($user == NULL)
        {
            return response()->json(['error' => 1,'message' => 'Token Salah!'], 200);  
        }
        else
        {
            $petugas = User::where('remember_token', $request->token)->where('active', 1)->first();
            $bondg = bondg::select('posko', 'nodg as id_laporan', 'namapel as nama_pelapor', 'nohp as no_hp_pelapor',
                'alamat as alamat_pelapor', 'keluhan', 'noagenda as nomor_agenda', 'tgldg as tgl_bln_thn', 'nometerlama as no_meter_lama', 'nometerbaru as no_meter_baru',
                'daya', 'gardu', 'perbaikan', 'tglkirimpetugas as tgl_kirim_petugas' )
                ->where('id_petugas', '=', $petugas->id)
                ->where('status', '=', 'Pengiriman WO')
                ->get();

            return response()->json(array(
                'error' => 0,
                'message' => $bondg->toArray(),
            ), 200);
        }
        
    }

    public function GetDetailOrder (Request $request)
    {

        $user = User::where('remember_token', $request->token)->where('active', 1)->first();
        if($user == NULL)
        {
            return response()->json(['error' => 1,'message' => 'Token Salah!'], 200);  
        }
        else
        {
            $request->validate([
                'id_laporan' => 'required',
            ]);
            $petugas = User::where('remember_token', $request->token)->where('active', 1)->first();        
            $bondg = bondg::select('posko', 'nodg as id_laporan', 'namapel as nama_pelapor', 'nohp as no_hp_pelapor',
                'alamat as alamat_pelapor', 'keluhan', 'noagenda as nomor_agenda', 'tgldg as tgl_bln_thn', 'nometerlama as no_meter_lama', 'nometerbaru as no_meter_baru',
                'daya', 'gardu', 'perbaikan', 'tglkirimpetugas as tgl_kirim_petugas' )
                ->where('nodg', '=', $request->id_laporan)
                ->get();
            $idpetugas = bondg::where('nodg', '=', $request->id_laporan)->get();
            
            
            if( $petugas->id == $idpetugas[0]->id_petugas)
            {
                return response()->json(array(
                    'error' => 0,
                    'message' => $idpetugas->toArray(),
                ), 200);
            }
            else
            {
                return response()->json(array(
                    'error' => 1,
                    'message' => "Unauthorized",
                ), 200);
            }
        }
        
    }

    public function CancelOrder(Request $request)
    {

        $user = User::where('remember_token', $request->token)->where('active', 1)->first();
        if($user == NULL)
        {
            return response()->json(['error' => 1,'message' => 'Token Salah!'], 200);  
        }
        else
        {
            $request->validate([
                'id_laporan' => 'required',
                'alasan' => 'required',
            ]);
    
            $bondg = bondg::find($request->id_laporan);
            if($bondg->cancel_1 == NULL)
            {
                
                DB::BeginTransaction();
                try{
                    $bondg->cancel_1 = $request->alasan;
                    $bondg->save();
                    DB::commit();
                } 
                catch (Exception $e) 
                {
                    DB::rollback();
                }  
                return response()->json([
                    'error' => 0,
                    'message' => "Pembatalan berhasil diajukan",
                ]);
            }
            else
            {
                DB::BeginTransaction();
                try{
                    $bondg->cancel_2 = $request->alasan;
                    $bondg->tglbatal = Carbon::now();
                    $bondg->status = "Batal";
                    $bondg->waktupengerjaan = Carbon::now()->diffIndays($bondg->tgldg);
                    $bondg->save();
                    DB::commit();
                } 
                catch (Exception $e) 
                {
                    DB::rollback();
                }                  
                return response()->json([
                    'error' => 0,
                    'message' => "Pembatalan berhasil diajukan",
                ]);
            }
        }
        
    }
    public function DoOrder(Request $request)
    {
        $user = User::where('remember_token', $request->token)->where('active', 1)->first();
        if($user == NULL)
        {
            return response()->json(['error' => 1,'message' => 'Token Salah!'], 200);  
        }
        else
        {
            $bondg = bondg::find($request->id_laporan);

            $kwhlama = $request->kwhlama;
            $kwhbaru = $request->kwhbaru;
            $beritaacara = $request->beritaacara;           
               
            DB::BeginTransaction();
            try{
                $bondg->filename_kwhlama = $kwhlama;
                $bondg->filename_kwhbaru = $kwhbaru;
                $bondg->filename_ba = $beritaacara;
                $bondg->status = "Terpasang";
                $bondg->tglterpasang = Carbon::now();
                $bondg->waktupengerjaan = Carbon::now()->diffIndays($bondg->tgldg);
                $bondg->save();
            } 
            catch (Exception $e) 
            {
                DB::rollback();
            }    
            return response()->json([
                'error' => 0,
                'message' => 'Berhasil Upload',
            ]);   
        }
    }

    public function test()
    {
        return view('admin.exp-penagihan');
    }
}
