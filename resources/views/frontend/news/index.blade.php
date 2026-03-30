@extends('frontend.layouts.main')
@section('title', 'समाचार')

@section('content')
   
<section class="page-hero">
  <div class="container page-hero__inner">
    <h1>News</h1>
    <p>Latest updates and announcements.</p>
  </div>
</section>

<main class="container page-grid">
  <section class="card">
    <div class="card__head">
      <div>
        <h2 class="card__title">Latest News</h2>
    <div class="card__body">
      <div class="list">
        @forelse($posts as $post)
          <a class="list-item" href="{{ route('news.inner.page', $post->slug) }}" style="text-decoration: none; color: inherit;">
            <div class="date">
              {{ $post->event_date ? \Carbon\Carbon::parse($post->event_date)->format('d M Y') : '' }}
            </div>
            <div>
              <p class="title">{{ $post->title }}</p>
              <p class="desc">{{ \Illuminate\Support\Str::limit(strip_tags($post->details), 80) }}</p>
            </div>
          </a>
        @empty
          <p style="padding: 1rem;">No news available at this moment.</p>
        @endforelse
      </div>
      
      @if($posts->hasPages())
        <div class="pagination-wrapper" style="margin-top: 2rem; padding: 1rem;">
          {{ $posts->links() }}
        </div>
      @endif
    </div>
  </section>
</main>



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
