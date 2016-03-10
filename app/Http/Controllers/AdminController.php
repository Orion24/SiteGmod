<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Actuality;
use App\User;

use DB;
use Redirect;

class AdminController extends Controller
{
  public function show()
  {
      $actualities = Actuality::distinct()->get();
      $users = DB::select('select id, name, email, is_admin from users');
      return view ('admin', ['actualities' => $actualities, 'users' => $users]);
  }

  public function processForm(Request $req)
  {
      $user = User::findOrFail($req->input('id'));
      $user->is_Admin = $req->has('isAdmin');
      $user->save();

      return Redirect::back();
  }
}
