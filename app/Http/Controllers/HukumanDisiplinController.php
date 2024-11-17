<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HukumanDisiplinController extends Controller
{
   public function __construct()
   {
      // $user = User::where('id', session('loggedUser'))->first();
      // if(!$user){            
      //    $this->logout();
      // }
   }

   public function index()
   {
      return view('admin.hukumandisiplin.index', [
         'title' => 'Data Hukuman Disiplin Ringan'
      ]);
   }

   
}
