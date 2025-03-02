<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Biblioteca')</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f4f9;
      color: #333;
    }
    .navbar {
      background-color: #343a40;
      border-radius: 0;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .navbar .navbar-brand {
      color: #fff !important;
      font-weight: 600;
    }
    .navbar-nav li a {
      color: #ddd !important;
      font-weight: 500;
    }
    .navbar-nav li a:hover {
      background-color: #007bff !important;
      color: #fff !important;
    }
    .navbar-nav .dropdown-menu {
      background-color: #343a40;
      border-radius: 0;
    }
    .navbar-nav .dropdown-menu li a {
      color: #ddd !important;
    }
    .navbar-nav .dropdown-menu li a:hover {
      background-color: #007bff !important;
      color: #fff !important;
    }
    .container {
      margin-top: 30px;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    h1, h2 {
      color: #333;
      font-weight: 600;
    }
    .dropdown-toggle::after {
      content: ' ▼';
    }
    .navbar-nav .dropdown-toggle::after {
      color: #ddd;
    }
    .dropdown-toggle:hover {
      color: #fff;
    }
    .welcome-message {
      background-color: #007bff;
      color: white;
      padding: 20px;
      border-radius: 8px;
      text-align: center;
      margin-bottom: 30px;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="{{ url('/') }}">Biblioteca</a>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              <span class="glyphicon glyphicon-user"></span> Usuários <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{{ route('users.create') }}">Criar Usuário</a></li>
              <li><a href="{{ route('users.index') }}">Ver Usuários</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              <span class="glyphicon glyphicon-book"></span> Livros <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{{ route('livros.create') }}">Incluir Livros</a></li>
              <li><a href="{{ route('livros.index') }}">Ver Livros</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              <span class="glyphicon glyphicon-retweet"></span> Empréstimo <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{{ route('emprestimos.create') }}">Incluir empréstimo</a></li>
              <li><a href="{{ route('emprestimos.index') }}">Ver empréstimos</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="welcome-message">
      <h2>Bem-vindo à Biblioteca!</h2>
      <p>Explore nosso catálogo de livros, gerencie usuários e empréstimos.</p>
    </div>
    @yield('content')
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
