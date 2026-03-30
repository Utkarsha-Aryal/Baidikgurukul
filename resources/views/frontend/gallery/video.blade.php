@extends('frontend.layouts.main')
@section('title', 'भिडियो ग्यालेरी')

@section('content')
<section class="page-hero">
  <div class="container page-hero__inner">
    <h1>भिडियो ग्यालेरी (Video Gallery)</h1>
    <p>विभिन्न कार्यक्रम तथा गतिविधिहरूका भिडियोहरू</p>
  </div>
</section>

<main class="container page-grid">
  <section class="card">
    <div class="card__head">
      <div>
        <h2 class="card__title">भिडियोहरू / Videos</h2>
        <p class="card__sub">आफ्नो मनपर्ने भिडियो ग्यालेरी छान्नुहोस्</p>
      </div>
      <a class="btn btn--primary" href="{{ route('gallery') }}">तस्बिर हेर्नुहोस् (Go to Photos)</a>
    </div>

    <div class="card__body">
      @if(isset($galleries) && $galleries->count() > 0)
        <div class="gallery-grid">
          @foreach($galleries as $gallery)
            <a href="{{ route('ginner', $gallery->slug) }}" style="text-decoration:none;">
              <article class="card gallery-item" style="transition: transform 0.2s; border:1px solid var(--line);">
                <!-- Use first video's related thumbnail or a generic play placeholder -->
                @php
                  $hasCover = false;
                  $coverUrl = '';
                  $firstVideo = $gallery->videos->first();
                  
                  if ($firstVideo && !empty($firstVideo->video_image) && file_exists(storage_path('app/public/community/'.$firstVideo->video_image))) {
                      $hasCover = true;
                      $coverUrl = asset('storage/community/'.$firstVideo->video_image);
                  }
                  
                  /* Fallback to image collection cover if no video cover */
                  if (!$hasCover) {
                     $coverImage = $gallery->images->first();
                     if($coverImage && file_exists(storage_path('app/public/gallery-image/'.$coverImage->image))) {
                       $hasCover = true;
                       $coverUrl = asset('storage/gallery-image/'.$coverImage->image);
                     }
                  }
                @endphp
                
                <div style="position:relative; aspect-ratio:4/3; background:#f0e8d0; display:flex; align-items:center; justify-content:center;">
                  @if($hasCover)
                    <img src="{{ $coverUrl }}" alt="{{ $gallery->title }}" style="width:100%; height:100%; object-fit:cover;" />
                  @else
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="var(--muted)" viewBox="0 0 16 16">
                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                      <path d="M6.271 5.055a.5.5 0 0 1 .52.038l3.5 2.5a.5.5 0 0 1 0 .814l-3.5 2.5A.5.5 0 0 1 6 10.5v-5a.5.5 0 0 1 .271-.445"/>
                    </svg>
                  @endif
                  
                  <!-- Overlay Play Icon -->
                  <div style="position:absolute; inset:0; background:rgba(0,0,0,0.3); display:flex; align-items:center; justify-content:center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#fff" viewBox="0 0 16 16">
                      <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                    </svg>
                  </div>
                </div>

                <div class="cap" style="color:var(--text)">
                  {{ $gallery->title }}
                  <!-- count indicator -->
                  <div style="font-size: 0.8rem; font-weight: normal; color: var(--muted); margin-top:2px;">
                    {{ $gallery->videos->count() }} भिडियोहरू (Videos)
                  </div>
                </div>
              </article>
            </a>
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
