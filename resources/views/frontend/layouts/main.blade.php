<!doctype html>
<html lang="ne">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Baidik Gurukul')</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <link rel="stylesheet" href="{{ asset('frontpanel/assets/sass/main.css') }}">
  <link rel="stylesheet" href="{{ asset('frontpanel/assets2/assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('frontpanel/theme.css') }}">
  <link rel="stylesheet" href="{{ asset('frontpanel/figma-site.css') }}">
  @if (!empty($siteSetting->img_favicon))
    <link rel="icon" href="{{ asset('storage/setting/' . $siteSetting->img_favicon) }}" type="image/png">
  @endif
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
  @stack('styles')
</head>
<body>
  <div id="notification-container" aria-live="polite"></div>
  <div id="overlay" aria-hidden="true"></div>
  <div id="loader" aria-label="Loading"></div>

  @include('frontend.layouts.header')
  <main id="main-content">@yield('content')</main>
  @include('frontend.layouts.footer')

  <script>
    window.showNotification = function(message, type = 'success') {
      const container = $('#notification-container');
      const notification = $('<div>', { class: 'notification ' + type });
      $('<p>').text(message).appendTo(notification);
      $('<button>', { class: 'close-btn', type: 'button', 'aria-label': 'Close', html: '&times;' }).appendTo(notification);
      container.append(notification);
      notification.find('.close-btn').on('click', () => notification.fadeOut(200, () => notification.remove()));
      setTimeout(() => notification.fadeOut(300, () => notification.remove()), 4000);
    };
    window.showLoader = function() { $('#overlay, #loader').fadeIn(); };
    window.hideLoader = function() { $('#overlay, #loader').fadeOut(); };

    const button = document.querySelector('.nav-toggle');
    const navigation = document.querySelector('#primary-nav');
    if (button && navigation) {
      button.addEventListener('click', () => {
        const open = navigation.classList.toggle('nav--open');
        button.setAttribute('aria-expanded', open ? 'true' : 'false');
      });
    }
    const year = document.getElementById('year');
    if (year) year.textContent = new Date().getFullYear();
  </script>
  @stack('scripts')
</body>
</html>
