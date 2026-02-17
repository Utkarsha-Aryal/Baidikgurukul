@extends('frontend.layouts.main')
@section('title', 'हाम्रो टोली')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
 @foreach($categories as $category)
  <section class="card">
    <div class="card__head">
      <div>
        <h2 class="card__title">{{ $category->name ?? 'Team Category' }}</h2>
        <p class="card__sub">{{ $category->description ?? '' }}</p>
      </div>
      <span class="badge">Updated</span>
    </div>

    <div class="card__body">
      <div class="people">
        @foreach($category->teamMembers as $member)
          <article class="card person">
            <img
              src="{{ $member->photo ? asset('storage/' . $member->photo) : asset('assets/img/default.jpg') }}"
              alt="{{ $member->name ?? 'Member' }} photo"
            />
            <div class="meta">
              <p class="name">{{ $member->name ?? '—' }}</p>
              <p class="role">{{ $member->designation ?? '' }}</p>
            </div>

            {{-- Optional social links --}}
            {{-- 
            <div class="social">
              @if($member->facebook_url)<a href="{{ $member->facebook_url }}" target="_blank">FB</a>@endif
              @if($member->instagram_url)<a href="{{ $member->instagram_url }}" target="_blank">IG</a>@endif
              @if($member->twitter_url)<a href="{{ $member->twitter_url }}" target="_blank">X</a>@endif
            </div>
            --}}
          </article>
        @endforeach
      </div>
    </div>
  </section>
@endforeach

@endsection
