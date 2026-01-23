<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ecommerce') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div
        class="relative min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0
        bg-gradient-to-br from-[#000000] via-[#15a5ed] to-[#ffffff] overflow-hidden">

        <!-- 左右背景大字 -->
        <div class="pointer-events-none absolute inset-0 flex items-center justify-between px-24">
            <!-- 左：EXTECH -->
            <div
                class="text-[14rem] sm:text-[8rem] font-extrabold tracking-[0.18em]
                       text-white/5 select-none whitespace-nowrap">
                EXTECH
            </div>

            <!-- 右：STUDIO -->
            <div
                class="text-[14rem] sm:text-[8rem] font-extrabold tracking-[0.18em]
                       text-white/5 select-none whitespace-nowrap">
                STUDIO
            </div>
        </div>

        <!-- 内容（登录卡片） -->
        <div class="relative w-full sm:max-w-md mt-6 px-6 py-4 sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>


</html>
