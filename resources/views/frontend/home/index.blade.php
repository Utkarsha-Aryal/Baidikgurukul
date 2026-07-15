<!doctype html>
<html lang="ne">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $sitesetting?->homepage_title ?: 'परमानन्द वैदिक गुरुकुल' }}</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('frontpanel/theme.css') }}">
  <link rel="stylesheet" href="{{ asset('frontpanel/figma-site.css') }}">
  <link rel="stylesheet" href="{{ asset('frontpanel/figma-home/home.css') }}">
</head>
<body>
  @include('frontend.layouts.header')
  <main class="gurukul-home">
    <section class="hero" aria-label="गुरुकुलको मूल सन्देश">
      <img src="{{ asset('frontpanel/figma-home/hero.png') }}" alt="स्वामी रामानन्द गिरि">
      <button class="hero__arrow hero__arrow--left" type="button" aria-label="अघिल्लो स्लाइड">&#8249;</button>
      <button class="hero__arrow hero__arrow--right" type="button" aria-label="अर्को स्लाइड">&#8250;</button>
    </section>

    <section class="welcome" aria-labelledby="gurukul-title">
      <div class="story-strip">
        <img src="{{ asset('frontpanel/figma-home/gurukul-class.png') }}" alt="गुरुकुलमा गुरु र विद्यार्थीहरू">
        <img src="{{ asset('frontpanel/figma-home/gurukul-education.png') }}" alt="वैदिक शिक्षा लिँदै विद्यार्थीहरू">
        <img src="{{ asset('frontpanel/figma-home/ancient-gurukul.png') }}" alt="प्राचीन गुरुकुल शिक्षाको चित्रण">
      </div>

      <div class="welcome__content">
        <article class="intro-panel">
          <header class="intro-panel__header">
            <img src="{{ asset('frontpanel/figma-home/nepal-emblem.svg') }}" alt="नेपालको प्रतीक चिन्ह">
            <h1 id="gurukul-title">परमानन्द वैदिक गुरुकुल</h1>
          </header>
          <p>{{ $about?->description ? strip_tags($about->description) : 'परमानन्द वैदिक गुरुकुल एक धार्मिक तथा शैक्षिक संस्था हो जसको उद्देश्य वैदिक शिक्षा, संस्कार, र सनातन धर्मको संरक्षण तथा प्रवर्द्धन गर्नु हो। यहाँ विद्यार्थीहरूलाई वेद, संस्कृत, योग, ध्यान, र नैतिक शिक्षाको माध्यमबाट आध्यात्मिक र चारित्रिक विकास गराइन्छ। गुरुकुल परम्परालाई आधुनिक शिक्षासँग समायोजन गर्दै संस्कारयुक्त जीवनको आधार प्रदान गर्ने यस संस्थाको मूल ध्येय हो।' }}</p>
        </article>

        <aside class="guru-card">
          <a href="{{ route('about') }}">View More.....</a>
          <div class="guru-card__photo">
            <img src="{{ asset('frontpanel/figma-home/guru-portrait.png') }}" alt="गुरुकुलका गुरु">
          </div>
        </aside>
      </div>
    </section>
  </main>
  @include('frontend.layouts.footer')
  <script>
    const navButton = document.querySelector('.nav-toggle');
    const nav = document.querySelector('#primary-nav');
    navButton?.addEventListener('click', () => {
      const open = nav.classList.toggle('nav--open');
      navButton.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
  </script>
</body>
</html>
