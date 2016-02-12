<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Actuality;

class AdminController extends Controller
{
  public function show()
  {
      $actualities = Actuality::distinct()->get();
      return view ('admin',compact('actualities'));
  }
}
