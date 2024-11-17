<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Login;
use App\Models\Superadmin;
use App\Models\Admin;
use App\Models\Kassubag;
use App\Models\Pegawai;
use App\Models\User;
use GuzzleHttp\Client;
use App\Models\Golongan;
use GuzzleHttp\Exception\RequestException;

class RegisterController extends Controller
{
    public function index()
    {
        $pangkat = Golongan::all();
        $data = [
            'title' => 'Daftar E-Cuti',            
            'pangkat' => $pangkat
         ];

        return view('login.register', $data);
    }

    public function signup(Request $request)
    {
        $this->validate($request, [
            'nip'       => 'required|max:20',
            'nama'      => 'required|max:100',
            'pangkat'   => 'required|max:100',
            'jabatan'   => 'required|max:100',
            'unor'      => 'required|max:150',
            'password'  => 'required|max:50'
        ]);

        $data = [
            'nip'  => $request->nip,
            'nama' => $request->nama,
            'pangkat' => $request->pangkat,
            'jabatan' => $request->jabatan,
            'jenis_jbt' => 'Fungsional',
            'unker' => 'DINAS PENDIDIKAN',
            'unor' => $request->unor,
            'kode_pd' => 'pd_01',
            'password' => sha1($request->password)
        ];

        user::create($data);
        return redirect('/login')->with('registered','Registrasi Akun Berhasil, Mohon menunggu Konfirmasi Akun');
    }

    public function signout()
    {
        Session::flush();
        Session::regenerate();      
        return redirect('/');      
    }

    
}


