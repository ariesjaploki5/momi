
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        
        <div id="auth">
            <main class="py-4 mt-4">
                @yield('content')
            </main>
        </div>
        <footer class="footer">
            <div class="container text-center">
                <p class="footer-text">
                    Laravel is a trademark of Taylor Otwell. Copyright © Laravel LLC. all rights reserved.
                    <a href="/terms"><strong>Terms of Service</strong></a>.
                </p>
            </div>
        </footer>

    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
