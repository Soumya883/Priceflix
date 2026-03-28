<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&family=outfit:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-slate-100 bg-[#0b0e14] selection:bg-cyan-500/30">
        <div class="min-h-screen relative overflow-x-hidden">
            <!-- Global Background Blobs -->
            <div class="fixed inset-0 z-0 pointer-events-none overflow-hidden opacity-40">
                <div class="absolute bg-cyan-600/20 w-96 h-96 rounded-full -top-20 -left-20 blur-[100px]"></div>
                <div class="absolute bg-violet-600/20 w-[30rem] h-[30rem] rounded-full -bottom-20 -right-20 blur-[100px]"></div>
            </div>

            <div class="relative z-10">
                @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-slate-900 border-b border-slate-800">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
