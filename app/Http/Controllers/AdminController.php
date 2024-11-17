<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pyb;
use App\Models\Cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use PhpOffice\PhpWord\TemplateProcessor;



class AdminController extends Controller
{
   public function __construct()
   {                  
      if (empty(Session::get('loggedAdmin'))) {
			Session::flush();
         Session::regenerate();
         redirect('/signout');
		}
   }

   public function index()
   {
      return view('admin.beranda.index', [
         'title' => 'Beranda'
      ]);
   }   

   public function viewpengajuan()
   {
      $cuti = Cuti::join('users', 'cutis.nip', '=', 'users.nip')->where('cutis.status', 'pengajuan')->orWhere('cutis.status', 'penandatanganan')->get();
      $pyb = Pyb::all();
      $data = [
         'title' => 'Daftar Pengajuan Cuti',
         'cuti' => $cuti,         
         'pyb' => $pyb,
      ];
      return view('admin.pengajuancuti.listcuti', $data);
   }

   public function detailcuti($id)
   {
      $cuti = Cuti::join('users', 'cutis.nip', '=', 'users.nip')->join('pybs', 'cutis.pejabatnip', '=', 'pybs.id')->where('cutis.id_cuti', $id)->first();

      $twoYearsAgo = now()->subYears(2);
      $riwayat = Cuti::join('users', 'cutis.nip', '=', 'users.nip')->where(['cutis.nip' => $cuti->nip, 'status' => 'disetujui'])->whereBetween('cutis.created_at', [$twoYearsAgo, now()])->get();
      $pyb = Pyb::all();
      
      $data = [
            'title' => 'Validasi Pengajuan Cuti',
            'cuti' => $cuti,
            'riwayat' => $riwayat,
            'pyb' => $pyb
      ];
      
      return view('admin.pengajuancuti.validasi', $data);
   }

   function validasicuti(Request $request)
   {
      $id_cuti   = $request->post('id_cuti');
      $validasi   = $request->post('validasi');
      $keterangan = $request->post('keterangan'); 
      if($validasi == 'terima'){

         if($request->dokumencuti){
            $client = new Client();
            $tahun = Carbon::now()->format('Y');
            $dokumencuti = Str::random(30).'.'.$request->dokumencuti->extension();         
            $request->dokumencuti->move(public_path('dokumencuti/'. $tahun), $dokumencuti);
            $fileCuti = 'dokumencuti/' . $tahun . '/' . $dokumencuti;
            //Get Pegawai
            $get_pegawai = "http://10.90.150.3:5001/api/pegawai/". $request->nip;
            $res_pegawai = $client->request('GET', $get_pegawai, [
                  'verify' => false,
            ]);
            $pegawai = json_decode($res_pegawai->getBody());
            $get_url = "http://10.90.150.3:5001/api/tbpd/". $pegawai[0]->kode_pd;
            $res_url = $client->request('GET', $get_url, [
                  'verify' => false,
            ]);
            $url = json_decode($res_url->getBody());
            $data = [                
               'dokumencuti' => $fileCuti,
               'status'      => 'disetujui',
               'no_surat'    => $request->no_surat,
            ];
            $absen = [                
               'nip'       => $request->nip,
               'foto'   => env('APP_URL').$fileCuti,
               'jenis'   => 'cuti',
            ];
            $cuti = Cuti::where('id_cuti', $id_cuti)->first();
            $tgl_awal = Carbon::createFromFormat('d/m/Y',$cuti->tglmulai);
            $tgl_akhir = Carbon::createFromFormat('d/m/Y',$cuti->tglselesai);
            $get_libur = "http://10.90.150.3:5001/api/libur";
            $res_libur = $client->request('GET', $get_libur, [
                  'verify' => false,
            ]);
            $dataLibur = json_decode($res_libur->getBody());
            $daftarTanggalLibur = [];

            $get_liburpus = "http://10.90.150.3:5001/api/libur/puskes";
            $res_liburpus = $client->request('GET', $get_liburpus, [
                  'verify' => false,
            ]);
            $dataLiburpus = json_decode($res_liburpus->getBody());
            $daftarTanggalLiburpus = [];


            // Iterasi data untuk mengonversi format
            foreach ($dataLibur[0] as $libur) {
               $tahun = $libur->tahun;
               $bulan = str_pad($libur->bulan, 2, '0', STR_PAD_LEFT); // Pastikan bulan memiliki dua digit
               $tanggalList = explode(',', $libur->tanggal); // Pisahkan tanggal menjadi array
               
               foreach ($tanggalList as $tanggal) {
                  $tanggalFormatted = str_pad($tanggal, 2, '0', STR_PAD_LEFT); // Pastikan tanggal memiliki dua digit
                  // Gabungkan tahun, bulan, dan tanggal, lalu ubah menjadi format Y-m-d
                  $date = Carbon::createFromFormat('d/m/Y', "$tanggalFormatted/$bulan/$tahun");
                  if ($date) {
                        $daftarTanggalLibur[] = $date->format('d/m/Y'); // Format Y-m-d
                  }
               }
            }

            foreach ($dataLiburpus[0] as $liburpus) {
               $tahun = $liburpus->tahun;
               $bulan = str_pad($liburpus->bulan, 2, '0', STR_PAD_LEFT); // Pastikan bulan memiliki dua digit
               $tanggalList = explode(',', $liburpus->tanggal); // Pisahkan tanggal menjadi array
               
               foreach ($tanggalList as $tanggal) {
                  $tanggalFormatted = str_pad($tanggal, 2, '0', STR_PAD_LEFT); // Pastikan tanggal memiliki dua digit
                  // Gabungkan tahun, bulan, dan tanggal, lalu ubah menjadi format Y-m-d
                  $date = Carbon::createFromFormat('d/m/Y', "$tanggalFormatted/$bulan/$tahun");
                  if ($date) {
                        $daftarTanggalLiburpus[] = $date->format('d/m/Y'); // Format Y-m-d
                  }
               }
            }
            // return $pegawai;
            while ($tgl_awal->lte($tgl_akhir)) {
               if ($pegawai[0]->kode_pd == 'pd_33'){
                  if ($cuti->jeniscuti == 1){
                     if (in_array($tgl_awal->format('d/m/Y'), $daftarTanggalLiburpus)) {
                        $tgl_awal->addDay();
                        continue;
                     }
                     $absen['tanggal'] = $tgl_awal->day;                  
                     $absen['bulan'] = $tgl_awal->month;                  
                     $absen['tahun'] = $tgl_awal->year;
                     $absen['tgl_awal'] = $tgl_awal;
                     $absen['tgl_akhir'] = $tgl_akhir;
                     $response = Http::post($url[0]->url . '/api/cuti/puskesmas', $absen);
                  }else{
                     $absen['tanggal'] = $tgl_awal->day;                  
                     $absen['bulan'] = $tgl_awal->month;                  
                     $absen['tahun'] = $tgl_awal->year;  
                     $absen['tgl_awal'] = $tgl_awal;
                     $absen['tgl_akhir'] = $tgl_akhir;   
                     $response = Http::post($url[0]->url . '/api/cuti/puskesmas', $absen);
               }
               }
               if ($cuti->jeniscuti == 1 && $pegawai[0]->kode_pd != 'pd_33'){
                  if (in_array($tgl_awal->format('d/m/Y'), $daftarTanggalLibur)) {
                     $tgl_awal->addDay();
                     continue;
                  }
                  $absen['tanggal'] = $tgl_awal->day;                  
                  $absen['bulan'] = $tgl_awal->month;                  
                  $absen['tahun'] = $tgl_awal->year;     
                  Http::post($url[0]->url . '/api/cuti', $absen);
               }else if ($pegawai[0]->kode_pd != 'pd_33'){
                  $absen['tanggal'] = $tgl_awal->day;                  
                  $absen['bulan'] = $tgl_awal->month;                  
                  $absen['tahun'] = $tgl_awal->year;     
                  Http::post($url[0]->url . '/api/cuti', $absen);
               }
               $tgl_awal->addDay();
            }
            
            Cuti::where('id_cuti', $id_cuti)->update($data);

            return redirect('/viewpengajuan')->with('success','Pengajuan Cuti Berhasil Disetujui');
         }         

      }elseif ($validasi == 'perubahan'){

         $data = [                
            'status' => 'perubahan',
            'catatan' => $keterangan
         ];
         
         Cuti::where('id_cuti', $id_cuti)->update($data);
         return redirect('/viewpengajuan')->with('success','Pengajuan Cuti Berhasil Perubahan');

      }elseif ($validasi == 'ditangguhkan'){

         $data = [                
            'status' => 'ditangguhkan',
            'catatan' => $keterangan
         ];
         
         Cuti::where('id_cuti', $id_cuti)->update($data);      
         return redirect('/viewpengajuan')->with('success','Pengajuan Cuti Berhasil Ditangguhkan');

      }elseif ($validasi == 'tidakdisetujui'){

         $data = [                
            'status' => 'ditolak',
            'catatan' => $keterangan
         ];
         
         Cuti::where('id_cuti', $id_cuti)->update($data);      
         return redirect('/viewpengajuan')->with('success','Pengajuan Cuti Berhasil Ditolak');
      }
   }

   public function riwayatcuti()
   {      

      $riwayat = Cuti::join('users', 'cutis.nip', '=', 'users.nip')->whereNotIn('cutis.status', ['draft', 'pengajuan'])->get();
      $pyb = Pyb::all();
      $data = [
         'title' => 'Riwayat Pengajuan Cuti',
         'riwayat' => $riwayat,         
         'pyb' => $pyb         
      ];
      return view('admin.riwayatcuti.listriwayat', $data);
   }

   public function detailriwayat($id)
   {
      $cuti = Cuti::join('users', 'cutis.nip', '=', 'users.nip')->where('cutis.nip', $id)->first();      
      
      $data = [
            'title' => 'Detail Riwayat Cuti',
            'cuti' => $cuti      
      ];
      return view('admin.riwayatcuti.riwayat', $data);
   }

   public function prosescuti(Request $request)
   {
      $cuti = Cuti::where('id_cuti', $request->id_cuti);
      if ($request->status == 'ditolak'){
         $data = [
            'status' => 'tms',
            'catatan' => $request->keterangantolak,
         ];
         $cuti->update($data);
      }
      else{
         $data = [
            'status' => 'penandatanganan',
            'catatan' => NULL,
         ];
         $cuti->update($data);
      }

      if($cuti->pluck('jeniscuti')->first() == '1'){
         $jenis_cuti = 'Cuti Tahunan';
      }elseif ($cuti->pluck('jeniscuti')->first() == '2'){
         $jenis_cuti = 'Cuti Besar';
      }elseif ($cuti->pluck('jeniscuti')->first() == '3'){
         $jenis_cuti = 'Cuti Sakit';
      }elseif ($cuti->pluck('jeniscuti')->first() == '4'){
         $jenis_cuti = 'Cuti Melahirkan';
      }elseif ($cuti->pluck('jeniscuti')->first() == '5'){
         $jenis_cuti = 'Cuti Karena Alasan Penting';
      }else{
         $jenis_cuti = 'Cuti di Luar Tanggungan Negara';
      }
      
      $client = new Client();
      $pegawai = "http://10.90.150.3:5001/api/pegawai/". $cuti->pluck('nip')->first();
      $dapeg = $client->request('GET', $pegawai, [
      'verify'  => false,
      ]);
      $data_pegawai = json_decode($dapeg->getBody());
      // return $data_pegawai[0];
      // return $cuti->first();

      Carbon::setLocale('id');
      if($cuti->pluck('jabatan')->first() == '4'){
         $templatePath = storage_path('app/templates/cuti.docx');
      }elseif ($cuti->pluck('jabatan')->first() == '2' || $cuti->pluck('jabatan')->first() == '3'){
         $templatePath = storage_path('app/templates/cutisekda.docx');
      }else{
         $templatePath = storage_path('app/templates/cutigaruda.docx');
      }
      $templateProcessor = new TemplateProcessor($templatePath);
      $templateProcessor->setValue('jenis_cuti', $jenis_cuti);
      $templateProcessor->setValue('tahun', $cuti->pluck('tahun')->first());
      $templateProcessor->setValue('nama', $data_pegawai[0]->nama);
      $templateProcessor->setValue('nip', $cuti->pluck('nip')->first());
      $templateProcessor->setValue('pangkat', $data_pegawai[0]->pangkat);
      $templateProcessor->setValue('jabatan', $data_pegawai[0]->jenis_jbt);
      $templateProcessor->setValue('unit_kerja', $data_pegawai[0]->unit_kerja);
      $templateProcessor->setValue('jmlhari', $cuti->pluck('jmlhari')->first());
      $templateProcessor->setValue('tglmulai', Carbon::createFromFormat('d/m/Y', $cuti->pluck('tglmulai')->first())->translatedFormat('d F Y'));
      $templateProcessor->setValue('tglselesai', Carbon::createFromFormat('d/m/Y', $cuti->pluck('tglselesai')->first())->translatedFormat('d F Y'));
      $templateProcessor->setValue('alamatcuti', $cuti->pluck('alamatcuti')->first());
      $templateProcessor->setValue('tgl', Carbon::now()->translatedFormat('d F Y'));


      $fileName = 'dokumencuti_' . $cuti->pluck('nip') . '.docx';
      $filePath = storage_path($fileName);

        // Simpan file yang dihasilkan
      $templateProcessor->saveAs($filePath);
      return response()->download($filePath)->deleteFileAfterSend(true);

      return back()->with('success','Data Berhasil disimpan');
   }

}