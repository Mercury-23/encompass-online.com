@push('css')
{{--    <link--}}
{{--        href="https://cdn.datatables.net/v/bs5/dt-1.13.8/date-1.5.1/fc-4.3.0/fh-3.4.0/sc-2.3.0/sl-1.7.0/datatables.min.css"--}}
{{--        rel="stylesheet">--}}

    @vite('resources/css/home.css')

    <style>
    </style>
@endpush

@push('js')

{{--    <script--}}
{{--        src="//cdn.datatables.net/v/bs5/dt-1.13.8/date-1.5.1/fc-4.3.0/fh-3.4.0/sc-2.3.0/sl-1.7.0/datatables.min.js"></script>--}}

    <script>
        // const vueApp = Vue.createApp({
        //     data() {
        //     },
        //     methods: {
        //         EventHandler() {
        //         },
        //     },
        //     mounted() {
        //     },
        // });
        // vueApp.mount('#vue-app');
    </script>
@endpush

<x-app-layout>

    {{--Header--}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fa-duotone fa-home mr-1"></i>
            {{ __('Home') }}
            <span>Teacher</span>
        </h2>
    </x-slot>

    {{--App--}}
    <div class="py-1" id="vue-app">

        <div class="container p-1">
            <div class="bg-white shadow-sm rounded p-1">

                <div class="row">

                    <div class="col-xs-12 col-md-6 col-lg-8">
                        <div class="row">

                            {{--User Info--}}
                            <div class="col-12 col-md-12 col-lg-6 mb-2 d-none d-md-block">
                                @include('home.partials.user-info')
                            </div>

                            {{--Logo--}}
                            <div class="col-xs-12 col-md-6 mb-2 d-none d-lg-block">
                                @include('home.partials.logo')
                            </div>

                            {{--Lessons--}}
                            <div class="col-12 col-md-12 col-lg-6 mb-2">
                                @include('home.partials.lessons')
                            </div>

                            {{--todo - Messages--}}
                            <div class="col-12 col-md-12 col-lg-6 mb-2">
                                @include('home.partials.messages')
                            </div>
                        </div>
                    </div>

                    {{--Financials--}}
                    <div class="col-xs-12 col-md-6 col-lg-4 mb-2">
                        @include('home.partials.financials')
                    </div>
                </div>

                {{--Calendar--}}
                <div class="row mb-2">
                    <div class="col">
                        @include('home.partials.calendar')
                    </div>
                </div>

            </div>
        </div>

    </div>
</x-app-layout>
