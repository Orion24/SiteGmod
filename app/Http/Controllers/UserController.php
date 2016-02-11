<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Hash;

class UserController extends Controller
{
    public function showForm()
    {
        return view('edit-user');
    }

    public function processForm(Request $req)
    {
        $this->validate($req, [
          'new_password' => 'required|min:6',
          'confirm_password' => 'required|same:new_password'
        ]);

        $newPassword = Hash::make($req->input('new_password'));

        $user = Auth::user();
        $user->password = $newPassword;
        $user->save();

        Auth::logout();

        return view('auth.login')->withErrors('Votre mot de passe a été changé.');
    }
}
