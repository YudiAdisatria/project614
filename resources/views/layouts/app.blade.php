<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

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
            </main>
        </div>

        @stack('modals')

        @livewireScripts
        <!-- Footer Section Start-->

        <footer class="pt-8 pb-8 bg-blue-600 bottom-0">
            <div class="container">
                <div class="flex flex-wrap">
                    <div class="w-full">
                        <p class="font-bold text-2xl text-white text-center mb-8">
                            Profil Kompetensi Sarjana Psikologi<br>Unika Soegijapranata Semarang
                        </p>
                    </div>
                    <div class="w-full pt-8 border-t border-white">
                        <p class="font-medium text-sm text-white text-center">
                            Dibuat oleh Roy Antonio & Yudistira S.A <br> (Teknik Informatika UNIKA Soegijapranata)
                        </p>
                    </div>
                
                </div>
            </div>
        </footer>
        <!-- Footer Section End-->
    </body>
</html>
