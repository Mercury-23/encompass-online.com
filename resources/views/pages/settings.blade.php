@push('css')
    <style>
    </style>
@endpush

@push('js')

@endpush

<x-app-layout>

    {{--Header--}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fa-solid fa-gears mr-1"></i>
            {{ __('Settings') }}
        </h2>
    </x-slot>

    {{--App--}}
    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>
                        <i class="fa-solid fa-gears mr-1"></i>
                        {{ __('Settings') }}
                    </h3>

                    <div>
                        <img src="{{ asset('/img/abstract-coming-soon-halftone-style-background-design_1017-27282.avif') }}" alt="Coming Soon" class="w-full">
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
