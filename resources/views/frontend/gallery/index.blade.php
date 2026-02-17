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
        <h2 class="card__title">Gallery</h2>
        <p class="card__sub">Replace thumbnails with your real images</p>
      </div>
      <a class="btn" href="gallery-videos.html">Go to Videos</a>
    </div>
    <div class="card__body">
      <div class="gallery-grid">
        <article class="card gallery-item">
          <img src="assets/img/thumb1.jpg" alt="Gallery photo 1" />
          <div class="cap">Satsang</div>
        </article>
        <article class="card gallery-item">
          <img src="assets/img/thumb2.jpg" alt="Gallery photo 2" />
          <div class="cap">Seva</div>
        </article>
        <article class="card gallery-item">
          <img src="assets/img/thumb3.jpg" alt="Gallery photo 3" />
          <div class="cap">Training Class</div>
        </article>
        <article class="card gallery-item">
          <img src="assets/img/thumb1.jpg" alt="Gallery photo 4" />
          <div class="cap">Festival</div>
        </article>
        <article class="card gallery-item">
          <img src="assets/img/thumb2.jpg" alt="Gallery photo 5" />
          <div class="cap">Meditation</div>
        </article>
        <article class="card gallery-item">
          <img src="assets/img/thumb3.jpg" alt="Gallery photo 6" />
          <div class="cap">Community</div>
        </article>
      </div>
    </div>
  </section>
</main>

<footer class="footer">
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
