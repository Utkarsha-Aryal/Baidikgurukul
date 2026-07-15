<header class="site-header">
  <div class="site-header__utility">
    <div class="container site-header__utility-inner">
      <span>वैदिक शिक्षा, संस्कार र सनातन परम्परा</span>
      <div class="site-header__contact">
        @if(!empty($siteSetting?->email))<a href="mailto:{{ $siteSetting->email }}">{{ $siteSetting->email }}</a>@endif
        @if(!empty($siteSetting?->phone_number))<a href="tel:{{ $siteSetting->phone_number }}">{{ $siteSetting->phone_number }}</a>@endif
      </div>
    </div>
  </div>
  <div class="container site-header__main">
    <a class="site-brand" href="{{ route('home') }}" aria-label="परमानन्द वैदिक गुरुकुल गृहपृष्ठ">
      <img src="{{ asset('frontpanel/figma-home/nepal-emblem.svg') }}" alt="">
      <span><strong>परमानन्द वैदिक गुरुकुल</strong><small>धर्म, संस्कार र संस्कृतिको संरक्षण</small></span>
    </a>
    <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-nav" aria-label="मेनु खोल्नुहोस्"><span></span><span></span><span></span></button>
    <nav id="primary-nav" class="nav" aria-label="मुख्य नेभिगेसन">
      <a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">गृहपृष्ठ</a>
      <a class="{{ request()->routeIs('about', 'history*', 'rules*') ? 'active' : '' }}" href="{{ route('about') }}">हाम्रो बारेमा</a>
      <a class="{{ request()->routeIs('members', 'ourteam', 'teaminner', 'teamyear') ? 'active' : '' }}" href="{{ route('members') }}">हाम्रो समूह</a>
      <a class="{{ request()->routeIs('program*') ? 'active' : '' }}" href="{{ route('program') }}">कार्यक्रम</a>
      <a class="{{ request()->routeIs('gallery*', 'ginner') ? 'active' : '' }}" href="{{ route('gallery') }}">ग्यालरी</a>
      <a class="{{ request()->routeIs('events', 'event.*') ? 'active' : '' }}" href="{{ route('events') }}">कार्यक्रमहरू</a>
      <a class="{{ request()->routeIs('news*') ? 'active' : '' }}" href="{{ route('news') }}">समाचार</a>
      <a class="nav__cta {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">सम्पर्क</a>
    </nav>
  </div>
</header>
