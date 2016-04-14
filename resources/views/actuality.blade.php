@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
              @if(Auth::check() && Auth::user()->is_admin)
                @if(!isset($actuality))
                  <div class="panel-heading">Ajouter une actualité</div>
                  <div class="panel-body">
                    <form action="{{ url('actuality/add') }}" method="post">
                      <label for="disabledTextInput">Titre de l'article</label>
                        <input type="text" class="form-control" size="35" name="articleTitle" placeholder="Titre de l'article" required><br/>
                        <textarea class="form-control" name="content" placeholder="Contenu" required></textarea>
                        <br />
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-user"></i>Poster
                        </button> <br />
                        @include('shared.errors')
                        {!! csrf_field() !!}
                    </form>

                    </div>
               @else
                 <div class="panel-heading">Modifier une actualité</div>
                 <div class="panel-body">
                   <form action="{{ url('actuality/modify') }}" method="post">
                     <label for="disabledTextInput">Titre de l'article</label>
                       <input type="text" class="form-control" size="35" name="articleTitle" placeholder="Titre de l'article" value="{{$actuality->name}}" required><br/>
                       <textarea class="form-control" name="content" placeholder="Contenu" required>{{$actuality->content}}</textarea>
                       <br />
                       <input type="hidden" value="{{$actuality->id}}" name="id">
                       <button type="submit" class="btn btn-primary">
                           <i class="fa fa-btn fa-user"></i>Modifier
                       </button><br />
                       @include('shared.errors')
                       {!! csrf_field() !!}
                   </form>

                 </div>
               @endif
              @endif
            </div>
            <br/>
            <h2> Articles </h2>
            <div class="panel panel-default">
              @if(!isset($actuality))
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
              @endif
            </div>
            </div>
        </div>
    </div>

</div>
@endsection
