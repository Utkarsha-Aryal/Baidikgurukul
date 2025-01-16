<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home Page')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('frontpanel/assets/sass/main.css') }}">
    @if (!empty($siteSettings->img_favicon))
        <link rel="icon" href="{{ asset('storage/setting') . '/' . $siteSettings->img_favicon }}" type="image/png">
    @endif

</head>

<body>
    @include('frontend.layouts.header')
    @yield('content')
    @include('frontend.layouts.footer')
</body>

</html>
