<header class="header">
  <div class="container header__inner">
    <a class="brand" href="{{ url('/') }}">
      <div class="brand__logo">ॐ</div>
      <div class="brand__text">
        <div class="brand__name">B</div>
        <div class="brand__tag">Discipline • Study • Service</div>
      </div>
    </a>

    <button class="nav-toggle" aria-expanded="false" aria-controls="primary-nav">☰</button>

    <nav id="primary-nav" class="nav">
      <a class="{{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
      <a class="{{ request()->is('members*') ? 'active' : '' }}" href="{{ url('/members') }}">Members</a>
      <a class="{{ request()->is('gallery/photos') ? 'active' : '' }}" href="{{ url('/gallery/photos') }}">Photo Gallery</a>
      <a class="{{ request()->is('gallery/videos') ? 'active' : '' }}" href="{{ url('/gallery/videos') }}">Video Gallery</a>
      <a class="{{ request()->is('events*') ? 'active' : '' }}" href="{{ url('/events') }}">Events</a>
      <a class="{{ request()->is('news*') ? 'active' : '' }}" href="{{ url('/news') }}">News</a>
      <a class="nav__cta {{ request()->is('notices*') ? 'active' : '' }}" href="{{ url('/notices') }}">Notices</a>
    </nav>
  </div>
</header>
