{{--Dashboard--}}

@push('css')
    <style>
    </style>
@endpush

@push('js')

    {{--todo - remove, not using--}}
    {{--    <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"--}}
    {{--            integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw=="--}}
    {{--            crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}

    <script src="//cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="{{ asset('/js/dashboard.js') }}"></script>

    <script>
        const app = Vue.createApp({
            data() {
                return {
                    message: 'Hello Vue!'
                }
            }
        })

        app.mount('#vue-app')
    </script>
@endpush

<x-app-layout>

    {{--Header--}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-gauge mr-1"></i>
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{--App--}}
    <div class="py-1" id="vue-app">

        <div class="container p-1">
            <div class="bg-white shadow-sm rounded p-1">
                {{--Youcef Charts--}}
                <div class="row">
                    <div class="col">

                        <div class="overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="text-gray-900">

                                {{--Boxes At Top --}}
                                <div class="grid grid-cols-6 mb-1">
                                    <div class="col-span-full">
                                        <div class="flex flex-wrap justify-center">
                                            <div
                                                class="shadow border rounded-xl flex !p-4">
                                                <div class="flex justify-center items-center">
                                                    <div class="text-2xl font-extrabold">
                                                        <p class="bg-clip-text text-transparent bg-gradient-to-r from-pink-500 to-violet-500">
                                                            <i class="fa fa-trophy-alt"></i>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col">
                                                    <div>
                                                        <div class="font-bold text-center">
                                                            <p class="bg-clip-text text-transparent bg-gradient-to-r from-pink-500 to-violet-500">
                                                                32</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex">
                                                        <div class="flex flex-col text-center font-bold">
                                                            <p class="dark:text-gray-400 text-gray-500 text-xs">
                                                                Guitar</p>
                                                            <span>44</span>
                                                        </div>
                                                        <div class="flex flex-col text-center font-bold">
                                                            <p class="dark:text-gray-400 text-gray-500 text-xs">
                                                                Singing</p>
                                                            <span>56</span>
                                                        </div>
                                                        <div class="flex flex-col text-center font-bold">
                                                            <p class="dark:text-gray-400 text-gray-500 text-xs">
                                                                Drum</p>
                                                            <span>20</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="shadow border rounded-xl flex !p-4">
                                                <div class="flex justify-center items-center">
                                                    <div class="text-2xl font-extrabold">
                                                        <p class="bg-clip-text text-transparent bg-gradient-to-r from-cyan-500 to-emerald-500">
                                                            <i class="fa-thin fa-money-bill-trend-up"></i>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col items-center justify-center">
                                                    <div>
                                                        <div class="text-2xl font-bold text-center">
                                                            <p class="bg-clip-text text-transparent bg-gradient-to-r from-cyan-500 to-emerald-500">
                                                                8000 $</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="shadow border rounded-xl flex !p-4">
                                                <div class="flex justify-center items-center">
                                                    <div class="text-2xl font-extrabold">
                                                        <p class="bg-clip-text text-transparent bg-gradient-to-r from-cyan-500 to-emerald-500">
                                                            <i class="fa-thin fa-money-bill-trend-up"></i>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col items-center justify-center">
                                                    <div>
                                                        <div class="text-2xl font-bold text-center">
                                                            <p class="bg-clip-text text-transparent bg-gradient-to-r from-cyan-500 to-emerald-500">
                                                                8000 $</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="shadow border rounded-xl flex !p-4">
                                                <div class="flex justify-center items-center">
                                                    <div class="text-2xl font-extrabold">
                                                        <p class="bg-clip-text text-transparent bg-gradient-to-r from-cyan-500 to-emerald-500">
                                                            <i class="fa-thin fa-money-bill-trend-up"></i>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col items-center justify-center">
                                                    <div>
                                                        <div class="text-2xl font-bold text-center">
                                                            <p class="bg-clip-text text-transparent bg-gradient-to-r from-cyan-500 to-emerald-500">
                                                                8000 $</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{--Charts: Guitar Lessons, Student Enrollment, Revenue--}}
                                <div class="row">

                                    {{--Guitar Lessons--}}
                                    <div class="col-sm-6 col-md-6 col-lg-4 mt-2">
                                        <div
                                            class="bg-gray-200 rounded-lg flex flex-col p-2">
                                            <div class="flex flex-wrap items-center">
                                                <p class="font-bold">Guitar Lessons</p>
                                            </div>
                                            <hr class="dark:border-gray-600">
                                            <div>
                                                <canvas id="guitar-week-lessons-chart"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                    {{--Student Enrollment--}}
                                    <div class="col-sm-6 col-md-6 col-lg-4 mt-2">
                                        <div
                                            class="bg-gray-200 rounded-lg flex flex-col p-2">
                                            <div class="flex flex-wrap items-center">
                                                <p class="font-bold">Student Enrollment</p>
                                            </div>
                                            <hr class="dark:border-gray-600">
                                            <div>
                                                <canvas id="student-enrollment-chart"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                    {{--Revenue--}}
                                    <div class="col-sm-6 col-md-12 col-lg-4 mt-2">
                                        <div
                                            class="bg-gray-200 rounded-lg flex flex-col p-2">
                                            <div class="flex flex-wrap items-center">
                                                <p class="font-bold">Revenue</p>
                                            </div>
                                            <div>
                                                <canvas id="revenue-by-month-chart"
                                                        {{--                                                            height="100"--}}
                                                        style="max-height: 250px !important;"
                                                ></canvas>
                                            </div>
                                        </div>
                                    </div>

                                    {{--Table: Class Name, Active Students, Teachers, Revenue/Coast (per month)--}}
                                    <div class="col-sm-6 col-md-12 col-lg-12 mt-2">
                                        <div class="bg-gray-200 rounded-lg flex flex-col p-2">
                                            <div class="flex-1 overflow-auto rounded-t-lg">
                                                <table class="w-full text-left border-collapse table-auto">
                                                    <thead>
                                                    <tr class="text-xs uppercase dark:text-slate-100 bg-gray-100/40 dark:bg-gray-400/50">

                                                        <th class="font-semibold bg-gray-300/75 dark:bg-gray-900/75 backdrop-blur shadow-sm px-2">
                                                            Class Name
                                                        </th>
                                                        <th class="font-semibold bg-gray-300/75 dark:bg-gray-900/75 backdrop-blur shadow-sm px-2">
                                                            Active Students
                                                        </th>
                                                        <th class="font-semibold bg-gray-300/75 dark:bg-gray-900/75 backdrop-blur shadow-sm px-2">
                                                            Teachers
                                                        </th>
                                                        <th class="font-semibold bg-gray-300/75 dark:bg-gray-900/75 backdrop-blur shadow-sm px-2">
                                                            Revenue/Coast (per month)
                                                        </th>
                                                    </tr>
                                                    </thead>


                                                    <tbody>
                                                    <tr class="last:border-none border-b text-sm hover:dark:bg-gray-300 hover:bg-gray-100 border-gray-200 even:bg-transparent odd:bg-gray-200 odd:dark:bg-gray-300 dark:border-gray-500 text-gray-700 cursor-pointer">
                                                        <td class="p-1 hover:dark:bg-gray-600/50 hover:bg-gray-300/80">
                                                            <div class="bg-cover bg-center">
                                                                Drum
                                                                <a href="/student/7" target="_blank">
                                                                    <i class="fa fa-up-right-from-square text-blue-500"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <td class="hover:dark:bg-gray-600/50 hover:bg-gray-300/80 w-20">
                                                            <div class="text-center">8</div>
                                                        </td>
                                                        <td class="p-1 hover:dark:bg-gray-600/50 hover:bg-gray-300/80">
                                                            <div class="text-center">5</div>
                                                        </td>
                                                        <td class="p-1 hover:dark:bg-gray-600/50 hover:bg-gray-300/80">
                                                            <div class="font-bold">
                                                                <span class="text-green-500">1200$</span>
                                                                ▪
                                                                <span class="text-red-500">500$</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="last:border-none border-b text-sm hover:dark:bg-gray-300 hover:bg-gray-100 border-gray-200 even:bg-transparent odd:bg-gray-200 odd:dark:bg-gray-300 dark:border-gray-500 text-gray-700 cursor-pointer">
                                                        <td class="p-1 hover:dark:bg-gray-600/50 hover:bg-gray-300/80">
                                                            <div class="bg-cover bg-center"> Guitar
                                                                <a href="/student/8" target="_blank">
                                                                    <i class="fa fa-up-right-from-square text-blue-500"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <td class="hover:dark:bg-gray-600/50 hover:bg-gray-300/80 w-20">
                                                            <div class="text-center">9</div>
                                                        </td>
                                                        <td class="p-1 hover:dark:bg-gray-600/50 hover:bg-gray-300/80">
                                                            <div class="text-center">6</div>
                                                        </td>
                                                        <td class="p-1 hover:dark:bg-gray-600/50 hover:bg-gray-300/80">
                                                            <div class="font-bold">
                                                                <span class="text-green-500">722.22$</span>
                                                                ▪
                                                                <span
                                                                    class="text-red-500">338.89$</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="last:border-none border-b text-sm hover:dark:bg-gray-300 hover:bg-gray-100 border-gray-200 even:bg-transparent odd:bg-gray-200 odd:dark:bg-gray-300 dark:border-gray-500 text-gray-700 cursor-pointer">
                                                        <td class="p-1 hover:dark:bg-gray-600/50 hover:bg-gray-300/80">
                                                            <div class="bg-cover bg-center">
                                                                Piano
                                                                <a href="/student/10" target="_blank">
                                                                    <i class="fa fa-up-right-from-square text-blue-500"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <td class="hover:dark:bg-gray-600/50 hover:bg-gray-300/80 w-20">
                                                            <div class="text-center">1</div>
                                                        </td>
                                                        <td class="p-1 hover:dark:bg-gray-600/50 hover:bg-gray-300/80">
                                                            <div class="text-center">1</div>
                                                        </td>
                                                        <td class="p-1 hover:dark:bg-gray-600/50 hover:bg-gray-300/80">
                                                            <div class="font-bold">
                                                                <span class="text-green-500">1701.43$</span>
                                                                ▪
                                                                <span class="text-red-500">1528.53$</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="last:border-none border-b text-sm hover:dark:bg-gray-300 hover:bg-gray-100 border-gray-200 even:bg-transparent odd:bg-gray-200 odd:dark:bg-gray-300 dark:border-gray-500 text-gray-700 cursor-pointer">
                                                        <td class="p-1 hover:dark:bg-gray-600/50 hover:bg-gray-300/80">
                                                            <div class="bg-cover bg-center">
                                                                Violin
                                                                <a href="/student/10" target="_blank">
                                                                    <i class="fa fa-up-right-from-square text-blue-500"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <td class="hover:dark:bg-gray-600/50 hover:bg-gray-300/80 w-20">
                                                            <div class="text-center">6</div>
                                                        </td>
                                                        <td class="p-1 hover:dark:bg-gray-600/50 hover:bg-gray-300/80">
                                                            <div class="text-center">4</div>
                                                        </td>
                                                        <td class="p-1 hover:dark:bg-gray-600/50 hover:bg-gray-300/80">
                                                            <div class="font-bold">
                                                                <span class="text-green-500">701.43$</span>
                                                                ▪
                                                                <span class="text-red-500">428.53$</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>

                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                {{--Simple Charts--}}
                <div class="p-2 mt-2 text-gray-900 border rounded">
                    <h3 class="mb-3">
                        <i class="fas fa-gauge"></i>
                        {{ __('Dashboard') }}
                    </h3>
                    <div class="container">
                        <div class="row">

                            {{--Drum Lessons--}}
                            <div class="col-12 col-md-6 mb-1 p-1">
                                <div class="card">
                                    <div class="card-header">
                                        <i class="fa-solid fa-drum mr-1"></i>
                                        Drum Lessons
                                    </div>
                                    <div class="card-body bg-gray-100 p-1">
                                        <canvas id="drum-week-lessons-chart" class=""></canvas>
                                    </div>
                                </div>
                            </div>

                            {{--Singing Lessons--}}
                            <div class="col-12 col-md-6 mb-1 p-1">
                                <div class="card">
                                    <div class="card-header">
                                        <i class="fa-solid fa-microphone-lines mr-1"></i>
                                        Singing Lessons
                                    </div>
                                    <div class="card-body bg-gray-100 p-1">
                                        <canvas id="singing-week-lessons-chart"></canvas>
                                    </div>
                                </div>
                            </div>

                            {{--Piano Lessons--}}
                            <div class="col-12 col-md-6 mb-1 p-1">
                                <div class="card">
                                    <div class="card-header">
                                        <i class="fa-solid fa-guitar mr-1"></i>
                                        Piano Lessons
                                    </div>
                                    <div class="card-body bg-gray-100 p-1">
                                        <canvas id="piano-week-lessons-chart"></canvas>
                                    </div>
                                </div>
                            </div>

                            {{--Violin Lessons--}}
                            <div class="col-12 col-md-6 mb-1 p-1">
                                <div class="card">
                                    <div class="card-header">
                                        <i class="fa-solid fa-guitar mr-1"></i>
                                        Violin Lessons
                                    </div>
                                    <div class="card-body bg-gray-100 p-1">
                                        <canvas id="violin-week-lessons-chart"></canvas>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
