@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Informations</div>

                <div class="panel-body">
                    <p> Nom : {{ Auth::user()->name }} </p>
                    <p> email : {{ Auth::user()->email }} </p>
                    <button class="btn btn-primary" name="changerPwd" Onclick="window.location.href={{ url('home/edit/') }}">Modifier le mot de passe </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
