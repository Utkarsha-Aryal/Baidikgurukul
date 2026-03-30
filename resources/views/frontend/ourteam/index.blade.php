@extends('frontend.layouts.main')
@section('title', 'हाम्रो टोली')

@push('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
  /* ── Team Page Styles (uses site-wide :root vars from style.css) ── */

  /* ── Page Hero Banner ───────────────────────────────── */
  .team-hero {
    background: linear-gradient(135deg, var(--brand2, #8b1c2d) 0%, #3b1a08 50%, var(--brand, #ff7a00) 100%);
    padding: 3rem 1.5rem 2.5rem;
    text-align: center;
    position: relative;
    overflow: hidden;
  }
  .team-hero::before {
    content: 'ॐ';
    position: absolute;
    font-size: 14rem;
    color: rgba(255,255,255,.05);
    top: -2rem; left: 50%;
    transform: translateX(-50%);
    pointer-events: none;
    line-height: 1;
  }
  .team-hero__title {
    font-size: clamp(1.6rem, 4vw, 2.6rem);
    font-weight: 800;
    color: #fff;
    margin: 0 0 .5rem;
    letter-spacing: .02em;
  }
  .team-hero__subtitle {
    color: rgba(255,255,255,.65);
    font-size: .98rem;
    margin: 0;
  }

  /* ── Page Wrapper ───────────────────────────────────── */
  .team-page {
    max-width: var(--container, 1180px);
    margin: 0 auto;
    padding: 1.5rem 1rem 3rem;
  }

  /* ── Year Interval Selector ─────────────────────────── */
  .year-bar {
    display: flex;
    align-items: center;
    gap: .5rem;
    flex-wrap: wrap;
    margin-bottom: 1.5rem;
    padding: 1rem 1.25rem;
    background: var(--card, #fff);
    border-radius: var(--radius, 16px);
    box-shadow: var(--shadow);
    border-left: 4px solid var(--brand, #ff7a00);
    border: 1px solid var(--line, #efd8b6);
    border-left: 4px solid var(--brand, #ff7a00);
  }
  .year-bar__label {
    font-weight: 800;
    font-size: .85rem;
    color: var(--muted, #6b4b2a);
    text-transform: uppercase;
    letter-spacing: .08em;
    margin-right: .5rem;
    flex-shrink: 0;
  }
  .year-btn {
    padding: .4rem 1rem;
    border-radius: 999px;
    border: 2px solid var(--line, #efd8b6);
    background: transparent;
    color: var(--muted, #6b4b2a);
    font-size: .85rem;
    font-weight: 700;
    cursor: pointer;
    transition: all .25s;
    white-space: nowrap;
  }
  .year-btn:hover {
    border-color: var(--brand, #ff7a00);
    color: var(--brand, #ff7a00);
  }
  .year-btn.active {
    background: linear-gradient(135deg, var(--brand, #ff7a00), var(--brand2, #8b1c2d));
    border-color: transparent;
    color: #fff;
    box-shadow: 0 3px 12px rgba(255,122,0,.3);
  }

  /* ── Category Section Card ──────────────────────────── */
  .team-section {
    background: var(--card, #fff);
    border-radius: var(--radius, 16px);
    box-shadow: var(--shadow);
    border: 1px solid var(--line, #efd8b6);
    margin-bottom: 1.5rem;
    overflow: hidden;
  }
  .team-section__head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    padding: 1rem 1.25rem;
    background: linear-gradient(90deg, #fdf3e0 0%, var(--card, #fff) 100%);
    border-bottom: 1px solid var(--line, #efd8b6);
  }
  .team-section__title {
    font-size: 1.15rem;
    font-weight: 900;
    color: var(--text, #2b1700);
    margin: 0;
  }
  .team-section__badge {
    font-size: .75rem;
    font-weight: 800;
    padding: .25rem .7rem;
    border-radius: 999px;
    background: linear-gradient(135deg, var(--brand, #ff7a00), var(--brand2, #8b1c2d));
    color: #fff;
    letter-spacing: .04em;
  }
  .team-section__body {
    padding: 1.25rem;
    min-height: 100px;
  }

  /* ── Member Grid ────────────────────────────────────── */
  .members-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(165px, 1fr));
    gap: 1.1rem;
  }

  /* ── Member Card ────────────────────────────────────── */
  .member-card {
    border-radius: var(--radius, 16px);
    overflow: hidden;
    background: var(--card, #fff);
    border: 1px solid var(--line, #efd8b6);
    transition: transform .3s, box-shadow .3s;
    text-align: center;
  }
  .member-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 28px rgba(43,23,0,.14);
    border-color: var(--brand, #ff7a00);
  }
  .member-card__img-wrap {
    position: relative;
    overflow: hidden;
    aspect-ratio: 1 / 1;
    background: #fdf3e0;
  }
  .member-card__img-wrap img {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
    transition: transform .4s;
  }
  .member-card:hover .member-card__img-wrap img {
    transform: scale(1.06);
  }

  /* Hover overlay */
  .member-card__overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(43,23,0,.8) 0%, transparent 55%);
    opacity: 0;
    transition: opacity .3s;
    display: flex;
    align-items: flex-end;
    justify-content: center;
    padding-bottom: .8rem;
  }
  .member-card:hover .member-card__overlay { opacity: 1; }
  .member-card__overlay-link {
    font-size: .78rem;
    font-weight: 700;
    color: #fff;
    border: 1.5px solid rgba(255,255,255,.6);
    border-radius: 999px;
    padding: .3rem .85rem;
    text-decoration: none;
    transition: background .2s, border-color .2s;
  }
  .member-card__overlay-link:hover {
    background: var(--brand, #ff7a00);
    border-color: var(--brand, #ff7a00);
  }

  .member-card__info {
    padding: .6rem .5rem .75rem;
  }
  .member-card__name {
    font-size: .88rem;
    font-weight: 900;
    color: var(--text, #2b1700);
    margin: 0 0 .15rem;
    line-height: 1.3;
  }
  .member-card__role {
    font-size: .78rem;
    color: var(--muted, #6b4b2a);
    font-weight: 650;
    margin: 0;
  }

  /* ── Loading / Empty States ─────────────────────────── */
  .team-loading, .team-empty {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 90px;
    width: 100%;
    color: var(--muted, #6b4b2a);
    font-size: .9rem;
    font-weight: 650;
  }
  .team-loading::after {
    content: '';
    display: inline-block;
    width: 20px; height: 20px;
    border: 3px solid var(--line, #efd8b6);
    border-top-color: var(--brand, #ff7a00);
    border-radius: 50%;
    animation: team-spin .65s linear infinite;
    margin-left: .6rem;
  }
  @keyframes team-spin { to { transform: rotate(360deg); } }

  /* ── No categories fallback ─────────────────────────── */
  .team-no-data {
    text-align: center;
    padding: 3rem 1rem;
    color: var(--muted, #6b4b2a);
  }
  .team-no-data p { font-size: 1rem; margin: .4rem 0; }

  /* ── Responsive ─────────────────────────────────────── */
  @media (max-width: 480px) {
    .members-grid { grid-template-columns: repeat(auto-fill, minmax(130px, 1fr)); }
    .team-hero { padding: 2rem 1rem 1.5rem; }
    .team-section__head { flex-direction: column; align-items: flex-start; gap: .4rem; }
  }
</style>
@endpush

@section('content')

{{-- ── Hero Banner ─────────────────────────────────────────── --}}
<div class="team-hero">
  <h1 class="team-hero__title">हाम्रो टोली</h1>
  <p class="team-hero__subtitle">Our Committee Members &amp; Team</p>
</div>

<div class="team-page">

  {{-- ── Year Interval Selector ──────────────────────────────── --}}
  @if(isset($timeIntervals) && $timeIntervals->isNotEmpty())
  <div class="year-bar" id="year-bar">
    <span class="year-bar__label">कार्यकाल / Period:</span>
    @foreach($timeIntervals as $interval)
      <button
        type="button"
        class="year-btn {{ $interval->id == $intervalId ? 'active' : '' }}"
        data-interval-id="{{ $interval->id }}"
        data-year-interval="{{ $interval->year_interval }}"
        id="year-btn-{{ $interval->id }}"
      >
        {{ $interval->year_interval }}
      </button>
    @endforeach
  </div>
  @endif

  {{-- ── Category Sections ───────────────────────────────────── --}}
  @if(isset($categories) && $categories->isNotEmpty())
    @foreach($categories as $category)
    <section class="team-section" id="section-{{ $category->id }}">
      <div class="team-section__head">
        <h2 class="team-section__title">{{ $category->team_category }}</h2>
        <span class="team-section__badge">क्रम {{ $category->order_number }}</span>
      </div>
      <div class="team-section__body" id="body-{{ $category->id }}">
        <div class="team-loading">Loading members</div>
      </div>
    </section>
    @endforeach
  @else
    <div class="team-no-data">
      <p>कुनै टोली समूह भेटिएन।</p>
      <p style="font-size:.85rem; opacity:.7">No team categories found. Please add categories from the admin panel.</p>
    </div>
  @endif

</div>
@endsection

@push('scripts')
<script>
(function () {
  var CSRF = document.querySelector('meta[name="csrf-token"]');
  CSRF = CSRF ? CSRF.content : '';
  var AJAX_URL = "{{ route('team.gettabcontent') }}";

  // All category data
  var categories = @json($categories->map(function($c) { return ['id' => $c->id, 'slug' => $c->slug]; })->values());

  // Determine initial year interval
  var activeBtn = document.querySelector('.year-btn.active');
  var currentIntervalYear = activeBtn ? activeBtn.getAttribute('data-year-interval') : '';

  // ── Load members for ONE category ─────────────────────
  function loadCategory(slug, categoryId, yearInterval) {
    var body = document.getElementById('body-' + categoryId);
    if (!body) return;
    body.innerHTML = '<div class="team-loading">Loading members</div>';

    var xhr = new XMLHttpRequest();
    xhr.open('POST', AJAX_URL, true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('X-CSRF-TOKEN', CSRF);
    xhr.setRequestHeader('Accept', 'application/json');

    xhr.onreadystatechange = function () {
      if (xhr.readyState !== 4) return;
      if (xhr.status === 200) {
        try {
          var data = JSON.parse(xhr.responseText);
          if (data.type === 'success' && data.html) {
            body.innerHTML = data.html;
          } else {
            body.innerHTML = '<div class="team-empty">No members found for this period.</div>';
          }
        } catch (e) {
          body.innerHTML = '<div class="team-empty">Could not load members.</div>';
        }
      } else {
        body.innerHTML = '<div class="team-empty">An error occurred. Please try again.</div>';
      }
    };

    xhr.send(JSON.stringify({ slug: slug, yearInterval: yearInterval }));
  }

  // ── Load ALL categories for a given year interval ─────
  function loadAll(yearInterval) {
    for (var i = 0; i < categories.length; i++) {
      loadCategory(categories[i].slug, categories[i].id, yearInterval);
    }
  }

  // ── Year button click handler ──────────────────────────
  var yearButtons = document.querySelectorAll('.year-btn');
  for (var i = 0; i < yearButtons.length; i++) {
    yearButtons[i].addEventListener('click', function () {
      for (var j = 0; j < yearButtons.length; j++) {
        yearButtons[j].classList.remove('active');
      }
      this.classList.add('active');
      currentIntervalYear = this.getAttribute('data-year-interval');
      loadAll(currentIntervalYear);
    });
  }

  // ── Initial load ───────────────────────────────────────
  if (currentIntervalYear && categories.length > 0) {
    loadAll(currentIntervalYear);
  }
})();
</script>
@endpush
