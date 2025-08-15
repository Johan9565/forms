<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
        <script>
            // On page load or when changing themes, best to add inline in `head` to avoid FOUC
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }

            // Function to update application mark based on theme
            function updateApplicationMark() {
                const lightLogos = document.querySelectorAll('.application-mark-light');
                const darkLogos = document.querySelectorAll('.application-mark-dark');

                if (document.documentElement.classList.contains('dark')) {
                    // Dark theme - show dark logo, hide light logo
                    lightLogos.forEach(logo => logo.style.display = 'none');
                    darkLogos.forEach(logo => logo.style.display = 'block');
                } else {
                    // Light theme - show light logo, hide dark logo
                    lightLogos.forEach(logo => logo.style.display = 'block');
                    darkLogos.forEach(logo => logo.style.display = 'none');
                }
            }

            // Update application mark when DOM is ready
            document.addEventListener('DOMContentLoaded', function() {
                updateApplicationMark();
            });
        </script>
    </head>
    <body>
        <div class="font-sans text-gray-900 dark:text-gray-100 antialiased">
            {{ $slot }}
        </div>

        @livewireScripts
    </body>
</html>
