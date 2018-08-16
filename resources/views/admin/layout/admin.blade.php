<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{config('app.name', 'Laravel Multi Auth Guard')}}@yield('title')</title>

    @yield('meta-tag')

    <!-- default css -->
    @include('admin.inc.main-css')

    <!-- custom css  load here-->
    @yield('custom-css')

<!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script src="//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

</head>
<body>

<!-- Side Navbar -->
    <nav class="side-navbar">
        @include('admin.inc.sidebar')
    </nav>
    <div class="page">
        <!-- navbar-->
        <header class="header">
            @include('admin.inc.header')
        </header>

        @yield('content')


        <footer class="main-footer">
            @include('admin.inc.footer')
        </footer>
    </div>
    <!-- JavaScript files-->

    {{--include js --}}

    @include('admin.inc.main-js')

    {{--load custom  js here--}}

    @stack('scripts')
</body>
</html>
