<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Cuti;
use App\Models\Pyb;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PengajuanController extends Controller
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
        $pegawai = Pegawai::join('opds', 'pegawais.kode_pd', '=', 'opds.kode_pd')->where('pegawais.id', session('id_pegawai'))->first();
        // return $pegawai;
        $client = new Client();
        $uker = Session::get('kode_pd');
        $url = "http://10.90.150.3:5001/api/uker/". $uker;
        $response = $client->request('GET', $url, [
            'verify'  => false,
        ]);
        $data = json_decode($response->getBody());
        $ukers = collect($data)->first();                
        // return $uker;
        $get_libur = "http://10.90.150.3:5001/api/libur";
        $res_libur = $client->request('GET', $get_libur, [
            'verify' => false,
        ]);
        $libur = json_decode($res_libur->getBody());
        // return $libur;
        $nip = session('nip');
        $tahun_s = Carbon::now()->year;
        $tahun_c = Cuti::where([
            'nip' => $nip,
            'status' => 'disetujui'
        ])->get(['tglmulai', 'jmlhari']);        
        $jml_hari = 0;
        $jml_hari_n = 0;
        foreach($tahun_c as $c) {
            $array = $c['tglmulai'];
            $array_cuti = Carbon::createFromFormat('d/m/Y', $array)->year;
            if ($array_cuti == $tahun_s){
                $jml_hari += $c->jmlhari;
            }
            if ($array_cuti == ($tahun_s - 1)){
                $jml_hari_n += $c->jmlhari;
            }
        }
        
        if ($jml_hari_n < 6) {
            $jml_hari_n = 6;
        }
        // return $jml_hari_n;
        $t_jml_hari = 12 - $jml_hari;
        $t_jml_hari_n = 12 - $jml_hari_n;
        $sisa_cuti = $t_jml_hari + $t_jml_hari_n;
        
        $draft = Cuti::where('nip', session('nip'))->where('status', 'draft')->first();
        $pyb = Pyb::all();
        $jabatan = Jabatan::all();
        // return $sisa_cuti;
        if($draft){
            $tgl_mulai = Carbon::createFromFormat('d/m/Y', $draft->tglmulai)->format('Y-m-d');
            $jenis_cuti = $draft->jeniscuti;
            $jml_hari = $draft->jmlhari;
            $alamat = $draft->alamatcuti;
        }
        else{
            $tgl_mulai = Carbon::now()->format('d/m/Y');
        }
        if(!$draft){
            return view('pegawai.pengajuancuti.index', [
                'title' => 'Pengajuan Cuti',
                'pegawai' => $pegawai,
                'data_uker' => $ukers,
                'libur' => $libur,                
                'sisa_cuti' => $sisa_cuti,                
                'pyb' => $pyb,                
                'jabatan' => $jabatan,                
            ]);
        }else{
            return view('pegawai.pengajuancuti.edit', [
                'title' => 'Pengajuan Cuti',
                'pegawai' => $pegawai,
                'data_uker' => $ukers,
                'libur' => $libur,
                'draft' => $draft,
                'tgl_mulai' => $tgl_mulai,
                'sisa_cuti' => $sisa_cuti,    
                'pyb' => $pyb, 
                'jabatan' => $jabatan,                
            ]);
        }
        
    }

    public function proseslibur(Request $request)
    {
        $jumlahHari = $request->input('jumlahHari');
        $startDate = $request->input('startDate');
        $parse = Carbon::parse($startDate);
        $tanggal_awal = $parse->format('d/m/Y');
        //libur
        $libur = $request->input('libur');
        $processedData = [];

        foreach ($libur as $itemArray) {
            foreach ($itemArray as $item) {
                // Lakukan pemrosesan yang diperlukan
                
                $tahun = $item['tahun'];
                $bulan = $item['bulan'];
                
                $tanggalArray = explode(',', $item['tanggal']); 
                foreach ($tanggalArray as $hari) {
                    // Buat tanggal lengkap dengan tahun, bulan, dan hari
                    $tanggalLengkap = Carbon::createFromDate($tahun, $bulan, $hari);
                    $tgl = $tanggalLengkap->format('d/m/Y');
                    $result[] = $tanggalLengkap->format('d/m/Y');
                }            
            }
        }


        $y = $jumlahHari;
        $z = $parse->copy();
        while ($y > 0) {
            // Cek apakah hari ini libur
            if (!in_array($z->format('d/m/Y'), $result)) {
                // Jika tidak libur, kurangi jumlah hari cuti yang tersisa
                $y--;
            }
            // Tambah 1 hari
            $z->addDay();
        }
        $z->subDay();
        // $z->subDay();
        $tgl_akhir = $z->format('d/m/Y');
        // Lakukan proses dengan data yang diterima
        // Misalnya, simpan ke database atau validasi data
        
        return response()->json(['success' => true, 'tgl_akhir' => $tgl_akhir]);    
    }

    function insertcuti(Request $request)
    {
        $client = new Client();
        $get_nama = "http://10.90.150.3:5001/api/pegawai/".$request->atasan;
        $res_nama = $client->request('GET', $get_nama, [
            'verify' => false,
        ]);
        $namaatasan = json_decode($res_nama->getBody());
        if($request->submit == 'draft'){
            
            if($request->dokumen){
                $tahun = Carbon::now()->format('Y');
                $dokumen = Str::random(30).'.'.$request->dokumen->extension();         
                $request->dokumen->move(public_path('dokumenpengajuan/'. $tahun), $dokumen);
                               
                $filePengajuan = 'dokumenpengajuan/' . $tahun . '/' . $dokumen;
            
                $data = [
                    'nip'        => session('nip'),
                    'tanggal'    => date('Y-m-d'),
                    'tahun'  => Carbon::parse($request->mulai)->year,
                    'jeniscuti'  => $request->jeniscuti,
                    'jmlhari'    => $request->jmlhari,
                    'tglmulai'   => Carbon::parse($request->mulai)->format('d/m/Y'),
                    'tglselesai' => $request->selesai,
                    'alasancuti' => $request->alasan,
                    'alamatcuti' => $request->alamat,
                    'jabatan' => $request->jabatan,
                    'telepon'    => $request->hp,
                    'masa_kerja'  => $request->masa_kerja,
                    'namaatasan'  => $namaatasan[0]->nama,
                    'kd_jab'  => $request->kd_jab,
                    'atasannip'  => $request->atasan,
                    'pejabatnip' => $request->pejabat,
                    'dokumen'    => $filePengajuan,
                    'status'     => 'draft'
                ];

                Cuti::create($data);                
                return redirect('/cetak')->with('success','Status Proses Permohonan Berhasil Dikirim');
               

            }else{
                $data = [
                    'nip'        => session('nip'),
                    'tanggal'    => date('Y-m-d'),
                    'tahun'  => Carbon::parse($request->mulai)->year,
                    'jeniscuti'  => $request->jeniscuti,
                    'jmlhari'    => $request->jmlhari,
                    'tglmulai'   => Carbon::parse($request->mulai)->format('d/m/Y'),
                    'tglselesai' => $request->selesai,
                    'alasancuti' => $request->alasan,
                    'alamatcuti' => $request->alamat,
                    'jabatan' => $request->jabatan,
                    'telepon'    => $request->hp,
                    'masa_kerja'  => $request->masa_kerja,
                    'namaatasan'  => $namaatasan[0]->nama,
                    'kd_jab'  => $request->kd_jab,
                    'atasannip'  => $request->atasan,
                    'pejabatnip' => $request->pejabat,                
                    'status'     => 'draft'
                ];

                Cuti::create($data);
                return redirect('/cetak')->with('success','Status Proses Permohonan Berhasil Dikirim');
           
            }
        }elseif($request->submit == 'kirim'){

            if($request->dokumen){

                $tahun = Carbon::now()->format('Y');
                $dokumen = Str::random(30).'.'.$request->dokumen->extension();         
                $request->dokumen->move(public_path('dokumenpengajuan/'. $tahun), $dokumen);
                               
                $filePengajuan = 'dokumenpengajuan/' . $tahun . '/' . $dokumen;        
            
                $data = [
                    'nip'        => session('nip'),        
                    'tanggal'    => date('Y-m-d'),
                    'tahun'  => Carbon::parse($request->mulai)->year,            
                    'jeniscuti'  => $request->jeniscuti,
                    'jmlhari'    => $request->jmlhari,
                    'tglmulai'   => Carbon::parse($request->mulai)->format('d/m/Y'),
                    'tglselesai' => $request->selesai,
                    'alasancuti' => $request->alasan,
                    'alamatcuti' => $request->alamat,
                    'telepon'    => $request->hp,
                    'masa_kerja'  => $request->masa_kerja,
                    'namaatasan'  => $namaatasan[0]->nama,
                    'kd_jab'  => $request->kd_jab,
                    'atasannip'  => $request->atasan,
                    'pejabatnip' => $request->pejabat,
                    'dokumen'    => $filePengajuan,
                    'status'     => 'pengajuan'
                ];

                Cuti::create($data);
                return redirect('/user')->with('success','Status Proses Permohonan Berhasil Dikirim');
            
                
            }else{
                return redirect('/pengajuan')->with('error','Mohon Lengkapi Persyaratan Pengajuan Cuti');
            }
        }
        
    }

    function updatecuti(Request $request)
    {
        $client = new Client();
        $get_nama = "http://10.90.150.3:5001/api/pegawai/".$request->atasan;
        $res_nama = $client->request('GET', $get_nama, [
            'verify' => false,
        ]);
        $namaatasan = json_decode($res_nama->getBody());
        if($request->submit == 'draft'){
            if($request->dokumen){

                $tahun = Carbon::now()->format('Y');
                $dokumen = Str::random(30).'.'.$request->dokumen->extension();         
                $request->dokumen->move(public_path('dokumenpengajuan/'. $tahun), $dokumen);
                               
                $filePengajuan = 'dokumenpengajuan/' . $tahun . '/' . $dokumen;

                $data = [
                    'nip'        => session('nip'),     
                    'tanggal'    => date('Y-m-d'),
                    'tahun'  => Carbon::parse($request->mulai)->year,               
                    'jeniscuti'  => $request->jeniscuti,
                    'jmlhari'    => $request->jmlhari,
                    'tglmulai'   => Carbon::parse($request->mulai)->format('d/m/Y'),
                    'tglselesai' => $request->selesai,
                    'alasancuti' => $request->alasan,
                    'alamatcuti' => $request->alamat,
                    'jabatan' => $request->jabatan,
                    'telepon'    => $request->hp,
                    'masa_kerja'  => $request->masa_kerja,
                    'namaatasan'  => $namaatasan[0]->nama,
                    'kd_jab'  => $request->kd_jab,
                    'atasannip'  => $request->atasan,
                    'pejabatnip' => $request->pejabat,
                    'dokumen'    => $filePengajuan,
                    'status'    => 'draft'
                ];

                Cuti::where('id_cuti', $request->id)->update($data);
                return redirect('/cetak')->with('success','Status Proses Permohonan Berhasil Dikirim');
          
            }else{
                $data = [
                    'nip'        => session('nip'),              
                    'tanggal'    => date('Y-m-d'),
                    'tahun'  => Carbon::parse($request->mulai)->year,      
                    'jeniscuti'  => $request->jeniscuti,
                    'jmlhari'    => $request->jmlhari,
                    'tglmulai'   => Carbon::parse($request->mulai)->format('d/m/Y'),
                    'tglselesai' => $request->selesai,
                    'alasancuti' => $request->alasan,
                    'alamatcuti' => $request->alamat,
                    'jabatan' => $request->jabatan,
                    'telepon'    => $request->hp,
                    'masa_kerja'  => $request->masa_kerja,
                    'namaatasan'  => $namaatasan[0]->nama,
                    'atasannip'  => $request->atasan,
                    'pejabatnip' => $request->pejabat,                
                    'status'     => 'draft'
                ];

                Cuti::where('id_cuti', $request->id)->update($data);
                return redirect('/cetak')->with('success','Status Proses Permohonan Berhasil Dikirim');
  
            }
        }elseif($request->submit == 'kirim'){

            if($request->dokumen){

                $tahun = Carbon::now()->format('Y');
                $dokumen = Str::random(30).'.'.$request->dokumen->extension();         
                $request->dokumen->move(public_path('dokumenpengajuan/'. $tahun), $dokumen);
                               
                $filePengajuan = 'dokumenpengajuan/' . $tahun . '/' . $dokumen;
            
                $data = [
                    'nip'        => session('nip'),            
                    'tanggal'    => date('Y-m-d'),
                    'tahun'  => Carbon::parse($request->mulai)->year,        
                    'jeniscuti'  => $request->jeniscuti,
                    'jmlhari'    => $request->jmlhari,
                    'tglmulai'   => Carbon::parse($request->mulai)->format('d/m/Y'),
                    'tglselesai' => $request->selesai,
                    'alasancuti' => $request->alasan,
                    'alamatcuti' => $request->alamat,
                    'jabatan' => $request->jabatan,
                    'telepon'    => $request->hp,
                    'masa_kerja'  => $request->masa_kerja,
                    'atasannip'  => $request->atasan,
                    'pejabatnip' => $request->pejabat,
                    'dokumen'    => $filePengajuan,
                    'status'     => 'pengajuan'
                ];

                Cuti::where('id_cuti', $request->id)->update($data);
                return redirect('/user')->with('success','Status Proses Permohonan Berhasil Dikirim');
                
            }else{
                return redirect('/pengajuan')->with('error','Mohon Lengkapi Persyaratan Pengajuan Cuti');
            }
        }
        
    }


    public function logout()
    {
        if (session()->has('loggedUser')) {
            session()->pull('loggedUser');
            return redirect('/');
        }        
    }
}
