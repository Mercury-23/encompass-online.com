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

    {{--Bootstrap - todo - install with npm--}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    {{--youcef--}}
    <link rel="stylesheet" href="{{ url('css/_icons.css') }}">
    <link href="{{ asset('assets/styles/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/main.css"/>
    <script src='//cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>

    @vite(['resources/css/app.css'])
    {{--todo - this is working--}}

    @stack('css')

    <style>
        html, body {
            min-height: 100vh;
            /*border: 3px solid red;*/
        }

        footer {
            position: relative;
            bottom: 0;
            width: 100%;
            padding: 1rem;
            text-align: center;
            margin-top: 2rem;
        }

        footer h3 {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: .5rem;
            text-decoration: underline;
        }

        footer a {
            margin: .5rem 0;
            font-weight: bold;
        }

        /* Mobile only */
        @media (max-width: 767px) {
            font-size: .3rem;
        }

        /* Tablet only */
        @media (min-width: 768px) and (max-width: 1024px) {
            font-size: .5rem;
        }

        /* Desktop only */
        @media (min-width: 1025px) {
            font-size: .7rem;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-100" id="vue-application">
<div class="flex flex-col flex-1 relative">

    {{--Navigation--}}
    <div>
        @include('layouts.navigation')
    </div>

    {{--Header--}}
    @if ( isset($header) )
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    {{--Spinner--}}
    {{--    <div class="flex justify-center pt-5 h-screen main-spinner">--}}
    {{--        <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 border-gray-900"></div>--}}
    {{--    </div>--}}

    {{--Main--}}
    <main class="">
        {{ $slot }}
    </main>
</div>

{{--Footer--}}
{{--@include('layouts.footer')--}}

{{--todo - this breaking navigation???--}}
<script src="//code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"
        crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="//cdn.tailwindcss.com"></script>


@vite(['resources/js/app.js'])
@vite('resources/js/utils.js')
@stack('js')
</body>
</html>
