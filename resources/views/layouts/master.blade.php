<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title', 'Главная страница')</title>

  <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/starter-template.css" rel="stylesheet">
</head>

<body cz-shortcut-listen="true">
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="{{route('index')}}">Интернет Магазин</a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li class="@routeactive('index')"><a href="{{route('index')}}">Все товары</a></li>
          <li class="@routeactive('categor*')"><a href="{{route('categories')}}">Категории</a>
          </li>
          <li class="@routeactive('basket')"><a href="{{route('basket')}}">Корзина</a></li>
          <li><a href="/">en</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          @guest
          <li><a href="{{ route('login') }}">Войти</a></li>
          <li>
            <a class="nav-link" href="{{  route('register') }}">Зарегистрироваться</a>
          </li>
          @endguest
          @auth
          @admin
            <li><a href="{{ route('orders') }}">Администратор</a></li>  
          @else
            <li><a href="{{ route('person.orders') }}">Мои заказы</a></li>
          @endadmin
          <li><a href="{{ route('logout') }}">Выйти</a></li>
          @endauth

        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="starter-template">
      @if (session()->has('success'))
      <p class="alert alert-success">{{ session()->get('success') }}</p>
      @endif
      @if (session()->has('warning'))
      <p class="alert alert-warning">{{ session()->get('warning') }}</p>
      @endif
      @yield('content')
    </div>
  </div>


</body>

</html>