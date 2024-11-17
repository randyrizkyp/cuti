<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class DrhController extends Controller
{
   public function __construct()
   {
      $user = Pegawai::where('id', session('loggedUser'))->first();
      if(!$user){            
         $this->logout();
      }
   }

   public function index()
   {
      return view('pegawai.drh.index', [
         'title' => 'Daftar Riwayat Hidup'
      ]);
   }

   public function pilihdokumen()
   {
      return view('pegawai.dokumen.choose', [
         'title' => 'Pilih Dokumen Pegawai'
      ]);
   }

   public function logout()
   {
      if (session()->has('loggedUser')) {
         session()->pull('loggedUser');
         return redirect('/');
      }        
   }
}
