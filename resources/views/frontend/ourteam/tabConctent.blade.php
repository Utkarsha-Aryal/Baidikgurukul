@if (!empty($teammember) && count($teammember) > 0)
<div class="members-grid">
    @foreach ($teammember as $member)
    <article class="member-card">
        <div class="member-card__img-wrap">
            <a href="{{ route('teaminner', $member->slug) }}">
                @if (!empty($member->photo) && file_exists(storage_path('app/public/community/' . $member->photo)))
                    <img
                        src="{{ asset('storage/community/' . $member->photo) }}"
                        alt="{{ $member->name }}"
                        loading="lazy"
                    >
                @else
                    <img
                        src="{{ asset('frontpanel/assets/images/curved.jpeg') }}"
                        alt="{{ $member->name }}"
                        loading="lazy"
                    >
                @endif
            </a>
            <div class="member-card__overlay">
                <a href="{{ route('teaminner', $member->slug) }}" class="member-card__overlay-link">
                    View Profile
                </a>
            </div>
        </div>
        <div class="member-card__info">
            <p class="member-card__name">{{ $member->name ?? '' }}</p>
            <p class="member-card__role">{{ $member->designation ?? '' }}</p>
        </div>
    </article>
    @endforeach
</div>
@else
<div class="team-empty">
    यस वर्षको लागि सदस्यहरू फेला परेनन् — No members found for this period.
</div>
@endif