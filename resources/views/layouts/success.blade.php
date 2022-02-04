<!DOCTYPE html>
<html lang="en">

<head>
    {{-- Meta --}}
    @include('includes.meta')

    <title>@yield('title')</title>

    {{-- Style --}}
    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')
</head>

<body>
    {{-- Page Content --}}
    @yield('content')

    {{-- Footer --}}
    @include('includes.footer')

    <!-- Bootstrap core JavaScript -->
    
    {{-- Script --}}
    @stack('prepend-script')
    @include('includes.script')
    @stack('addon-script')
</body>

</html>
