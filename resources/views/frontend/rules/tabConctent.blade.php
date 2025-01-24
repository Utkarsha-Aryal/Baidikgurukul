@if (!empty($rule))
    <div class="content-item" id="content1">
        <div class="first_content_wrapper">
            <div class="first_txt">
                <p>{{ $rule->title }}</p>
            </div>
            <div class="second_txt">
                <p>{!! $rule->details !!}</p>
            </div>
        </div>
    </div>
@else
    <p>No Data Found</p>
@endif
