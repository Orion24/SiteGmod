<?php
/**
 * Nom : Bertrand Nicolas
 * Nom du fichier : UserController.php
 * Description : Controlleur des utilisateurs
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Hash;

class UserController extends Controller
{
/**
 * Affiche la forme utilisateur
 * @return View la vue d'édition de l'utilisateur
 */
    public function showForm()
    {
        return view('edit-user');
    }

/**
 * Traite le formulaire de modification du mot de passe
 * @param  Request $req Formulaire de modification
 * @return View       Page de login avec l'utilisateur déconnecté
 */
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
