<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Login;
use App\Models\Superadmin;
use App\Models\Admin;
use App\Models\Kassubag;
use App\Models\Pegawai;
use App\Models\User;
use GuzzleHttp\Client;
use App\Models\Golongan;
use GuzzleHttp\Exception\RequestException;

class AuthController extends Controller
{
    public function login()
    {
        return view('login.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $login = Login::where([
            'username' => strip_tags($request->username),
            'password' => strip_tags(sha1($request->password))
        ])->first();                 
        
        if($login){
            if($login->role == 'admin'){
                $admin = Admin::where('username', strip_tags($request->username))->first();                                
                $sessdata['loggedAdmin'] = 'yes';
                $sessdata['nama'] = $admin->nama;
                $sessdata['nip'] = $admin->nip;                
                $sessdata['email'] = $admin->email;                       
                $request->session()->put($sessdata);
                return redirect('/admin');
                
            }else if($login->role == 'superadmin'){
                $super = Superadmin::where('username', strip_tags($request->username))->first();
                $sessdata['loggedSuperadmin'] = 'yes';
                $sessdata['nama'] = $super->nama;
                $sessdata['nip'] = $super->nip;
                $sessdata['email'] = $super->email;                
                $request->session()->put($sessdata);
    
                return redirect('/superadmin');
            }else {
                return back()->with('fail', 'Username atau Password salah!');
            }
        }else{
            
            $user = User::where([
                'nip' => strip_tags($request->username),
                'password' => strip_tags(sha1($request->password))
            ])->first();
            
            if($user){
                $sessdata['loggedUser'] = 'yes';
                $sessdata['nama'] = $user->nama;                
                $sessdata['nip'] = $user->nip;                
                $sessdata['pangkat'] = $user->pangkat;
                $sessdata['jabatan'] = $user->jabatan;
                $sessdata['jenis_jbt'] = $user->jenis_jbt;
                $sessdata['unker'] = $user->unker;
                $sessdata['unor'] = $user->unor;
                $sessdata['kode_pd'] = $user->kode_pd;
                $request->session()->put($sessdata);
                return redirect('/user');
            }else{
                $client = new Client();
                $url = "http://10.90.150.3:5001/api/users/". strip_tags($request->username);                    	

                $response = $client->request('GET', $url, [
                    'verify'  => false,
                ]);
                $password = json_decode($response->getBody());
                if ($request->password == $password[0]){
                    $pegawai = "http://10.90.150.3:5001/api/pegawai/". strip_tags($request->username);
                    $data = $client->request('GET', $pegawai, [
                    'verify'  => false,
                    ]);
                    $data_pegawai = json_decode($data->getBody());   

                    $tbpd = "http://10.90.150.3:5001/api/tbpd/". $data_pegawai[0]->kode_pd;
                    $tbpds = $client->request('GET', $tbpd, [
                    'verify'  => false,
                    ]);
                    $data_tbpd = json_decode($tbpds->getBody());   
                    $sessdata['loggedUser'] = 'yes';
                    $sessdata['nama'] = $data_pegawai[0]->nama;                
                    $sessdata['nip'] = $data_pegawai[0]->nip;                
                    $sessdata['pangkat'] = $data_pegawai[0]->pangkat;
                    $sessdata['jabatan'] = $data_pegawai[0]->jabatan;
                    $sessdata['jenis_jbt'] = $data_pegawai[0]->jenis_jbt;
                    $sessdata['unker'] = $data_pegawai[0]->unit_kerja;
                    $sessdata['unor'] = $data_pegawai[0]->unit_organisasi;
                    $sessdata['kode_pd'] = $data_pegawai[0]->kode_pd;
                    $sessdata['nama_pd'] = $data_tbpd[0]->nama_pd;
                    $sessdata['password'] = strip_tags(sha1($password[0]));
                    $request->session()->put($sessdata);

                    $user = User::where('nip', $sessdata['nip'])->first();
                    if($user){
                        return redirect('/user');
                    }else{
                        User::create($sessdata);
                        return redirect('/user');
                    }
                    
                }else{
                    return back()->with('fail', 'Username atau Password salah!');
                }
            }
        }
        
        

            
            
        
    }

    public function signout()
    {
        Session::flush();
        Session::regenerate();
        return redirect('/');      
    }

}


