@push('css')
    @vite('resources/css/admin.index.css')
    <style>
    </style>
@endpush

@push('js')
    <script>
    </script>
@endpush

<x-app-layout>
    {{--Header--}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-user-shield mr-1"></i>
            <i class="fas fa-calendar-alt mr-1"></i>
            {{ __('Invoices') }}
        </h2>
    </x-slot>

    {{--Admin Nav--}}
    @include('admin.nav.admin-nav')

    {{--Vue App--}}
    <div id="vue-app" class="py-2">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container">

                    {{--Create Form--}}
                    @include('admin.invoices.form', [
                        'teachers' => $teachers,
                        'students' => $students,
                        'instruments' => $instruments,
                        'durations' => $durations,
                        'rates' => $rates,
                    ])

                    {{--Table - todo--}}
                    {{--Table - todo--}}
                    {{--Table - todo--}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
