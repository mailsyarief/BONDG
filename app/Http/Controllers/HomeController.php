<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkactivestatus');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        return view('profile');
    }

    public function suntingProfile(Request $request)
    {
        $this->validate($request, [
            'nama' => ['required', 'string',],
            'email' => ['required', 'email',],
            'username' => ['required'],
        ]);    
        $user = Auth::user();  
        if($request->username != $user->username)
        {
            if($request->email != $user->email)
            {
                $this->validate($request, [
                    'username' => ['required', 'unique:users',],
                    'email' => ['required', 'email', 'unique:users',],
                ]);                    
            }
            else
            {
                $this->validate($request, [
                    'username' => ['required', 'unique:users',],
                ]);  
            }
        }
        else
        {
            if($request->email != $user->email)
            {
                $this->validate($request, [
                    'email' => ['required', 'email', 'unique:users',],
                ]);                    
            }
        }        
        DB::BeginTransaction();
        try{
            $user = Auth::user();            
            $user->email = $request->email;
            $user->name = $request->nama;
            $user->username = $request->username;
            $user->save();
            DB::commit();
        } 
        catch (Exception $e) 
        {
            DB::rollback();
        }
        return redirect('/profile')->with('success', 'Profil berhasil disimpan!');
    }

    public function gantiPassword(Request $request)
    {
        $this->validate($request, [
            'password_now' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);      
        
        $userpass = Auth::user();
        //dd(Hash::check($request->password_now, $userpass->password));
        if (!Hash::check($request->password_now, $userpass->password)) {
            return redirect('/profile')->with('danger', 'Password lama anda salah!');
        }
        $newpass = Hash::make($request->password);
        if (Hash::check($request->password_now, $newpass)) {
            return redirect('/profile')->with('danger', 'Password baru tidak boleh sama dengan password lama!');
        }

        DB::BeginTransaction();
        try{
            $user = Auth::user();            
            $user->password = Hash::make($request->password);
            DB::commit();
        } 
        catch (Exception $e) 
        {
            DB::rollback();
        }
        return redirect('/profile')->with('success', 'Password berhasil diubah!');
    }
    
}
