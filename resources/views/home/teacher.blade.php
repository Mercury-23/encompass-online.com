@push('css')
    @vite('resources/css/home.css')
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
    <div class="!pt-4" id="vue-app-teacher">

        <div class="container ">
            <div class="bg-white shadow-sm rounded !p-4">

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
{{--                        @include('home.partials.calendar.blade.vue')--}}

                        <div class="dark:bg-slate-900 bg-gray-100 rounded-lg !p-4 flex flex-col !gap-4">
                            <div class="flex flex-wrap !gap-2 align-items-end  justify-between">
                                <h2 class="text-xl font-extrabold dark:text-white">
                                    <i class="fa-duotone fa-calendar-check mr-1"></i>
                                    {{ __('Calendar') }}</h2>
                                <div class=" ">
                                </div>
                            </div>
                            <hr class=" border-gray-500">
                            <div class="flex flex-col !gap-4">
                                <calendar ></calendar>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>

    </div>
</x-app-layout>
