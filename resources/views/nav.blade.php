<nav class="navbar navbar-expand navbar-dark purple-gradient">
  <a class="navbar-brand" href="{{ route('posts.index')}}">
    <i class="fas fa-camera-retro"></i> 
  </a>
  
  <ul class="navbar-nav ml-auto">
    @guest
    <li class="nav-item">
    <a class="nav-link" href="{{ route('register')}}">ユーザー登録</a>  
    </li>
    <li class="nav-item">
    <a class="nav-link" href="{{ route('login')}}">ログイン</a>  
    </li>
    @endguest
    @auth
    <li class="nav-item">
      <a class="nav-link" href="{{ route('posts.create')}}">投稿する</a>  
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
         aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user-circle"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
        <button class="dropdown-item" type="button"
      onclick="location.href='{{ route('users.show',[ Auth::id() , 'user_id'] )}}'">
          マイページ
        </button>
        <div class="dropdown-divider"></div>
        <button form="logout-button" class="dropdown-item" type="submit">
          ログアウト
        </button>
      </div>
    </li>
    
    <form method="POST" action="{{ route('logout')}}" id="logout-button">
    @csrf
  </form>
    @endauth
  </ul>   




</nav>