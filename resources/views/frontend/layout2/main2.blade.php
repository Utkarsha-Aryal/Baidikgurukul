<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>@yield('title', 'Religious Training Institute')</title>

  <link rel="stylesheet" href="{{ asset('frontpanel/assets1/css/bootstrap.css') }}" />
  <link rel="stylesheet" href="{{ asset('frontpanel/assets/sass/main.css') }}" />
  <link rel="stylesheet" href="{{ asset('frontpanel/assets2/assets/css/style.css') }}" />
  <script src="{{ asset('frontpanel/assets1/js/jquery.js') }}"></script>
  <script src="{{ asset('frontpanel/assets1/js/jquery-validate.js') }}"></script>
  @stack('styles')
</head>

<body>
  @include('frontend.layouts.header')

  <main>
    @yield('content2')
    @yield('content')
  </main>

  @include('frontend.layouts.footer')

  <script src="{{ asset('frontpanel/assets1/js/bootstrap-5.3.3.js') }}"></script>
  <script src="{{ asset('frontpanel/assets1/js/script.js') }}"></script>
  <script>
    const btn = document.querySelector(".nav-toggle");
    const nav = document.querySelector("#primary-nav");
    if (btn && nav) {
      btn.addEventListener("click", () => {
        const open = nav.classList.toggle("nav--open");
        btn.setAttribute("aria-expanded", open ? "true" : "false");
      });
    }

    const y = document.getElementById("year");
    if (y) y.textContent = new Date().getFullYear();

    window.showLoader = window.showLoader || function () {};
    window.hideLoader = window.hideLoader || function () {};
    window.showNotification = window.showNotification || function (message, type) {
      if (message) console[type === "error" ? "error" : "log"](message);
    };

    if (window.jQuery && !window.jQuery.fn.ajaxSubmit) {
      window.jQuery.fn.ajaxSubmit = function (options) {
        const form = this[0];
        const settings = typeof options === "function" ? { success: options } : (options || {});

        if (!form) return this;

        window.jQuery.ajax({
          url: form.action || window.location.href,
          method: form.method || "GET",
          data: new FormData(form),
          processData: false,
          contentType: false,
          success: settings.success,
          error: settings.error,
          complete: settings.complete
        });

        return this;
      };
    }
  </script>

  @stack('scripts')
</body>
</html>
