<style>
.navlink {
border-bottom: red 2px solid;
color: #111;
}
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-white">
  <a class="navbar-brand" href="/"> 
    <img src="img/logo.png" alt="Logo" style="width:40px;">
    <span>{{ trans('panel.site_title') }}</span>
  </a>
  
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
  
    <ul class="navbar-nav ml-auto">
      <li class="nav-item ">
        <a class="nav-link font-weight-bold {{ request()->is('home') || request()->is('home/*') ? 'navlink' : '' }}" href="/">Home </a>
      </li>
      <li class="nav-item">
        <a class="nav-link font-weight-bold {{ request()->is('contact') || request()->is('contact/*') ? 'navlink' : '' }}" href="/contact">Contact Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link font-weight-bold {{ request()->is('about') || request()->is('about/*') ? 'navlink' : '' }}" href="/about">About Us</a>
      </li>
      @if (Auth::user())
        <li class="nav-item font-weight-bold"><a class="nav-link js-scroll-trigger" href="/admin/today">Dashboard</a></li>
          <li class="nav-item font-weight-bold"><a class="nav-link js-scroll-trigger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>                  
    @else
      <li class="nav-item">
         <a href="{{ route("login") }}" class="nav-link font-weight-bold {{ request()->is('login') || request()->is('login/*') ? 'navlink' : '' }}">Sign in</a>
      </li>
    @endif

      

    </ul>
    
  </div>
</nav>