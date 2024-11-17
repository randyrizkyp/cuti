<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Models\Pegawai;
use GuzzleHttp\Client;

class CutiController extends Controller
{
    public function __construct()
    {      
        if (empty(Session::get('loggedUser'))) {
            Session::flush();
            Session::regenerate();
            redirect('/signout');
        }
    }

    public function cuti()
    {
        $pegawai = Pegawai::join('opds', 'pegawais.kode_pd', '=', 'opds.kode_pd')->where('pegawais.id', session('id_pegawai'))->first();
        $client = new Client();
        $uker = Session::get('kode_pd');
        $url = "http://10.90.150.3:5001/api/uker/". $uker;
        $response = $client->request('GET', $url, [
            'verify'  => false,
        ]);
        $data = json_decode($response->getBody());
        $uker = collect($data)->first();
        $data = [
            'title' => 'Cuti Pegawai',
            'pegawai' => $pegawai,
            'data_uker' => $uker,   

        ];
    
        return view('pegawai.cuti.index', $data);

    }
}
