<!doctype html>
<html lang="en">
<head>
    <title>Apkasaman</title>
    @include('admin.layouts.header_scripts')

</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
 <div class="app-wrapper">
    @include('admin.layouts.header')
  <main class="app-main">
    @yield('content')
</main>
    @include('admin.layouts.footer')
    @include('admin.layouts.footer_scripts')
</div>
</body>
</html>