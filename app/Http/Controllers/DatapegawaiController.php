<?php

namespace App\Http\Controllers;

use App\Models\Dataanak;
use App\Models\Datapasangan;
use App\Models\Pegawai;
use App\Models\Pensiun;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class DatapegawaiController extends Controller
{
   public function __construct()
   {      
      if (empty(Session::get('loggedUser'))) {
         Session::flush();
         Session::regenerate();
         redirect('/signout');
      }
   }
   
   public function dataanak($id)
   {
      $pegawai = Pegawai::join('opds', 'pegawais.kode_pd', '=', 'opds.kode_pd')->where('pegawais.id', session('id_pegawai'))->first();
      $pensiun = Pensiun::where('nip', $id)->first();

      $dataanak = Dataanak::where('nip', $id)->get();

      $data = [
            'title' => 'Data Anak',
            'pegawai' => $pegawai,
            'pensiun' => $pensiun,
            'dataanak'  => $dataanak
      ];
      return view('pegawai.datapegawai.dataanak', $data);
   }

   function insertanak(Request $request)
   {
      $this->validate($request, [
         'nik'         => 'required|string|max:20',
         'nama'        => 'required|string|max:150',
         'tgllahir'    => 'required',
         'status'      => 'required|string|max:100',
         'ibuayah'     => 'required|string|max:150',        
      ]);         

      $data = [
         'nip'             => session('nip'),                  
         'nik'             => $request->nik,
         'nama'            => $request->nama,
         'tgllahir'        => $request->tgllahir,
         'status'          => $request->status,
         'ibuayah'         => $request->ibuayah         
      ];

      Dataanak::create($data);
      return redirect()->back()->with('success', 'Data Berhasil Ditambah');
   }

   function updateanak(Request $request)
   {
      $this->validate($request, [
         'nik'         => 'required|string|max:20',
         'nama'        => 'required|string|max:150',
         'tgllahir'    => 'required',
         'status'      => 'required|string|max:100',
         'ibuayah'     => 'required|string|max:150',        
      ]);    

      $id = $request->id;

      $data = [
         'nip'             => session('nip'),                  
         'nik'             => $request->nik,
         'nama'            => $request->nama,
         'tgllahir'        => $request->tgllahir,
         'status'          => $request->status,
         'ibuayah'         => $request->ibuayah         
      ];

      Dataanak::where('id', $id)->update($data);
      return redirect()->back()->with('success', 'Data Anak Berhasil Diubah');
   }

   function deleteanak($id)
   {
      $anak = Dataanak::findOrFail($id);
      $anak->delete();        
      return back()->with('delete', 'Data Anak Berhasil Dihapus');
   }

   public function datapasangan($id)
   {
      $pegawai = Pegawai::join('opds', 'pegawais.kode_pd', '=', 'opds.kode_pd')->where('pegawais.id', session('id_pegawai'))->first();
      $pensiun = Pensiun::where('nip', $id)->first();

      $pasangan = Datapasangan::where('nip', $id)->get();

      $data = [
            'title' => 'Data Pasangan',
            'pegawai' => $pegawai,
            'pensiun' => $pensiun,
            'pasangan'  => $pasangan
      ];
      return view('pegawai.datapegawai.datapasangan', $data);
   }

   function insertpasangan(Request $request)
   {
      $this->validate($request, [
         'nik'         => 'required|string|max:20',
         'nama'        => 'required|string|max:150',
         'tgllahir'    => 'required',
         'tglnikah'    => 'required',
         'istrisuamike'=> 'required',
         'status'      => 'required'
      ]);         

      $data = [
         'nip'             => session('nip'),                  
         'nik'             => $request->nik,
         'nama'            => $request->nama,
         'tgllahir'        => $request->tgllahir,
         'tglnikah'        => $request->tglnikah,
         'istrisuamike'    => $request->istrisuamike,
         'status'          => $request->status
      ];

      Datapasangan::create($data);
      return redirect()->back()->with('success', 'Data Pasangan Berhasil Ditambah');
   }

   function updatepasangan(Request $request)
   {
      $this->validate($request, [
         'nik'         => 'required|string|max:20',
         'nama'        => 'required|string|max:150',
         'tgllahir'    => 'required',
         'tglnikah'    => 'required',
         'istrisuamike'=> 'required',
         'status'      => 'required'
      ]);     

      $id = $request->id;

      $data = [
         'nip'             => session('nip'),                  
         'nik'             => $request->nik,
         'nama'            => $request->nama,
         'tgllahir'        => $request->tgllahir,
         'tglnikah'        => $request->tglnikah,
         'istrisuamike'    => $request->istrisuamike,
         'status'          => $request->status
      ];

      Datapasangan::where('id', $id)->update($data);
      return redirect()->back()->with('success', 'Data Pasangan Berhasil Diubah');
   }

   function deletepasangan($id)
   {
      $pasangan = Datapasangan::findOrFail($id);
      $pasangan->delete();        
      return back()->with('delete', 'Data Pasangan Berhasil Dihapus');
   }

}