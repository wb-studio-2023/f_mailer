<html>
    <head>
        <title>@yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ mix('css/member/common.css') }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        @yield('css')
        @yield('js')
    </head>
    <body>
        <header>
            @include('member.partical.header')
        </header>

        <main>
            @include('member.partical.sidenavi')
            <div id="content">
                @yield('content')
            </div>
        </main>

        <footer>
            @include('member.partical.footer')
        </footer>
    </body>
</html> 