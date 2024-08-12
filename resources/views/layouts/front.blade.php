<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="google-site-verification" content="4KP0mHB-RKmQrJzLm98WkbdV-VDtF5LQeJvx1CVjkLA" />
    <link rel="icon" type="image/x-icon" href="/images/code-origins/Logo.png">
    <title> @yield('title')</title>
    <meta name="description" content=" @yield('description')">
    <meta name="keywords" content=" @yield('keywords')">
    <link rel="canonical" href=" @yield('url')">
    <link rel="stylesheet" href="/css/style.css">
    @yield('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div>
        <header class="header">
            <div class="head header_left">
                <div>
                    <ul>
                        <li><a href="/">Главная</a></li>
                        <li><a href="/about-us">О Нас</a></li>
                        <li><a href="/contacts">Контакти</a></li>
                    </ul>
                </div>
            </div>
            <div class="head header_center">
                <div>
                    <a href="/"><img src="/images/stom/logo.svg" alt="logo"></a>
                </div>
            </div>
            <div class="head header_right">
                <div>
                    <ul>
                        <li>
                            <a href=""><img src="/images/stom/insta.svg" alt="image"></a>
                        </li>
                        <li>
                            <a href=""><img src="/images/stom/telegram.svg" alt="image"></a>
                                </li>
                        <li>
                            <a href=""> <img src="/images/stom/whatsapp.svg" alt="image"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>


        @yield('content')


        <div>
            <div class="footer">
                <div class="foot footer_left">
                    <div class="footer_logo">
                        <a href="/"><img src="/images/stom/logo.svg" alt="logo"></a>
                    </div>
                    
                </div>
                <div class="foot footer_center">
                   
                </div>
                <div class="foot footer_right">
                    <div>
                        <h3>Оставайся на связи</h3>
                    </div>
                    <div>
                        
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="copyright-box">
                        <p class="copyright-text">© 2024, All Rights Reserved by <a href="https://codeorigins.am/"
                                target="_blank" class='codeOrigins'>Codeorigins.am</a></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @yield('script')
</body>

</html>
