@extends('frontend.layouts.main')
@section('title', 'समाचार')

@section('content2')
   
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
        <p class="card__sub">Static list for now (backend can later make it dynamic)</p>
      </div>
    </div>
    <div class="card__body">
      <div class="list">
        <div class="list-item">

          <div class="date">15 Feb 2026</div>
          <div>
            <p class="title">New intake schedule published</p>
            <p class="desc">Admissions open for the next batch. Check notices for PDFs.</p>
          </div>
        </div>

        <div class="list-item">
          <div class="date">10 Feb 2026</div>
          <div>
            <p class="title">Prayer hall renovation completed</p>
            <p class="desc">Facilities improved for daily practice.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<footer class="footer">
  <div class="container footer__inner">
    <div><strong>Religious Training Institute</strong><br /><span class="muted">© <span id="year"></span></span></div>
    <div><a href="notices.html">Notices</a> · <a href="events.html">Events</a></div>
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
