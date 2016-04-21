<?php

/*
 * Nom : Bertrand Nicolas
 * Nom du fichier : ActualityController.php
 * Description : Controlleur des actualités
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Actuality;

class ActualityController extends Controller
{

/**
 * Récupère les actualités et les donne à la vue
 * @return View Retourne la vue avec toutes les actualités
 */
  public function show()
  {
      $actualities = Actuality::distinct()->get();
      return view ('actuality',compact('actualities'));
  }

/**
 * Affiche la forme à modifié
 * @param  int $id identifiant de l'actualité
 * @return View   Vue avec l'actualité demandé
 */
  public function showFormModify($id)
  {
      $actuality = Actuality::find($id);
      $actualities = Actuality::distinct()->get();
      return view ('actuality',compact('actuality'));
  }

/**
 * Créer une actualité
 * @param  Request $req la requête venant du formulaire
 * @return View       La vue précédente
 */
  public function create(Request $req)
  {
    $this->validate($req, [ //validation des champs envoyé
      'articleTitle' => 'required|max:35',
      'content' => 'required'
    ]);

    $userConnected = Auth::user();

    $actuality = new Actuality();
    $actuality->name = $req->input('articleTitle');
    $actuality->content = $req->input('content');
    $actuality->user_id = $userConnected->id;

    $actuality->save();

    return redirect('actuality');

  }

/**
 * Supprime l'actualité
 * @param  int $id l'identifiant de l'actualité
 * @return View     Vue avec toutes les actualités
 */
  public function delete($id)
  {
      $actuality = Actuality::find($id);

      $actuality->delete();

      return redirect('actuality');
  }

/**
 * Modifie une actualité
 * @param  Request $req Le formulaire avec les données à modifié
 * @return View     Vue avec toutes les actualités  
 */
  public function modify(Request $req)
  {
      $this->validate($req, [
        'articleTitle' => 'required|max:35',
        'content' => 'required',
        'id' => 'required'
      ]);

      $old_actuality = Actuality::find($req->input('id'));

      $old_actuality->name = $req->input('articleTitle');
      $old_actuality->content = $req->input('content');

      $old_actuality->save();

      return redirect('actuality');
  }
}
