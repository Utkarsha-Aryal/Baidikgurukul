@extends('frontend.layouts.main')
@section('title', 'आगामी कार्यक्रमहरू')

@section('content')
<section class="page-hero">
  <div class="container page-hero__inner">
    <h1>कार्यक्रमहरू (Events)</h1>
    <p>आगामी तथा सम्पन्न कार्यक्रमहरूको विवरण</p>
  </div>
</section>

<main class="container page-grid">
  <section class="card">
    <div class="card__head">
      <div>
        <h2 class="card__title">Upcoming Events</h2>
        <p class="card__sub">Latest updates and programs</p>
      </div>
    </div>
    <div class="card__body">
      @if(isset($events) && $events->count() > 0)
        <div class="list">
          @foreach($events as $event)
            <a class="list-item" href="{{ route('event.inner.page', $event->slug) }}" style="text-decoration:none;">
              <!-- Format the date gracefully -->
              @php 
                $dayStr = $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('d M Y') : ''; 
              @endphp
              
              <div class="date" style="color:var(--brand); white-space:nowrap; font-size:1.1rem; text-align:center;">
                <span style="font-size:1.5rem; display:block; color:var(--text);">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</span>
                {{ \Carbon\Carbon::parse($event->event_date)->format('M Y') }}
              </div>
              
              <div style="padding-left:10px; border-left:1px solid var(--line);">
                <p class="title" style="color:var(--text); font-size:1.1rem;">{{ $event->title }}</p>
                <p class="desc" style="color:var(--muted); font-size:0.9rem;">
                  {{ Str::limit(strip_tags($event->details), 100) }}
                </p>
                <!-- Time & Location Metadata -->
                <div style="display:flex; gap:15px; margin-top:8px; font-size:0.8rem; color:#888;">
                  @if($event->event_time_start)<span><svg width="12" height="12" fill="currentColor" viewBox="0 0 16 16"><path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/><path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/></svg> {{ $event->event_time_start }}</span>@endif
                  @if($event->venue)<span><svg width="12" height="12" fill="currentColor" viewBox="0 0 16 16"><path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/></svg> {{ $event->venue }}</span>@endif
                </div>
              </div>
            </a>
          @endforeach
        </div>
        
        <!-- Pagination controls -->
        <div style="margin-top: 1.5rem; display: flex; justify-content: center;">
            {{ $events->links() }}
        </div>
      @else
        <div style="text-align:center; padding: 2rem;">
           <p style="color:var(--muted)">कुनै आगामी कार्यक्रम भेटिएन। (No upcoming events).</p>
        </div>
      @endif
    </div>
  </section>
</main>
@endsection
