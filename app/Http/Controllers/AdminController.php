<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Actuality;
use App\User;

class AdminController extends Controller
{
  public function show()
  {
      $actualities = Actuality::distinct()->get();
      $users = User::all();
      return view ('admin', ['actualities' => $actualities, 'users' => $users]);
  }
}
