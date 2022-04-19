<nav id="navbar" class="navbar">
    <ul>
      <li><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a></li>
      <li><a class="nav-link {{ request()->is('blog*') ? 'active' : '' }}" href="{{route('blog.index')}}">Blog</a></li>
      <li><a class="nav-link {{ request()->is('notice*') ? 'active' : '' }}" href="{{route('notice.index')}}">Notice</a></li>
      <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
    </ul>
    <i class="bi bi-list mobile-nav-toggle"></i>
  </nav><!-- .navbar -->