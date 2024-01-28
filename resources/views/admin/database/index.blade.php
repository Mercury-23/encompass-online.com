@push('css')
@endpush

@push('js')
{{--    @vite('resources/js/admin/students.index.js')--}}
@endpush

<x-app-layout>

    {{--Header--}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-user-shield mr-1"></i>
            <i class="fas fa-database mr-1"></i>
            {{ __('Database') }}
        </h2>
    </x-slot>

    {{--Admin Nav--}}
    @include('admin.nav.admin-nav')

    {{--Vue App--}}
    <div id="vue-app" class="py-2">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container py-2">
                    <div class="row">
                        <h3>
                            <i class="fas fa-database mr-1"></i>
                            Database
                        </h3>

                        <div>
                            <img src="{{ asset('/img/abstract-coming-soon-halftone-style-background-design_1017-27282.avif') }}" alt="Coming Soon" class="w-full">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
