{{--
  Nom : Bertrand Nicolas
  Nom du fichier : edit-actuality.blade.php
  Description : Vue de modification d'une actualité
--}}
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
              @if(Auth::check() && Auth::user()->is_admin)
                <div class="panel-heading">Modifier une actualité</div>
                <div class="panel-body">
                  <form action="{{ url('actuality/edit') }}" method="post">
                    <label for="disabledTextInput">Titre de l'article</label>
                      <input type="text" class="form-control" size="35" name="articleTitle" placeholder="Titre de l'article" required><br/>
                      <textarea class="form-control" name="content" placeholder="Contenu" required></textarea>
                      <br />
                      <button type="submit" class="btn btn-primary">
                          <i class="fa fa-btn fa-user"></i>Poster
                      </button>
                  <form>
                  {!! csrf_field() !!}
                </div>
              @endif
            </div>
        </div>
    </div>
</div>
@endsection
