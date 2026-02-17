@extends('frontend.layouts.main')
@section('title', 'आगामी कार्यक्रम')

@section('content')
  <section class="page-hero">
  <div class="container page-hero__inner">
    <h1>Events</h1>
    <p>Upcoming and past events list.</p>
  </div>
</section>

<main class="container page-grid">
  <section class="card">
    <div class="card__head">
      <div>
        <h2 class="card__title">Upcoming Events</h2>
        <p class="card__sub">Edit event dates/descriptions</p>
      </div>
    </div>
    <div class="card__body">
      <div class="list">
        <div class="list-item">
            <a class="list-item" href="event-detail.html">
          <div class="date">20 Feb 2026</div>
          <div>
            <p class="title">Monthly Satsang</p>
            <p class="desc">Evening satsang, teaching, and community meal.</p>
          </div>
          </a>
        </div>
        <div class="list-item">
          <div class="date">05 Mar 2026</div>
          <div>
            <p class="title">Retreat Week</p>
            <p class="desc">Silence, meditation, study, seva.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="card">
    <div class="card__head">
      <div>
        <h2 class="card__title">Past Events</h2>
        <p class="card__sub">Optional</p>
      </div>
    </div>
    <div class="card__body">
      <div class="list">
        <div class="list-item">
          <div class="date">10 Jan 2026</div>
          <div>
            <p class="title">Annual Celebration</p>
            <p class="desc">Cultural and spiritual program.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

@endsection
