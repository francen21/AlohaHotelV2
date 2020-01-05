<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ALOHA HOTEL</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            * {
                box-sizing: border-box;
                }

            .bg-image {
                /* The image used */
                background-image: url('../images/cityside.jpg');

                /* Add the blur effect */
                filter: blur(8px);
                -webkit-filter: blur(8px);

                /* Full height */
                height: 100%;

                /* Center and scale the image nicely */
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                z-index: 2;
            }

            .top-right {
                color: #000000;
                padding: 0 25px;
                font-size: 19px;
                font-weight: 1000;
                letter-spacing: .1rem;
                text-transform: uppercase;
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 94px;
                color: #ffffff;
            }

            .links > a {
                color: #ffffff;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 1000;
                letter-spacing: .1rem;
                text-decoration: aliceblue;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .bg-text {
                background-color: rgb(0,0,0); /* Fallback color */
                background-color: rgba(0,0,0, 0.4); /* Black w/opacity/see-through */

                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                z-index: 2;
                width: 100%;
                padding: 110px;
                text-align: center;
            }
        </style>
    </head>
    <body >
        <div class="bg-image"></div>
        <div class="bg-text">
            <div class="flex-center position-ref full-height">
                @if (Route::has('login'))
                    <div class="top-right">
                        @auth
                            <a href="{{ url('/home') }}">Home</a>
                        @else
                            <a href="{{ route('login') }}">Login</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif

                <div class="content">
                    <div class="title m-b-md">
                        Aloha Hotels
                    </div>

                    <div class="links">
                        <a href="#">Aloha Hotels</a>
                        <a href="#">Brands</a>
                        <a href="#">Services</a>
                        <a href="#">Getting Started</a>
                        <a href="#">Contact Us</a>
                        <a href="#">Faq</a>
                        <a href="#">Jobs</a>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
