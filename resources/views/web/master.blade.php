<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Typing Speed Test')</title>
    {{--  header links(like css or js or all lib links)  --}}
    @include('web.layouts.header.header-links')
    @yield('schema')
</head>
<body>
    <div class="wrapper">
        {{--  Header  --}}
        @include('web.layouts.header.header')
        <div class="content">
            {{--  Page content  --}}
            @yield('page-content')
        </div>
        {{--  Footer  --}}
        @include('web.layouts.footer.footer')
    </div>
    {{--  all Model  --}}
    @yield('model')
    {{--  Footer links(like js)  --}}
    @include('web.layouts.footer.footer-links')
    {{--  Common js  --}}
    @include('web.layouts.common-js.common-js')
    {{--  Specific Page js  --}}
    @yield('webJs')
    @stack('scripts')
</body>
</html>
