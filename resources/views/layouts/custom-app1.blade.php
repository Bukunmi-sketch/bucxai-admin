<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name="Description"
        content="Purchase airtime and data. Pay your meter electricity bills. Subscribe to DSTV, GOTV, and StarTimes. Fund betting wallet, buy Airtime E-PIN.">
    <meta name="Author" content="Moshood Gbadamosi - CodeFixBug Limited">
    <meta name="keywords"
        content="admin dashboard, bundlegram, Purchase airtime and data, Pay your meter electricity bills, Subscribe to DSTV, GOTV, StarTimes, Fund betting wallet, buy Airtime E-PIN">

    <!-- TITLE -->
    <title>Admin Bundlegram - Buy Data, Airtime, and Pay Bills Instantly</title>

    <!-- FAVICON -->
    <link rel="icon"
        href="https://res.cloudinary.com/morshudlhgmo/image/upload/v1711503888/Bundlegram/512_512_fav_sqt78i.png"
        type="image/x-icon">
    <link rel="shortcut icon"
        href="https://res.cloudinary.com/morshudlhgmo/image/upload/v1711503888/Bundlegram/512_512_fav_sqt78i.png"
        type="image/x-icon">

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{ asset('build/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- APP SCSS -->
    @vite(['resources/sass/app.scss'])


    <!-- ICONS CSS -->
    <link href="{{ asset('build/assets/iconfonts/icons.css') }}" rel="stylesheet">

    <!-- ANIMATE CSS -->
    <link href="{{ asset('build/assets/iconfonts/animated.css') }}" rel="stylesheet">

    <!-- APP CSS -->
    @vite(['resources/css/app.css'])

    @yield('styles')

    @livewireStyles

</head>

<body class="bg-account app sidebar-mini ltr">

    <!--- GLOBAL LOADER -->
    <div id="global-loader">
        <img src="{{ asset('build/assets/images/svgs/loader.svg') }}" alt="loader">
    </div>
    <!--- END GLOBAL LOADER -->

    <!-- PAGE -->
    <div class="page h-100">
        <!-- MAIN-CONTENT -->
        {{ $slot }}
        <!-- END MAIN-CONTENT -->
        @livewireScripts
    </div>
    <!-- END PAGE-->

    <!-- SCRIPTS -->

    @include('layouts.components.custom-scripts')

    <!-- STICKY JS -->
    <script src="{{ asset('build/assets/sticky.js') }}"></script>

    <!-- THEMECOLOR JS -->
    @vite('resources/assets/js/themeColors.js')


    <!-- APP JS -->
    @vite('resources/js/app.js')


    <!-- END SCRIPTS -->

</body>

</html>
