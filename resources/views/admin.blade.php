@extends('layouts.appChosen')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#actuality">Actualité</a></li>
                  <li><a data-toggle="tab" href="#user">Utilisateur</a></li>
                </ul>
                <div class="tab-content">
                  <div id="actuality" class="tab-pane fade in active">
                    @if(Auth::check() && Auth::user()->is_admin)
                      <div class="panel-heading">Ajouter une actualité</div>
                      <div class="panel-body">
                        <form action="{{ url('actuality/add') }}" method="post">
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

                    @foreach($actualities as $actuality)
                      <div class="panel-heading">{{$actuality->name }}</div>
                      <div class="panel-body">
                      {{$actuality->content}}
                      @if(Auth::check() && Auth::user()->is_admin)
                          <a href="{{ url('actuality/delete/'.$actuality->id.'') }}"><span class="glyphicon glyphicon-remove pull-right"></span></a>
                          <a href="{{ url('actuality/modify/'.$actuality->id.'') }}"><span class="glyphicon glyphicon-pencil pull-right"></span></a>
                      @endif
                      </div>
                    @endforeach
                  </div>
                  <div id="user" class="tab-pane fade">
                    <div class="col-md-6">
                    <select data-placeholder=" " class="chzn-select" tabindex="1">
                      <option> </option>
                      @foreach($users as $user)
                          <option value="{{ $user->id }}">{{ $user->name }}</option>
                      @endforeach
                    </select>
                    <hr>
                    <div id="info">
                    </div>
                  </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
