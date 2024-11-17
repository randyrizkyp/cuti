<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfilController extends Controller
{   
   public function profiluser()
   {
      return view('pegawai.profil.index', [
         'title' => 'Profil PNS'
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
