<?php

namespace App\Http\Controllers;

use App\Models\Berkaskariskarsu;
use App\Models\Berkaspensiun;
use App\Models\Pegawai;
use App\Models\Pensiun;
use App\Models\Usulan;
use App\Models\Usulankartu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class PermohonanController extends Controller
{
    public function __construct()
    {      
        if (empty(Session::get('loggedUser'))) {
            Session::flush();
            Session::regenerate();
            redirect('/signout');
        }
    }

    public function viewpengajuanpensiun()
    {
        $usulan = Usulan::join('pensiuns', 'usulans.nip', '=', 'pensiuns.nip')->join('pegawais', 'usulans.nip', '=', 'pegawais.nip')->where('usulans.nip', session('nip'))->first();        

        $berkas = Berkaspensiun::where('nip', session('nip'))->first();

        $data = [
            'title' => 'Pengajuan Pensiun',
            'usulan' => $usulan,
            'berkas'  => $berkas
        ];
        return view('pegawai.permohonan.pensiun.viewpermohonan', $data);
    }

    public function pensiun($id)
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
                'title' => 'Pengajuan Pensiun',
                'pegawai' => $pegawai,
                'pensiun' => $pensiun,
                'berkas'  => $berkas
            ];
            return view('pegawai.permohonan.pensiun.permohonan', $data);
        }elseif($berkas){
    
            $data = [
                'title' => 'Pengajuan Pensiun',
                'pegawai' => $pegawai,
                'pensiun' => $pensiun,
                'berkas'  => $berkas
            ];
            return view('pegawai.permohonan.pensiun.permohonan', $data);
            
        }        
    }

    function insertdokumen(Request $request)
    {        
        if($request->file){

            $kategori = $request->kategori;

            $file = Str::random(30).'.'.$request->file->extension();         
            $request->file->move(public_path('dokumenpensiun'), $file);
            $filePath = 'dokumenpensiun/' . $file;
    
            $data = [                
                $kategori  => $filePath
            ];         

            Berkaspensiun::where('nip', session('nip'))->update($data);

            return redirect()->back()->with('success', 'Dokumen Berhasil Diupload');
        }  
    }

    function konfirmasiberkas()
    {                        
        $data = [                
            'status'  => 'S'
        ];         

        Berkaspensiun::where('nip', session('nip'))->update($data);

        return redirect('/viewpengajuanpensiun')->with('success','Dokumen Berhasil Diajukan');
    }
    
    public function viewpengajuankaris()
    {
        $usulan = Usulankartu::join('pegawais', 'usulankartus.nip', '=', 'pegawais.nip')->where('usulankartus.nip', session('nip'))->first();            

        $berkas = Berkaskariskarsu::where('nip', session('nip'))->first();        


        $data = [
            'title' => 'Pengajuan Karis Karsu',
            'usulan' => $usulan,
            'berkas'  => $berkas
        ];
        return view('pegawai.permohonan.kariskarsu.viewpermohonan', $data);
    }

    

    public function kariskarsu($id)
    {
        $pegawai = Pegawai::join('opds', 'pegawais.kode_pd', '=', 'opds.kode_pd')->where('pegawais.id', session('id_pegawai'))->first();
        $berkas = Berkaskariskarsu::where('nip', $id)->first();

        if(!$berkas){
            $insert = [                                  
                'nip'     => $pegawai->nip,
                'status'     => 'B'
            ];
    
            Berkaskariskarsu::create($insert);
    
            $data = [
                'title' => 'Pengajuan Karis Karsu',
                'pegawai' => $pegawai,                
                'berkas'  => $berkas
            ];
            return view('pegawai.permohonan.kariskarsu.permohonan', $data);
        }elseif($berkas){
    
            $data = [
                'title' => 'Pengajuan Karis Karsu',
                'pegawai' => $pegawai,                
                'berkas'  => $berkas
            ];
            return view('pegawai.permohonan.kariskarsu.permohonan', $data);
            
        }        
    }

    function insertdoc(Request $request)
    {        
        if($request->file){

            $kategori = $request->kategori;

            $file = Str::random(30).'.'.$request->file->extension();         
            $request->file->move(public_path('dokumenkariskarsu'), $file);
            $filePath = 'dokumenkariskarsu/' . $file;
    
            $data = [                
                $kategori  => $filePath
            ];         

            Berkaskariskarsu::where('nip', session('nip'))->update($data);

            return redirect()->back()->with('success', 'Dokumen Berhasil Diupload');
        }  
    }

    function konfirmasikaris()
    {                        
        $data = [                
            'status'  => 'S'
        ];         

        Berkaskariskarsu::where('nip', session('nip'))->update($data);

        return redirect('/viewpengajuankaris')->with('success','Dokumen Berhasil Diajukan');
    }
}
