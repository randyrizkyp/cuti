<?php

namespace App\Http\Controllers;

use App\Models\Berkaskariskarsu;
use App\Models\Berkaspensiun;
use App\Models\Dataanak;
use App\Models\Datapasangan;
use App\Models\Golongan;
use App\Models\Login;
use App\Models\Opd;
use App\Models\Pegawai;
use App\Models\Pensiun;
use App\Models\Usulan;
use App\Models\Usulankartu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class KassubagController extends Controller
{
   public function __construct()
   {      
      if (empty(Session::get('loggedKassubag'))) {
			Session::flush();
         Session::regenerate();
         redirect('/signout');
		}
   }

   public function index()
   {
      return view('kassubag.beranda.index', [
         'title' => 'Kassubag UP'
      ]);
   }

   public function dataasn()
   {
      $pegawai = Pegawai::where('kode_pd', session('kode_pd'))->where('status', 'aktif')->get();
      $pangkat = Golongan::all();
      $unor = Opd::where('kode_pd', session('kode_pd'))->get();
      
      $data = [
         'title' => 'Daftar ASN',
         'pegawai' => $pegawai,
         'pangkat' => $pangkat,
         'unor' => $unor
      ];
      
      return view('kassubag.daftarasn.index', $data);
   }

   function insertpegawai(Request $request)
   {
      $this->validate($request, [
         'nama'            => 'required|string|max:100',
         'nip'             => 'required|max:30',
         'jenkel'          => 'required|string|max:50',
         'pangkat'         => 'required|string|max:100',         
         'jabatan'         => 'required|string|max:100',         
         'jenis_jbt'       => 'required|string|max:50',         
         'kode_unit'       => 'required|string|max:50',
         'email'           => 'nullable',
         'telepon'         => 'nullable'
      ]);

      $unor = Opd::where('kode_unit', $request->kode_unit)->first();
   
      $data = [         
         'nama'         => $request->nama,
         'nip'          => $request->nip,
         'jenkel'       => $request->jenkel,
         'pangkat'      => $request->pangkat,
         'jabatan'      => $request->jabatan,
         'jenis_jbt'    => $request->jenis_jbt,
         'unit_kerja'   => session('nama_pd'),
         'unit_organisasi' => $unor->unit_organisasi,
         'kode_pd'      => session('kode_pd'),
         'kode_unit'    => $request->kode_unit,
         'status'       => 'aktif',
         'email'        => $request->email,
         'telepon'      => $request->telepon
      ];

      $login = [                  
         'username'     => $request->nip,
         'password'     => strip_tags(sha1('lampura')),
         'role'         => 'pns',
         'pertama'      => 'T'
      ];

      Pegawai::create($data);
      Login::create($login);

      return redirect()->back()->with('success', 'Data Pegawai Berhasil Disimpan');
   }

   function updatepegawai(Request $request)
   {
      $this->validate($request, [
         'nama'            => 'required|string|max:100',
         'nip'             => 'required|max:30',
         'jenkel'          => 'required|string|max:50',
         'pangkat'         => 'required|string|max:100',         
         'jabatan'         => 'required|string|max:100',         
         'jenis_jbt'       => 'required|string|max:50',
         'kode_unit'       => 'required|string|max:50',
         'email'           => 'nullable',
         'telepon'         => 'nullable'
      ]);

      $id_pegawai = $request->id_pegawai;
      $unor = Opd::where('kode_unit', $request->kode_unit)->first();
      
      $data = [         
         'nama'         => $request->nama,
         'nip'          => $request->nip,
         'jenkel'       => $request->jenkel,
         'pangkat'      => $request->pangkat,
         'jabatan'      => $request->jabatan,
         'jenis_jbt'    => $request->jenis_jbt,         
         'unit_organisasi' => $unor->unit_organisasi,
         'kode_unit'    => $request->kode_unit,
         'email'        => $request->email,
         'telepon'      => $request->telepon
      ];            
      
      Pegawai::where('id', $id_pegawai)->update($data);
      return back()->with('update', 'Data Pegawai Berhasil Diupdate');
   }

   public function deletepegawai($id)
   {      
      $data = [         
         'status' => 'nonaktif'
      ];            
      Pegawai::where('id', $id)->update($data);
      return back()->with('delete', 'Data Pegawai Berhasil Dihapus');
   }

   public function pengajuanpensiun()
   {
      $pegawai = Pegawai::where('kode_pd', session('kode_pd'))->get();
      $usulan = Usulan::join('pensiuns', 'usulans.nip', '=', 'pensiuns.nip')->join('pegawais', 'usulans.nip', '=', 'pegawais.nip')->where('pegawais.kode_pd', session('kode_pd'))->get();      
      
      $data = [
         'title' => 'Usulan Pensiun',
         'usulan' => $usulan,
         'pegawai' => $pegawai
      ];
      
      return view('kassubag.ppik.pensiun.usulanpensiun', $data);
   }

   function sessionusulan(Request $request)
   {
      $this->validate($request, [
         'nippensiun'            => 'required',
         'jenis_pemberhentian'   => 'required',
         'tmt_pensiun'           => 'required'         
      ]);      

      $sessusulan['nippensiun'] = $request->nippensiun;
      $sessusulan['jenis_pemberhentian'] = $request->jenis_pemberhentian;
      $sessusulan['tmt_pensiun'] = $request->tmt_pensiun;      
      
      $request->session()->put($sessusulan);

      return redirect()->route('createpengajuan', ['id' => $request->nippensiun]);
   }

   public function createpengajuan($id)
   {
      $pegawai = Pegawai::where('nip', $id)->first();

      return view('kassubag.ppik.pensiun.pengajuan', [
         'title' => 'Pengajuan Pensiun',
         'pegawai' => $pegawai
      ]);
   }

   function insertpensiun(Request $request)
   {
      $this->validate($request, [         
         'nip'                      => 'required|max:20',
         'tmtcpns'                  => 'required',
         'pendidikan_diangkat'      => 'required|string|max:200',
         'tahunlulus'               => 'required',
         'gajipokok'                => 'required',
         'mk_tahun'                 => 'required',         
         'mk_bulan'                 => 'required',        
         'mk_kp_tahun'              => 'required',
         'mk_kp_bulan'              => 'required',         
         'mk_pns_tahun'             => 'required',
         'mk_pns_bulan'             => 'required',
         'mk_pensiun_tahun'         => 'required',
         'mk_pensiun_bulan'         => 'required',
         'cltn_tahun'               => 'required',
         'cltn_bulan'               => 'required',
         'tmt_pensiun'              => 'required',
         'pangkat_pengabdian'       => 'required|string|max:100',
         'alamat_lama'              => 'required',
         'kecamatan_lama'           => 'required|string|max:150',
         'kabupaten_lama'           => 'required|string|max:150',
         'provinsi_lama'            => 'required|string|max:150',
         'kodepos_lama'             => 'required',
         'alamat_baru'              => 'required',
         'kecamatan_baru'           => 'required|string|max:150',
         'kabupaten_baru'           => 'required|string|max:150',
         'provinsi_baru'            => 'required|string|max:150',
         'kodepos_baru'             => 'required'
      ]);
      
      $data = [                  
         'nip'                 => $request->nip,
         'tmtcpns'             => $request->tmtcpns,
         'pendidikan_diangkat' => $request->pendidikan_diangkat,
         'tahunlulus'          => $request->tahunlulus,
         'gajipokok'           => $request->gajipokok,
         'mk_sblmcpns'         => $request->mk_tahun  . ', ' . $request->mk_bulan,         
         'mk_kp_terakhir'      => $request->mk_kp_tahun . ', ' . $request->mk_kp_bulan,         
         'mk_pns'              => $request->mk_pns_tahun . ', ' . $request->mk_pns_bulan,
         'mk_pensiun'          => $request->mk_pensiun_tahun . ', ' . $request->mk_pensiun_bulan,
         'cltn'                => $request->cltn_tahun . ', ' . $request->cltn_bulan,
         'tmt_pensiun'         => $request->tmt_pensiun,
         'pangkat_pengabdian'  => $request->pangkat_pengabdian,
         'alamat_lama'         => $request->alamat_lama,
         'kecamatan_lama'      => $request->kecamatan_lama,
         'kabupaten_lama'      => $request->kabupaten_lama,
         'provinsi_lama'       => $request->provinsi_lama,
         'kodepos_lama'        => $request->kodepos_lama,
         'alamat_baru'         => $request->alamat_baru,
         'kecamatan_baru'      => $request->kecamatan_baru,
         'kabupaten_baru'      => $request->kabupaten_baru,
         'provinsi_baru'       => $request->provinsi_baru,
         'kodepos_baru'        => $request->kodepos_baru,
         'pejabat_kepegawaian' => '272'
      ];

      $usulan = [ 
         'nip'                   => session('nippensiun'),
         'jenis_pemberhentian'   => session('jenis_pemberhentian'),
         'tmt_pensiun'           => session('tmt_pensiun'),         
         'progress'              => 'baru'
      ];      

      Pensiun::create($data);
      Usulan::create($usulan);      

      return redirect()->route('pengajuanpensiun');
   }

   function deleteusulan($id)
   {
      Pensiun::where('nip', $id)->delete();
      Usulan::where('nip', $id)->delete();

      return back()->with('delete', 'Data Usulan Berhasil Dihapus');
   }   

   public function berkaspensiun($id)
   {
      $pegawai = Pegawai::join('opds', 'pegawais.kode_pd', '=', 'opds.kode_pd')->where('pegawais.nip', $id)->first();
      $pensiun = Pensiun::where('nip', $id)->first();

      $berkas = Berkaspensiun::where('nip', $id)->first();

      if(!$berkas){

         $insert = [                                  
               'nip'     => $pensiun->nip,
               'status'     => 'B'
         ];
   
         Berkaspensiun::create($insert);
   
         $data = [
               'title' => 'Berkas Pensiun',
               'pegawai' => $pegawai,
               'pensiun' => $pensiun,
               'berkas'  => $berkas
         ];
         
         return view('kassubag.ppik.pensiun.berkaspensiun', $data);

      }elseif($berkas){

         $pegawai = Pegawai::join('opds', 'pegawais.kode_pd', '=', 'opds.kode_pd')->where('pegawais.nip', $id)->first();
         $pensiun = Pensiun::where('nip', $id)->first();

         $berkas = Berkaspensiun::where('nip', $id)->first();
   
         $data = [
               'title' => 'Berkas Pensiun',
               'pegawai' => $pegawai,
               'pensiun' => $pensiun,
               'berkas'  => $berkas
         ];
         return view('kassubag.ppik.pensiun.berkaspensiun', $data);
         
      }        
   }

   public function anak($id)
   {
      $pegawai = Pegawai::join('opds', 'pegawais.kode_pd', '=', 'opds.kode_pd')->where('pegawais.nip', $id)->first();
      $pensiun = Pensiun::where('nip', $id)->first();

      $dataanak = Dataanak::where('nip', $id)->get();

      $data = [
            'title' => 'Data Anak',
            'pegawai' => $pegawai,
            'pensiun' => $pensiun,
            'dataanak'  => $dataanak
      ];
      return view('kassubag.datapegawai.dataanak', $data);
   }

   public function pasangan($id)
   {
      $pegawai = Pegawai::join('opds', 'pegawais.kode_pd', '=', 'opds.kode_pd')->where('pegawais.nip', $id)->first();
      $pensiun = Pensiun::where('nip', $id)->first();

      $pasangan = Datapasangan::where('nip', $id)->get();

      $data = [
            'title' => 'Data Pasangan',
            'pegawai' => $pegawai,
            'pensiun' => $pensiun,
            'pasangan'  => $pasangan
      ];
      return view('kassubag.datapegawai.datapasangan', $data);
   }

   public function pengajuankariskarsu()
   {
      $pegawai = Pegawai::where('kode_pd', session('kode_pd'))->get();
      $usulan = Usulankartu::join('pegawais', 'usulankartus.nip', '=', 'pegawais.nip')->where('pegawais.kode_pd', session('kode_pd'))->get();            
      
      $data = [
         'title' => 'Usulan Karis Karsu',
         'usulan' => $usulan,
         'pegawai' => $pegawai
      ];
      
      return view('kassubag.ppik.kariskarsu.usulan', $data);
   }

   function insertkaris(Request $request)
   {
      $this->validate($request, [                     
         'nip'             => 'required|string|max:20',         
      ]);

      $data = [                           
         'nip'     => $request->nip,
         'progress'  => 'baru',
      ];      

      Usulankartu::create($data);
      return back()->with('success', 'Data Usulan Karis Karsu Berhasil Dibuat');
   }

   function deletekaris($id)
   {      
      Usulankartu::where('nip', $id)->delete();
      return back()->with('delete', 'Data Usulan Karis Karsu Berhasil Dihapus');
   }


   public function berkaskaris($id)
   {
      $pegawai = Pegawai::join('opds', 'pegawais.kode_pd', '=', 'opds.kode_pd')->where('pegawais.nip', $id)->first();

      $berkas = Berkaskariskarsu::where('nip', $id)->first();

      if(!$berkas){

         $insert = [                                  
               'nip'     => $id,
               'status'     => 'B'
         ];
   
         Berkaskariskarsu::create($insert);
   
         $data = [
               'title' => 'Berkas Karis Karsu',
               'pegawai' => $pegawai,               
               'berkas'  => $berkas
         ];
         
         return view('kassubag.ppik.kariskarsu.berkaskaris', $data);

      }elseif($berkas){

         $pegawai = Pegawai::join('opds', 'pegawais.kode_pd', '=', 'opds.kode_pd')->where('pegawais.nip', $id)->first();         

         $berkas = Berkaskariskarsu::where('nip', $id)->first();
   
         $data = [
               'title' => 'Berkas Karis Karsu',
               'pegawai' => $pegawai,               
               'berkas'  => $berkas
         ];
         return view('kassubag.ppik.kariskarsu.berkaskaris', $data);
         
      }        
   }
}  