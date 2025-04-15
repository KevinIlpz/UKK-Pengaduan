<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
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
    </head>
    <body class="font-sans antialiased h-full bg-gray-900">
        <div class="min-h-screen flex flex-col">
            <!-- Navigation -->
            @include('layouts.navigation')

            <!-- Main Content -->
            <main class="flex-1">
                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-gray-800 shadow-md border-b border-gray-700">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                                {{ $header }}
                            </h2>
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <div class="py-8">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="bg-gray-800 rounded-xl shadow-lg border border-gray-700 p-6">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
