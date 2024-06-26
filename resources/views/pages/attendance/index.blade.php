<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fa-duotone fa-book-open-cover mr-1 text-2xl"></i>
            {{ __('Attendance') }}
        </h2>
    </x-slot>

    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>
                        <i class="fa-duotone fa-book-open-cover mr-1 text-2xl"></i>
                        {{ __('Attendance') }}
                    </h3>
                    <img src="{{ asset('/img/abstract-coming-soon-halftone-style-background-design_1017-27282.avif') }}" alt="Coming Soon" class="w-full">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
