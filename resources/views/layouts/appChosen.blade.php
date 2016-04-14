<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Site Gmod Dark RP</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>


    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    {!!Html::style('css/chosen.min.css')!!}


    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Serveur Gmod Dark RP
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @if(Auth::check())
                    <li class="{{ Request::is('home') ? 'active': '' }}"><a href="{{ url('/home') }}">Home</a></li>
                    @endif
					          <li class="{{ Request::is('actuality') ? 'active': '' }}"><a href="{{ url('/actuality') }}">Actualité</a></li>
                    @if(Auth::check() && Auth::user()->is_admin)
                      <li class="{{ Request::is('admin') ? 'active': '' }}"><a href="{{ url('/admin') }}">Adminitration</a></li>
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} {{ Auth::user()->is_admin ? '(Administrateur)' : '' }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>

                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {!! Html::script('js/chosen.jquery.min.js')!!}
    <script type="text/javascript">
          $(".chzn-select").chosen({
            placeholder_text_single: "Sélection d'un utilisateur",
            no_results_text: "Utilisateur introuvable"
          });
          $(".chzn-select").chosen().change(function() {
            var idUser = $(this).val();
            var users = [
            @foreach ($users as $user)
                [ "{{ $user->id }}", "{{ $user->name }}", "{{ $user->is_admin }}" ],
            @endforeach
            ];
            var div = document.getElementById('info');
            for (index = 0; index < users.length; index++)
            {
                if(users[index][0] == idUser)
                {
                    var content = '<p style="font-size : 15pt;"><strong>Nom : </strong>' + users[index][1] + '</p>';
                    content += '<form action="{{ url('admin') }}" method="post">';
                    if(users[index][2] == 1)
                    {
                      content += '<label style="font-size : 15pt;">Est administrateur : </label> <input type="checkbox" name="isAdmin" value="1" checked><br/>';
                    }
                    else {
                       content += '<label style="font-size : 15pt;">Est administrateur : </label> <input type="checkbox" value="1" name="isAdmin"><br/>';
                    }
                    content += '<input type="hidden" value="' + users[index][0] + '" name="id">';
                    content += '<button type="submit" class="btn btn-primary"><i class="fa fa-btn fa-user"></i>Modifier</button>';
                    content += '{!! csrf_field() !!}</form>';
                    div.innerHTML = content;
                }
            }
          });
    </script>

    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
