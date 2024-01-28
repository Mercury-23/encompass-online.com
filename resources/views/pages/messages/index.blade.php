{{--Messages Index--}}
@php
    $users = \App\Models\User::all();
@endphp

@push('css')
    @vite('resources/css/admin.index.css')
@endpush

@push('js')

    {{--jQuery--}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{--Vue--}}
    <script>
        const vueApp = Vue.createApp({
            data() {
                return {
                    message: '',
                    user_active_class: 'bg-blue-500 hover:',
                    user_selected: ''
                }
            },
            update() {
                console.log(this.message)
            },
            methods: {
                start_with(user) {
                    this.user_selected = user
                    let el = $(event.target).data('name') ? $(event.target) : $(event.target).parents("[data-name='toggleUsers']")
                    $("[data-name='toggleUsers']").removeClass(this.user_active_class)
                    el.addClass(this.user_active_class)
                }
            },
            mounted() {
            },
        });
        vueApp.mount('#vue-app');
    </script>
@endpush

<x-app-layout>

    {{--Header--}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fa-duotone fa-comments mr-1"></i>
            {{ __('Messages') }}
        </h2>
    </x-slot>

    {{--App--}}
    <div class="py-1" id="vue-app" style="height: calc(100vh - 9.5rem);">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 h-full">
            <div class="bg-white shadow-sm sm:rounded-lg flex min-h-0 h-full">

                <div class="flex w-full">

                    {{--Users--}}
                    <div class="overflow-y-auto w-64">
                        <div class="border-r border-gray-300 divide-y divide-gray-300">
                            @foreach($users as $user)
                                <a type="button" class="flex gap-4  items-center px-4 py-2 hover:opacity-50"
                                   @click="start_with({{$user}})"
                                   id="user_{{$user->id}}" data-name="toggleUsers">
                                    <div class="bg-center text-xl font-black bg-cover bg-no-repeat border-gray-400 border w-10 h-10
                                     rounded-full flex items-center justify-center text-gray-600 shadow-sm bg-gray-50">
                                        {{ strtoupper($user->name[0]) }}
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-bold truncate text-lg w-32">{{ $user->name }}</span>
                                        <span class="text-sm text-gray-500">Last message</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{--Messages--}}
                    <div class="flex flex-col flex-1 divide-y divide-gray-300">

                        {{--User Info--}}
                        <div class="flex justify-between items-center px-2">
                            <div class="flex gap-2 items-center py-2">
                                <div class="bg-center font-black bg-cover bg-no-repeat border-gray-400 border w-10 h-10
                                 rounded-full flex items-center justify-center text-gray-600 shadow-sm bg-gray-50">
                                    @{{user_selected?user_selected.name[0].toUpperCase():''}}
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-bold text-lg">
                                        @{{user_selected?user_selected.name :''}}
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        @{{user_selected?user_selected.email :''}}
                                    </span>
                                </div>
                            </div>

                            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                                    :class="!user_selected?'hidden':''"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm   p-2.5 text-center inline-flex items-center
                                     dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                <i class="fa-solid fa-ellipsis-stroke-vertical"></i>
                            </button>

                            <!-- Dropdown menu -->
                            <div id="dropdown"
                                 class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-fit dark:bg-gray-700">
                                <ul class="py-2 text-sm divide-y divide-gray-300 text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownDefaultButton">
                                    <li>
                                        <a href="#"
                                           class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            Events
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                           class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            Settings
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                           class="block px-4 text-red-500 py-2 hover:bg-red-100 dark:hover:bg-red-600 dark:hover:text-white">
                                            Block <b> @@{{user_selected?user_selected.name :''}}</b>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        {{--Messages--}}
                        <div class="flex-1">
                            @{{ message }}
                        </div>

                        {{--Message Input--}}
                        <div class="px-4 py-2">
                            <label class="w-100">
                                <input type="text"
                                       class="bg-gray-50 border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full"
                                       name="message">
                            </label>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
