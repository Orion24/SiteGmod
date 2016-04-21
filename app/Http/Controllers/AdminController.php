<?php
/**
 * Nom : Bertrand Nicolas
 * Nom du fichier : AdminController.php
 * Description : Controlleur d'administration
 */
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
/**
 * Affiche la vue d'administration avec les actualités
 * @return vue retourne la vue avec les actualités
 */
  public function show()
  {
      $actualities = Actuality::distinct()->get();
      $users = DB::select('select id, name, email, is_admin from users');
      return view ('admin', ['actualities' => $actualities, 'users' => $users]);
  }

/**
 * traite les informations venant du formulaire
 * @param  Request $req la requête du formulaire
 * @return View       revient à la page précédente
 */
  public function processForm(Request $req)
  {
      $user = User::findOrFail($req->input('id'));
      $user->is_Admin = $req->has('isAdmin');
      $user->save();

      return Redirect::back();
  }
}
