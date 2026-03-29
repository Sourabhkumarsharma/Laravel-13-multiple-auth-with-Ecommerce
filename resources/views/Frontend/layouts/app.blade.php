<!DOCTYPE html>
<html>
<head>
    <title>Apkasaman</title>
    @include('frontend.layouts.header_scripts')

</head>
<body class="animsition">

    @include('frontend.layouts.header')

    @yield('content')

    @include('frontend.layouts.footer')
    @include('frontend.layouts.footer_scripts')

</body>
</html>