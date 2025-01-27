@if (!empty($history))
    <div class="content-item" id="content1">
        <div class="first_content_wrapper">
            <div class="first_txt">
                <p>{{ $history->title }}</p>
            </div>
            <div class="second_txt shadow-image">
                <p>{!! $history->details !!}</p>
            </div>
        </div>
    </div>
@else
    <p>No Data Found</p>
@endif
