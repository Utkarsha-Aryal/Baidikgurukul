<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home Page')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('frontpanel/assets/sass/main.css') }}">
    @if (!empty($siteSetting->img_favicon))
        <link rel="icon" href="{{ asset('storage/setting') . '/' . $siteSetting->img_favicon }}" type="image/png">
    @endif
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <script>
        function showNotification(message, type = 'success') {
            const notificationContainer = $('#notification-container');
            const notification = $(`
        <div class="notification ${type}">
            <p>${message}</p>
            <span class="close-btn">&times;</span>
        </div>
    `);
            notificationContainer.append(notification);
            notification.find('.close-btn').on('click', function() {
                notification.fadeOut(300, function() {
                    notification.remove();
                });
            });
            setTimeout(function() {
                notification.fadeOut(300, function() {
                    notification.remove();
                });
            }, 4000);
        }

        function showLoader() {
            $('#overlay').fadeIn();
            $('#loader').fadeIn();
        }

        function hideLoader() {
            $('#overlay').fadeOut();
            $('#loader').fadeOut();
        }
    </script>
    <style>
        #notification-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 10000;
            width: 300px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .notification {
            display: flex;
            align-items: center;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            font-size: 14px;
            color: #fff;
            animation: fadeIn 0.5s, fadeOut 0.5s 3.5s;
        }

        .notification.success {
            background-color: #4CAF50;
        }

        .notification.error {
            background-color: #F44336;
        }

        .notification p {
            margin: 0;
            margin-left: 10px;
            flex: 1;
        }

        .notification .close-btn {
            cursor: pointer;
            margin-left: 10px;
            font-weight: bold;
            color: #fff;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: translateY(0);
            }

            to {
                opacity: 0;
                transform: translateY(-20px);
            }
        }

        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            display: none;
        }

        #loader {
            width: 45px;
            aspect-ratio: 1;
            --c: no-repeat linear-gradient(#000 0 0);
            background:
                var(--c) 0% 50%,
                var(--c) 50% 50%,
                var(--c) 100% 50%;
            background-size: 20% 100%;
            animation: l1 1s infinite linear;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10000;
            display: none;
        }
    </style>
</head>

<body>
    <div id="notification-container"></div>
    <div id="overlay"></div>
    <div id="loader"></div>
    @include('frontend.layout2.header2')
    @yield('content2')
    @include('frontend.layout2.footer2')
</body>

</html>
