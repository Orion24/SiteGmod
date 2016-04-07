<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Actuality;

class ActualityController extends Controller
{
  public function show()
  {
      $actualities = Actuality::distinct()->get();
      return view ('actuality',compact('actualities'));
  }

  public function showFormModify($id)
  {
      $actuality = Actuality::find($id);
      $actualities = Actuality::distinct()->get();
      return view ('actuality',compact('actuality'));
  }

  public function create(Request $req)
  {
    $this->validate($req, [
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

  public function delete($id)
  {
      $actuality = Actuality::find($id);

      $actuality->delete();

      return redirect('actuality');
  }

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
