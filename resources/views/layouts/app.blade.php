<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    {{--Animate.css--}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
          integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.css"/>
    <link rel="stylesheet" href="/css/data-tables.css"/>

    {{--Bootstrap - todo - install with npm--}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    {{--youcef--}}
    <link rel="stylesheet" href="{{ url('css/_icons.css') }}">
    <link href="{{ asset('assets/styles/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/main.css"/>

    @vite(['resources/css/app.css'])
    @stack('css')
    <style></style>
</head>

<body class="font-sans antialiased bg-gray-100">
<div class="flex flex-col flex-1 relative">

    {{--Navigation--}}
    @include('layouts.navigation')

    {{--Header--}}
    @if ( isset($header) )
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    {{--Main--}}
    <main>
        {{ $slot }}
    </main>
</div>

{{--<script src="//code.jquery.com/jquery-3.7.1.min.js"></script>--}}
{{--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>--}}

{{--<script src="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"--}}
{{--        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"--}}
{{--        crossorigin="anonymous"></script>--}}

{{--<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"--}}
{{--        crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}

{{--<script src="//cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"--}}
{{--        crossorigin="anonymous"  referrerpolicy="no-referrer"></script>--}}

{{--<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>--}}

<script src="//cdn.tailwindcss.com"></script>
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

@vite(['resources/js/app.js'])
@vite('resources/js/utils.js')

@stack('js')

</body>
</html>
