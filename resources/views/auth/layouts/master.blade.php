<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Админка: @yield('title')</title>

  <!-- Scripts -->
  <script src="/js/app.js" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

  <!-- Styles -->
  <link href="/css/app.css" rel="stylesheet">
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/admin.css" rel="stylesheet">
  <link href="/css/starter-template.css" rel="stylesheet">
</head>

<body>
  <div id="app">
    <nav class="navbar navbar-default navbar-expand-md navbar-light navbar-laravel">
      <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}">
          Вернуться на сайт
        </a>

        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
          </ul>
          <ul class="nav navbar-nav navbar-left">
            @admin
            <li class="nav-item">
              <a class="nav-link" href="{{ route('orders') }}">Заказы</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('categories.index') }}">Категории</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('products.index') }}">Товары</a>
            </li>
            @else
            <li class="nav-item">
              <a class="nav-link" href="{{ route('person.orders') }}">Заказы</a>
            </li>
            @endadmin
          </ul>
          <ul class="nav navbar-nav navbar-right">
            @guest
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">Войти</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{  route('register') }}">Зарегистрироваться</a>
            </li>
            @endguest
            @admin
            <li class="nav-item">
              <a class="nav-link" href="{{ route('orders') }}">Администратор</a>
            </li>
            @endadmin
            @auth
               <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}">Выйти</a>
              </li> 
            @endauth
            
          </ul>

        </div>
      </div>
    </nav>
    <div class="py-4">
      <div class="container">
        <div class="row justify-content-center">
          @yield('content')
        </div>
      </div>
    </div>
  </div>
</body>

</html>