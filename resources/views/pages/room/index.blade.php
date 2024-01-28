{{--Rooms.index--}}
@push('css')
    @vite('resources/css/admin.index.css')
@endpush

@push('js')
    <script>
    </script>
@endpush

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fa-duotone fa-door-open mr-1"></i>
            {{ __('Rooms') }}
        </h2>
    </x-slot>

    <div class="py-1" id="vue-app">
        <div class="container mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <h3>
                    <i class="fa-duotone fa-door-open mr-1"></i>
                    {{ __('Rooms') }}
                </h3>
                <img src="{{ asset('/img/abstract-coming-soon-halftone-style-background-design_1017-27282.avif') }}"
                     alt="Coming Soon" class="w-full">
            </div>
        </div>
    </div>
</x-app-layout>
