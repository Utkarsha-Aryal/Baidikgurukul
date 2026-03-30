@extends('frontend.layouts.main')
@section('title', 'ग्यालेरी तस्बिरहरू')

@push('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
  <style>
    .gallery-image-wrapper {
      position: relative;
      overflow: hidden;
      border-radius: var(--radius);
      border: 1px solid var(--line);
      aspect-ratio: 4/3;
      cursor: pointer;
    }
    .gallery-image-wrapper img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.3s;
    }
    .gallery-image-wrapper:hover img {
      transform: scale(1.05);
    }
  </style>
@endpush

@section('content')
<section class="page-hero">
  <div class="container page-hero__inner">
    <h1>तस्बिरहरू (Photos)</h1>
    <p>ग्यालेरीका तस्बिरहरू हेर्नुहोस्</p>
  </div>
</section>

<main class="container page-grid">
  <section class="card">
    <div class="card__head">
      <div>
        <h2 class="card__title">तस्बिर संग्रह</h2>
        <p class="card__sub">तस्बिर ठूलो बनाउन क्लिक गर्नुहोस्</p>
      </div>
      <a class="btn" href="{{ route('gallery') }}">पछाडि जानुहोस् (Back)</a>
    </div>

    <div class="card__body">
      @if(isset($images) && count($images) > 0)
        <div class="gallery-grid">
          @foreach($images as $image)
            @if(file_exists(storage_path('app/public/gallery-image/'.$image->image)))
              <a href="{{ asset('storage/gallery-image/'.$image->image) }}" data-fancybox="gallery" data-caption="{{ $image->title ?? '' }}">
                <div class="gallery-image-wrapper">
                  <img src="{{ asset('storage/gallery-image/'.$image->image) }}" alt="{{ $image->title ?? 'Gallery Image' }}" loading="lazy" />
                </div>
              </a>
            @endif
          @endforeach
        </div>
        
        <!-- Pagination -->
        <div style="margin-top: 2rem; display: flex; justify-content: center;">
            {{ $images->links() }}
        </div>
      @else
        <div style="text-align:center; padding: 2rem;">
           <p style="color:var(--muted)">कुनै तस्बिर भेटिएन। (No photos found).</p>
        </div>
      @endif
    </div>
  </section>
</main>
@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      if (typeof Fancybox !== 'undefined') {
        Fancybox.bind('[data-fancybox="gallery"]', {
          Toolbar: {
            display: [
              "autoPlay",
              "fullscreen",
              "zoom",
              "close",
            ],
          },
          loop: true,
        });
      }
    });
  </script>
@endpush
