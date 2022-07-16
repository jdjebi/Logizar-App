<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Logizar') }}</title>

        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">

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

            <!-- Extras styles -->
            @if (isset($extras_css))
                {{ $extras_css }}
            @endif

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
                <div class="bg-white">
                    <x-tabs.tab-underline>
                        <x-tabs.tab-item-underline :href="route('admin.project.categories')" :active="request()->routeIs('admin.project.categories')">
                            Catégories
                        </x-tabs.tab-item-underline>
                        <x-tabs.tab-item-underline :href="route('admin.project.other-categories')" :active="request()->routeIs('admin.project.other-categories')">
                            Autre Catégories
                        </x-tabs.tab-item-underline>
                        <x-tabs.tab-item-underline :href="route('admin.project.types')" :active="request()->routeIs('admin.project.types')">
                            Types de projet
                        </x-tabs.tab-item-underline>
                        <x-tabs.tab-item-underline :href="route('admin.project.deliverables')" :active="request()->routeIs('admin.project.deliverables')">
                            Livrables
                        </x-tabs.tab-item-underline>
                    </x-tabs.tab-underline>
                </div>
                <div class="pb-3">
                    {{ $slot }}
                </div>
            </main>
        </div>

        <x-footer/>

        @stack('modals')

        @livewireScripts

        @stack("scripts")

    </body>
</html>
