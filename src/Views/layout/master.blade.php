<!DOCTYPE html>
<html lang="vi">
    <head>
        @include('layout.head')
        @include('layout.css')
    </head>
    <body ondragstart="return false;" ondrop="return false;">
        @yield('contentmaster')
        @include('layout.js')
    </body>
</html>