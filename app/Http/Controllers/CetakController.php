<?php

namespace App\Http\Controllers;

use PhpOffice\PhpWord\TemplateProcessor;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Models\Cuti;
use App\Models\Pyb;
use GuzzleHttp\Client;
use Illuminate\Http\Request;



class CetakController extends Controller
{
    public function cetak(Request $request)
    {
        Carbon::setLocale('id');
        $tanggal = Carbon::now()->translatedFormat('d F Y');
        $nama = ucwords(Session::get('nama'));
        $jabatan = ucwords(Session::get('jabatan'));
        $uker = ucwords(Session::get('nama_pd'));
        $nip = Session::get('nip');
        $checkmark = html_entity_decode('&#10004;', ENT_COMPAT, 'UTF-8');

        $cuti = Cuti::where(['nip' => $nip, 'status' => 'draft'])->get();
        $jeniscuti = $cuti->pluck('jeniscuti')->first();
        $alasancuti = $cuti->pluck('alasancuti')->first();
        $jmlhari = $cuti->pluck('jmlhari')->first();
        $tglmulai = $cuti->pluck('tglmulai')->first();
        $tglselesai = $cuti->pluck('tglselesai')->first();
        $alamatcuti = $cuti->pluck('alamatcuti')->first();
        $masa_kerja = $cuti->pluck('masa_kerja')->first();
        $telepon = $cuti->pluck('telepon')->first();
        $client = new Client();
        $pegawai = "http://10.90.150.3:5001/api/pegawai/". $cuti->pluck('atasannip')->first();
        $data = $client->request('GET', $pegawai, [
        'verify'  => false,
        ]);
        $data_pegawai = json_decode($data->getBody());
        $namaatasan = $data_pegawai[0]->nama;
        $pyb = $cuti->pluck('pejabatnip')->first();
        $pybs = Pyb::where('kd',$pyb)->get();
        $pejabatnama = $pybs->pluck('namapyb')->first();
        if ($pyb == '1'){
            $nips = '';
        }else {
            $nips = 'NIP. ';
        }
        // return $jeniscuti;
        // Lokasi template
        $templatePath = storage_path('app/templates/template.docx');

        // Buat TemplateProcessor
        $templateProcessor = new TemplateProcessor($templatePath);

        // Ganti placeholder dengan data dinamis
        $templateProcessor->setValue('tanggal', $tanggal);
        $templateProcessor->setValue('nama', $nama);
        $templateProcessor->setValue('jabatan', $jabatan);
        $templateProcessor->setValue('unit_kerja', $uker);
        $templateProcessor->setValue('nip', $nip);
        if ($jeniscuti == 1){
            $templateProcessor->setValue('t', $checkmark);
            $templateProcessor->setValue('b', '');
            $templateProcessor->setValue('s', '');
            $templateProcessor->setValue('m', '');
            $templateProcessor->setValue('p', '');
            $templateProcessor->setValue('n', '');
        }elseif ($jeniscuti == 2) {
            $templateProcessor->setValue('t', '');
            $templateProcessor->setValue('b', $checkmark);
            $templateProcessor->setValue('s', '');
            $templateProcessor->setValue('m', '');
            $templateProcessor->setValue('p', '');
            $templateProcessor->setValue('n', '');
        }elseif($jeniscuti == 3){
            $templateProcessor->setValue('t', '');
            $templateProcessor->setValue('b', '');
            $templateProcessor->setValue('s', $checkmark);
            $templateProcessor->setValue('m', '');
            $templateProcessor->setValue('p', '');
            $templateProcessor->setValue('n', '');
        }elseif ($jeniscuti == 4) {
            $templateProcessor->setValue('t', '');
            $templateProcessor->setValue('b', '');
            $templateProcessor->setValue('s', '');
            $templateProcessor->setValue('m', $checkmark);
            $templateProcessor->setValue('p', '');
            $templateProcessor->setValue('n', '');
        }elseif($jeniscuti == 5){
            $templateProcessor->setValue('t', '');
            $templateProcessor->setValue('b', '');
            $templateProcessor->setValue('s', '');
            $templateProcessor->setValue('m', '');
            $templateProcessor->setValue('p', $checkmark);
            $templateProcessor->setValue('n', '');
        }else{
            $templateProcessor->setValue('t', '');
            $templateProcessor->setValue('b', '');
            $templateProcessor->setValue('s', '');
            $templateProcessor->setValue('m', '');
            $templateProcessor->setValue('p', '');
            $templateProcessor->setValue('n', $checkmark);
        }
        $templateProcessor->setValue('alasan_cuti', $alasancuti);
        $templateProcessor->setValue('hari', $jmlhari);
        $templateProcessor->setValue('tgl_awal', $tglmulai);
        $templateProcessor->setValue('tgl_akhir', $tglselesai);
        $templateProcessor->setValue('alamat', $alamatcuti);
        $templateProcessor->setValue('tlp', $telepon);
        $templateProcessor->setValue('masa_kerja', $masa_kerja);
        $templateProcessor->setValue('nama_a', $namaatasan);
        $templateProcessor->setValue('nip_a', $cuti->pluck('atasannip')->first());
        $templateProcessor->setValue('nama_b', $pejabatnama);
        $templateProcessor->setValue('nips', $nips);
        $templateProcessor->setValue('nip_b', $pybs->pluck('pyb_nip')->first());


        // Nama file yang akan dihasilkan
        $fileName = 'cuti_' . $nip . '.docx';
        $filePath = storage_path($fileName);

        // Simpan file yang dihasilkan
        $templateProcessor->saveAs($filePath);

        // Kirim file untuk diunduh
        return response()->download($filePath)->deleteFileAfterSend(true);
      
    }

}
