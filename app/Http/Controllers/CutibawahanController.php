<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CutibawahanController extends Controller
{
   public function index()
   {
      $cuti = Cuti::join('users', 'cutis.nip', '=', 'users.nip')->where('cutis.atasannip', Session::get('nip'))->get();

      $data = [
         'title' => 'Daftar Cuti Bawahan',
         'cuti' => $cuti         
      ];
      return view('pegawai.cutibawahan.index', $data);
   }   

   public function detailbawahan($id)
   {
      $cuti = Cuti::join('users', 'cutis.nip', '=', 'users.nip')->where('cutis.nip', $id)->first();      
      
      $data = [
            'title' => 'Detail Cuti Bawahan',
            'cuti' => $cuti      
      ];
      return view('pegawai.cutibawahan.detail', $data);
   }

   function validasicuti(Request $request)
   {
      $nip   = $request->post('nip');
      $validasi   = $request->post('validasi');
      $keterangan = $request->post('keterangan');

      if($validasi == 'terima'){

         $data = [                
            'status' => 'disetujui'
         ];
         
         Cuti::where('nip', $nip)->update($data);         

         return redirect('/viewpengajuan')->with('success','Pengajuan Cuti Berhasil Disetujui');

      }elseif ($validasi == 'tolak'){

         $data = [                
            'status' => 'ditolak',
            'catatan' => $keterangan
         ];
         
         Cuti::where('nip', $nip)->update($data);      

         return redirect('/viewpengajuan')->with('success','Pengajuan Cuti Berhasil Ditolak');
      }        
   }
}