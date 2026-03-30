@extends('frontend.layouts.main')
@section('title', 'Notices')

@section('content')
<section class="page-hero">
  <div class="container page-hero__inner">
    <h1>Notices</h1>
    <p>Official notices and announcements.</p>
  </div>
</section>

<main class="container page-grid">
  <section class="card">
    <div class="card__head">
      <div>
        <h2 class="card__title">All Notices</h2>
      </div>
    </div>
    <div class="card__body">
      <div class="list">
        @forelse($notices as $notice)
          <div class="list-item" style="display: flex; gap: 1rem; align-items: flex-start;">
            <div class="date" style="min-width: 100px;">
              {{ \Carbon\Carbon::parse($notice->start_date)->format('d M Y') }}
            </div>
            <div style="flex: 1;">
              <p class="title">{{ $notice->title }}</p>
              @if($notice->image)
                <p class="desc" style="margin-top: 0.5rem;">
                  <a href="{{ asset('storage/notice/' . $notice->image) }}" target="_blank" style="font-weight: bold; color: inherit; text-decoration: underline;">
                    View / Download Circular
                  </a>
                </p>
              @endif
            </div>
          </div>
        @empty
          <p style="padding: 1rem;">No notices available at this time.</p>
        @endforelse
      </div>
      
      @if($notices->hasPages())
        <div class="pagination-wrapper" style="margin-top: 2rem; padding: 1rem;">
          {{ $notices->links() }}
        </div>
      @endif
    </div>
  </section>
</main>
@endsection
