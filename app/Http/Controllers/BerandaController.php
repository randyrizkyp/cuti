<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;
use App\Models\Pegawai;
use App\Models\Cuti;
use App\Models\Pyb;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BerandaController extends Controller
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
        $client = new Client();
        $uker = Session::get('kode_pd');
        $url = "http://10.90.150.3:5001/api/uker/". $uker;
        $response = $client->request('GET', $url, [
            'verify'  => false,
        ]);
        $data = json_decode($response->getBody());
        $uker = collect($data)->first();
        $cuti = Cuti::where('nip', session('nip'))->get();;
        $t_pengajuan = $cuti->where('status' , 'pengajuan')->where('tahun', Carbon::now()->year)->count();
        $t_setujui = $cuti->where('status' , 'disetujui')->where('tahun', Carbon::now()->year)->count();
        $t_ditolak = $cuti->where('status' , 'ditolak')->where('tahun', Carbon::now()->year)->count();
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
        $pyb = Pyb::all();
        return view('pegawai.beranda.index', [
            'title' => 'Beranda',         
            'data_uker' => $uker,   
            'cuti' => $cuti,   
            'sisa_cuti' => $sisa_cuti,   
            'tahun_s' => $tahun_s,   
            'pyb' => $pyb,
            't_pengajuan' => $t_pengajuan,
            't_setujui' => $t_setujui,
            't_ditolak' => $t_ditolak,
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
