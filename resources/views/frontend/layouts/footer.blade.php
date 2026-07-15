<footer class="site-footer">
  <div class="container site-footer__grid">
    <div class="site-footer__identity">
      <img src="{{ asset('frontpanel/figma-home/nepal-emblem.svg') }}" alt="">
      <div><strong>परमानन्द वैदिक गुरुकुल</strong><p>वैदिक ज्ञान, अनुशासन र सेवामार्फत संस्कारयुक्त जीवनको आधार।</p></div>
    </div>
    <div><h2>छिटो पहुँच</h2><nav class="site-footer__links" aria-label="पादलेख नेभिगेसन"><a href="{{ route('about') }}">परिचय</a><a href="{{ route('program') }}">कार्यक्रम</a><a href="{{ route('gallery') }}">ग्यालरी</a><a href="{{ route('list') }}">सहयोगीहरू</a></nav></div>
    <div><h2>सम्पर्क</h2>@if(!empty($siteSetting?->address))<p>{{ $siteSetting->address }}</p>@endif @if(!empty($siteSetting?->phone_number))<a href="tel:{{ $siteSetting->phone_number }}">{{ $siteSetting->phone_number }}</a>@endif @if(!empty($siteSetting?->email))<a href="mailto:{{ $siteSetting->email }}">{{ $siteSetting->email }}</a>@endif</div>
  </div>
  <div class="site-footer__bottom"><div class="container">© {{ date('Y') }} परमानन्द वैदिक गुरुकुल</div></div>
</footer>
