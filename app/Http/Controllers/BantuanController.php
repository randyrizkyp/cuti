<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BantuanController extends Controller
{   
   public function user()
   {
      return view('pegawai.bantuan.index', [
         'title' => 'Bantuan'
      ]);
   }

}
