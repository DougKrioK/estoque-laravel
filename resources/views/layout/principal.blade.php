<html>
<head>
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">
    <title>Controle de estoque</title>
</head>
<body>
  <div class="container">

  <nav class="navbar navbar-default">
    <div class="container-fluid">

    <div class="navbar-header">      
      <a class="navbar-brand" href="{{action('ProdutoController@novo')}}">Estoque Laravel</a>
    </div>

      <ul class="nav navbar-nav navbar-right">
        @if (Auth::guest())
          <li><a href="/auth/login">Login</a></li>
          <li><a href="/auth/register">Register</a></li>
        @else
          
          <li>
            <a href="{{ route('logout') }}" 
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
          </li>
          
        @endif
        <li><a href="{{action('ProdutoController@lista')}}">Listagem</a></li>
        <li><a href="{{action('ProdutoController@novo')}}">Novo</a></li>
      </ul>

    </div>
  </nav>

    @yield('conteudo')

  <footer class="footer">
      <p>© Livro de Laravel do Alura.</p>
  </footer>

  </div>
</body>
</html>