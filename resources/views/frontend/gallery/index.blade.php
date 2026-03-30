@extends('frontend.layouts.main')
@section('title', 'ग्यालेरी')


@section('content')
   
<section class="page-hero">
  <div class="container page-hero__inner">
    <h1>Photo Gallery</h1>
    <p>Temple, training sessions, seva, retreats, celebrations.</p>
  </div>
</section>

<main class="container page-grid">
  <section class="card">
    <div class="card__head">
      <div>
        <h2 class="card__title">त्रियाकलापहरू / Galleries</h2>
        <p class="card__sub">आफ्नो मनपर्ने ग्यालेरी छान्नुहोस्</p>
      </div>
      <a class="btn btn--primary" href="{{ route('video') }}">भिडियो हेर्नुहोस् (Go to Videos)</a>
    </div>
    <div class="card__body">
      @if(isset($galleries) && $galleries->count() > 0)
        <div class="gallery-grid">
          @foreach($galleries as $gallery)
            <a href="{{ route('image.inner', $gallery->slug) }}" style="text-decoration:none;">
              <article class="card gallery-item" style="transition: transform 0.2s; border:1px solid var(--line);">
                @php
                  $coverImage = $gallery->images->first();
                @endphp
                @if($coverImage && file_exists(storage_path('app/public/gallery-image/'.$coverImage->image)))
                  <img src="{{ asset('storage/gallery-image/'.$coverImage->image) }}" alt="{{ $gallery->title }}" />
                @else
                  <img src="{{ asset('frontpanel/assets/images/curved.jpeg') }}" alt="Placeholder" style="background:#f0e8d0;" />
                @endif
                <div class="cap" style="color:var(--text)">
                  {{ $gallery->title }}
                  <!-- count indicator -->
                  <div style="font-size: 0.8rem; font-weight: normal; color: var(--muted); margin-top:2px;">
                    {{ $gallery->images->count() }} तस्बिरहरू (Photos)
                  </div>
                </div>
              </article>
            </a>
          @endforeach
        </div>
      @else
        <div style="text-align:center; padding: 2rem;">
           <p style="color:var(--muted)">कुनै ग्यालेरी भेटिएन। (No galleries found).</p>
        </div>
      @endif
    </div>
  </section>
</main>

  <div class="container footer__inner">
    <div><strong>Religious Training Institute</strong><br /><span class="muted">© <span id="year"></span></span></div>
    <div><a href="gallery-videos.html">Video Gallery</a> · <a href="index.html">Home</a></div>
  </div>
</footer>

<script>
  const btn = document.querySelector(".nav-toggle");
  const nav = document.querySelector("#primary-nav");
  btn.addEventListener("click", () => {
    const open = nav.classList.toggle("nav--open");
    btn.setAttribute("aria-expanded", open ? "true" : "false");
  });
  document.getElementById("year").textContent = new Date().getFullYear();
</script>
@endsection
