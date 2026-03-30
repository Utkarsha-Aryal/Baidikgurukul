@extends('frontend.layouts.main')

@section('title', 'Gurukul')

@section('content')
<section class="page-hero">
  <div class="container page-hero__inner">
    <h1>Home</h1>
    <p>{{$sitesetting->hmaepage_description}}</p>
  </div>
</section>

<main class="container home-grid">
  <!-- LEFT: Main content -->
  <div class="stack">

    <!-- Slider -->
    <section class="card slider" data-slider data-autoplay="true" data-interval="5000" aria-label="Homepage photo slider">
      <div class="slider__viewport">
        @forelse($sliderItems as $slide)
          <div class="slide">
            <img src="{{ asset('storage/gallery-image/' . $slide->image) }}" alt="{{ $slide->name }}" />
            <div class="slide__content">
              <span class="badge">Gallery</span>
              <h2>{{ $slide->name }}</h2>
              <p>Explore moments from our latest activities.</p>
            </div>
          </div>
        @empty
          <div class="slide">
            <img src="{{ asset('images/gurukul.jpg') }}" alt="Institute campus or temple" />
            <div class="slide__content">
              <span class="badge">Announcement</span>
              <h2>Welcome to Gurukul</h2>
              <p>Discover our programs, news, events and committee updates.</p>
            </div>
          </div>
        @endforelse
      </div>

      <div class="slider__controls" aria-hidden="false">
        <button class="slider__btn prev" type="button" data-prev aria-label="Previous slide">‹</button>
        <button class="slider__btn next" type="button" data-next aria-label="Next slide">›</button>
      </div>

      <div class="dots" aria-label="Slide dots"></div>
    </section>

    <!-- Committee -->
   <!-- Committee -->
<section class="card">
  <div class="card__head">
    <div>
      <h2 class="card__title">Committee</h2>
      <p class="card__sub">Leadership & management committee members</p>
    </div>
    <a class="btn btn--dark" href="{{ route('members') }}">All Members</a>
  </div>

  <div class="card__body">
    <div class="people">

      @forelse($teamMembers as $member)
        <article class="card person">
          
          <img 
            src="{{ $member->photo ? asset('storage/community/' . $member->photo) : asset('assets/img/default.jpg') }}" 
            alt="{{ $member->name }} photo" 
          />

          <div class="meta">
            <p class="name">{{ $member->name }}</p>
            <p class="role">{{ $member->designation }}</p>
          </div>

        </article>
      @empty
        <p>No committee members available.</p>
      @endforelse

    </div>
  </div>
</section>

    <!-- News + Events (two columns) -->
    <section class="split">
      <section class="card">
        <div class="card__head">
          <div>
            <h2 class="card__title">News</h2>
            <p class="card__sub">Latest updates and highlights</p>
          </div>
          <a class="btn" href="{{ route('news') }}">View All</a>
        </div>

        <div class="card__body">
          <div class="list">
            @forelse($news as $item)
              <a class="list-item" href="{{ route('news.inner.page', $item->slug) }}">
                <div class="date">
                  {{ \Carbon\Carbon::parse($item->event_date)->format('d M Y') }}
                </div>

                <div>
                  <p class="title">{{ $item->title }}</p>
                  <p class="desc">
                    {{ \Illuminate\Support\Str::limit(strip_tags($item->details), 80) }}
                  </p>
                </div>
              </a>
            @empty
              <p>No news available.</p>
            @endforelse
          </div>
        </div>
      </section>

      <section class="card">
        <div class="card__head">
          <div>
            <h2 class="card__title">Events</h2>
            <p class="card__sub">Upcoming activities and programs</p>
          </div>
          <a class="btn" href="{{ route('events') }}">View All</a>
        </div>

        <div class="card__body">
          <div class="list">
            @forelse($events as $event)
              <a class="list-item" href="{{ route('event.inner.page', $event->slug) }}">
                <div class="date">
                  {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('d M Y') : '' }}
                </div>

                <div>
                  <p class="title">{{ $event->title }}</p>

                  <p class="desc">
                    {{ \Illuminate\Support\Str::limit(strip_tags($event->details), 80) }}
                  </p>

                  <p class="desc" style="opacity:.8;">
                    @if($event->venue) {{ $event->venue }} @endif
                    @if($event->event_time_start)
                      @if($event->venue) • @endif
                      {{ $event->event_time_start }}
                      @if($event->event_time_end) - {{ $event->event_time_end }} @endif
                    @endif
                    @if($event->address)
                      @if($event->venue || $event->event_time_start) • @endif
                      {{ $event->address }}
                    @endif
                  </p>
                </div>
              </a>
            @empty
              <p>No upcoming events.</p>
            @endforelse
          </div>
        </div>
      </section>
    </section>
  </div>

  <!-- RIGHT: Sidebar -->
  <aside class="sidebar stack">

    <section class="card">
      <div class="card__head">
        <div>
          <h2 class="card__title">Quick Access</h2>
          <p class="card__sub">Go directly to galleries & notices</p>
        </div>
      </div>
      <div class="card__body quick">
        <a class="quick-link" href="{{ route('video') }}">
          <span>Video Gallery</span>
          <small>→</small>
        </a>
        <a class="quick-link" href="{{ route('gallery') }}">
          <span>Photo Gallery</span>
          <small>→</small>
        </a>
        <a class="quick-link" href="{{ route('notices.index') }}">
          <span>Notices</span>
          <small>→</small>
        </a>
      </div>
    </section>

    <section class="card">
      <div class="card__head">
        <div>
          <h2 class="card__title">Latest Photos</h2>
          <p class="card__sub">Preview</p>
        </div>
      </div>
      <div class="card__body">
        <div class="thumb-grid">
          @forelse($galleries as $gallery)
            <a class="thumb" href="{{ route('image.inner', $gallery->slug) }}">
              <img
                src="{{ $gallery->image ? asset('storage/gallery-image/' . $gallery->image) : asset('assets/img/default.jpg') }}"
                alt="{{ $gallery->name }}"
              />
            </a>
          @empty
            <p>No gallery available.</p>
          @endforelse
        </div>
      </div>
    </section>
  </aside>
</main>
@endsection

@push('scripts')
  <script src="{{ asset('frontpanel/assets2/assets/js/slider.js') }}"></script>
@endpush
