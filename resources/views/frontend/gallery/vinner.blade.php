@extends('frontend.layouts.main')
@section('title', 'ग्यालेरी भिडियोहरू')

@section('content')
<section class="page-hero">
  <div class="container page-hero__inner">
    <h1>{{ $gallery->title ?? 'भिडियोहरू (Videos)' }}</h1>
    <p>यस ग्यालेरीका सम्पूर्ण भिडियोहरू</p>
  </div>
</section>

<main class="container page-grid">
  <section class="card">
    <div class="card__head">
      <div>
        <h2 class="card__title">भिडियो संग्रह</h2>
        <p class="card__sub">Play videos below</p>
      </div>
      <a class="btn" href="{{ route('video') }}">पछाडि जानुहोस् (Back)</a>
    </div>

    <div class="card__body">
      @if(isset($videos) && count($videos) > 0)
        <div class="video-grid">
          @foreach($videos as $video)
            @php
              // Handle regular youtube links vs embed links
              $embedUrl = $video->video_url;
              if (str_contains($embedUrl, 'watch?v=')) {
                  $embedUrl = str_replace('watch?v=', 'embed/', $embedUrl);
              } elseif (str_contains($embedUrl, 'youtu.be/')) {
                  $embedUrl = str_replace('youtu.be/', 'youtube.com/embed/', $embedUrl);
              }
              // Strip short query params if needed
              if (str_contains($embedUrl, '&')) {
                  $embedUrl = explode('&', $embedUrl)[0];
              }
            @endphp
            
            <article class="video-item" style="background:#fff; border:1px solid var(--line); border-radius: var(--radius); padding:1rem; box-shadow: var(--shadow);">
              <iframe
                src="{{ $embedUrl }}"
                title="YouTube Video"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                style="border-radius:10px; width:100%; aspect-ratio:16/9; border:none;"
                allowfullscreen></iframe>
            </article>
          @endforeach
        </div>
      @else
        <div style="text-align:center; padding: 2rem;">
           <p style="color:var(--muted)">कुनै भिडियो भेटिएन। (No videos found).</p>
        </div>
      @endif
    </div>
  </section>
</main>
@endsection
