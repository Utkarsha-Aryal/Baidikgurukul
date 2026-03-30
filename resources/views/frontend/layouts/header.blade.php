<header class="header">
  <div class="container header__inner">
    <a class="brand" href="{{ url('/') }}">
      <div class="brand__logo">ॐ</div>
      <div class="brand__text">
        <div class="brand__name">परमान्द बैदिक सस्कृत  गुरुकुल</div>
        <div class="brand__tag">संस्कार संस्कृति र संस्कृतको संरक्षण तथा संवर्धनमा कटिबद्ध परमानन्द_संस्कृत_गुरुकुलम् देवघाटधाम नेपाल
</div>
      </div>
    </a>

    <button class="nav-toggle" aria-expanded="false" aria-controls="primary-nav">☰</button>

    <nav id="primary-nav" class="nav">
      <a class="{{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
      <a class="{{ request()->is('members') ? 'active' : '' }}" href="{{ url('/members') }}">Members</a>
      <a class="{{ request()->is('gallery') ? 'active' : '' }}" href="{{ url('/gallery') }}">Photo Gallery</a>
      <a class="{{ request()->is('video') ? 'active' : '' }}" href="{{ url('/video') }}">Video Gallery</a>
      <a class="{{ request()->is('events*') ? 'active' : '' }}" href="{{ url('/events') }}">Events</a>
      <a class="{{ request()->is('news*') ? 'active' : '' }}" href="{{ url('/news') }}">News</a>
      <a class="nav__cta {{ request()->is('notices*') ? 'active' : '' }}" href="{{ url('/notices') }}">Notices</a>
    </nav>
  </div>
</header>
