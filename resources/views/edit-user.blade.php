@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Modification</div>

                <div class="panel-body">
                    @include('shared.errors')

                    <p> Nom : {{ Auth::user()->name }} </p>
                    <p> email : {{ Auth::user()->email }} </p>
                    <form action="{{ url('home/edit') }}" method="post">
                        <input type="password" name="new_password"></input><br/>
                        <input type="password" name="confirm_password"></input><br/>

                        <br />
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-user"></i>Modifier
                        </button>
                    <form>
                    {!! csrf_field() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
