<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">

        <link rel="stylesheet" href="./css/styles.css">

        @livewireStyles

        <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link rel="stylesheet" href="./css/loading.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen main-bg">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
                @include("layouts.dashboard-partials.sidenav")
            </main>
        </div>
        @livewireScripts
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src = "./scripts/userRecipes.js" type="module"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="./scripts/mobileInput.js"></script>
        <script src="./scripts/imageRegisterUpload.js"></script>
        <script>
            window.addEventListener("close-modal", function(event) {
                const modalId = event.detail.modalId;
                const closeModalBtn = document.querySelector(`[data-modal-hide="${modalId}"]`);
                closeModalBtn.click();
            });
            
            window.addEventListener("success", function(event) {
                const message = event.detail.message;
                toastr.options = {
                    "progressBar" : true,
                    "closeButton": true,
                }
                toastr.success(message);
        
            });

            window.addEventListener("error", function(event) {
                const message = event.detail.message;
                toastr.options = {
                    "progressBar" : true,
                    "closeButton": true,
                }
                toastr.error(message);
        
            });
        </script>
        
    </body>
</html>
