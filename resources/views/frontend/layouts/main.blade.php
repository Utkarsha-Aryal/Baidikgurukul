<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>@yield('title', 'Religious Training Institute')</title>

  <link rel="stylesheet" href="{{ asset('frontpanel/assets2/assets/css/style.css') }}" />
  @stack('styles')
</head>

<body>
  @include('frontend.layouts.header')

  <main>
    @yield('content')
  </main>

  @include('frontend.layouts.footer')

  <script>
    // mobile nav
    const btn = document.querySelector(".nav-toggle");
    const nav = document.querySelector("#primary-nav");
    if (btn && nav) {
      btn.addEventListener("click", () => {
        const open = nav.classList.toggle("nav--open");
        btn.setAttribute("aria-expanded", open ? "true" : "false");
      });
    }

    // footer year
    const y = document.getElementById("year");
    if (y) y.textContent = new Date().getFullYear();
  </script>

  @stack('scripts')
</body>
</html>
