<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Комнатка</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
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
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="container room">
            <div class="content content_center content_h100">
                @if (Route::has('login'))
                    <div>
                        @auth
                            <a href="{{ url('/room') }}" class="btn btn-default btn-lg">Комнатка</a>
                        @else
                            <h1 class="text-center">Комнатка</h1>
                            <div class="text-center">
                                <a href="{{ route('login') }}" class="btn btn-default btn-lg">Вход</a>
                                <a href="{{ route('register') }}" class="btn btn-default btn-lg">Регистрация</a>
                            </div>
                        @endauth
                            <h3 class="text-center"><a href="https://github.com/bcalx/emTestTask">Исходный код (github)</a></h3>
                    </div>
                @endif
            </div>
        </div>
    </body>
</html>
