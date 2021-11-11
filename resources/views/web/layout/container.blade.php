<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    @yield("head")
    <link rel="shortcut icon" href="/assets/img/LogoHitam.png">
    <link href='{{ url()->current() }}' rel='canonical' />
    @include('web.layout.styles')
</head>

<body>
    <div id="root"></div>
    @yield("content")
    @include('web.layout.scripts')
</body>

</html>
