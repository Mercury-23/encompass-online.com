<?php

use Carbon\Carbon;
extract($data);
// Get the start date of the last month
$startDate = Carbon::now()->startOfMonth();

// Get the end date of the last month
$endDate = Carbon::now()->endOfMonth();

$lessons_by_week = $lessons->groupBy(function ($lesson) {
    return Carbon::parse($lesson->created_at)->startOfWeek()->format('Y-m-d');
});

$thisMonthLessons = $lessons->filter(function ($lesson) use ($startDate, $endDate) {

    return Carbon::parse($lesson->created_at)->between($startDate, $endDate);
});
$lessons_by_week_status = $lessons_by_week->map(function ($lessons) {
    $completed_count = $lessons->where('completed', 1)->count();
    $not_completed_count = $lessons->where('completed', 0)->count();
    $canceled_count = $lessons->where('completed', 2)->count();
    return [
        'completed' => $completed_count,
        'notCompleted' => $not_completed_count,
        'canceled' => $canceled_count
    ];
});
$all_revenu =$lessons->filter(function ($lesson) {
    return $lesson->completed === 1;
})->sum('price');
$this_month_revenu = $thisMonthLessons->filter(function ($lesson) {
    return $lesson->completed === 1;
})->sum('price');

?>
@push('js')
    <script src="//cdn.jsdelivr.net/npm/chart.js"></script>
    <script >
        document.addEventListener('DOMContentLoaded', function () {
            let $lessons_by_week = @json($lessons_by_week );
            let $lessons_by_week_status = @json($lessons_by_week_status)


                // initRevenueByMonthChart();
                //
                lessons_by_week()
            lessons_by_week_status()

            function lessons_by_week_status() {
                const chartEl = document.getElementById('lessons_by_week_status_chart');

                new Chart(chartEl, {
                    type: 'bar',
                    data: {
                        labels: Object.keys($lessons_by_week_status),
                        datasets: [
                            {
                                label: 'lessons completed',
                                data: Object.values($lessons_by_week_status).map((r) => r.completed),
                            },
                            {
                                label: 'Lessons not completed ',
                                data: Object.values($lessons_by_week_status).map((r) => r.notCompleted),
                            },
                            {
                                label: 'Lessons canceled',
                                data: Object.values($lessons_by_week_status).map((r) => r.canceled),
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                    }

                });
            }

            function lessons_by_week() {
                const chartEl = document.getElementById('lessons_by_week-chart');
                new Chart(chartEl, {
                    type: 'line',
                    data: {
                        labels: Object.keys($lessons_by_week),
                        datasets: [{
                            label: 'Lessons',
                            data: Object.values($lessons_by_week).map((r) => r.length),
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                    }

                });
            }
        })
    </script>
@endpush

<x-app-layout >

    {{--Header--}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-user-shield mr-1"></i>
            <i class="fas fa-tachometer-alt mr-1"></i>
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    {{--Admin Nav--}}
    @include('admin.nav.admin-nav')

    {{--Vue App--}}
    <div class="max-w-7xl mx-auto sm:px-1 lg:px-1 !pt-4" id="vue-app-admin-dashboard">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
            <div class="container text-gray-900 px-1 grid lg:grid-cols-8 grid-cols-1 !gap-4 !p-4">

                <div class="col-span-full">
                    <div class="flex justify-center items-center !gap-4 ">
                        <div class="flex !gap-4 border border-gray-300 rounded-lg shadow !p-4 !px-6">
                            <div class="flex justify-center items-center">
                                <div class="text-7xl font-extrabold ...">
                                    <p class="bg-clip-text text-transparent bg-gradient-to-b from-blue-400 to-cyan-300">
                                        <i class="fa fa-dollar"></i>
                                    </p>
                                </div>
                            </div>
                            <div class="flex justify-center items-center flex-col !gap-2">
                               <span class="text-gray-400 font-semibold"> All revenue </span>
                                <div class="text-2xl font-extrabold ...">
                                    <p class="bg-clip-text text-transparent bg-gradient-to-b from-green-500 to-cyan-500">
                                        {{$all_revenu}}$
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="flex !gap-4 border border-gray-300 rounded-lg shadow !p-4 !px-6">
                            <div class="flex justify-center items-center">
                                <div class="text-7xl font-extrabold ...">
                                    <p class="bg-clip-text text-transparent bg-gradient-to-b from-red-400 to-rose-500">
                                        <i class="fa fa-money-bill-alt"></i>
                                    </p>
                                </div>
                            </div>
                            <div class="flex justify-center items-center flex-col !gap-2">
                                <span class="text-gray-400 font-semibold">This month revenue</span>
                                <div class="text-2xl font-extrabold ...">
                                    <p class="bg-clip-text text-transparent bg-gradient-to-b from-green-500 to-cyan-500">
                                        {{$this_month_revenu}}$
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--Revenue--}}
                <div class="col-span-4">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-calendar-check mr-1"></i>
                            {{ __('Lessons per Week') }}
                        </div>
                        <div class="card-body">
                                <span
                                    class="badge  align-items-center p-1 pe-2 text-success-emphasis bg-success-subtle border border-success-subtle rounded-pill">
                                    +$100
                                </span>
                            <span
                                class="badge  align-items-center p-1 pe-2 text-success-emphasis bg-success-subtle border border-success-subtle rounded-pill">
                                    +2.3%
                                </span>
                            <div>
                                <canvas id="lessons_by_week-chart" height="120"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                {{--Lessons--}}
                <div class="col-span-4">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-list-check mr-1"></i>
                            {{ __('Lessons status per Week') }}
                        </div>
                        <div class="card-body">

                            <div>
                                <canvas id="lessons_by_week_status_chart" height="120"></canvas>
                            </div>
                        </div>
                    </div>
                </div>


                {{--Users, Teachers, Parents, Students--}}


                <div class="col-span-4 grid lg:grid-cols-4 grid-cols-2 !gap-4 ">
                    {{--Teachers--}}
                    <div class="lg:col-span-2">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-chalkboard-teacher mr-1"></i>
                                {{ __('Teachers') }}
                            </div>
                            <div class="card-body">
                                <div class="flex justify-center items-center">
                                    <div class="text-8xl font-extrabold ...">
                                        <p class="bg-clip-text text-transparent bg-gradient-to-b from-red-500 to-orange-500">

                                            {{$users->where('type', 'teacher')->count()}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--Parents--}}
                    <div class="lg:col-span-2">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-user-friends mr-1"></i>
                                {{ __('Parents') }}
                            </div>
                            <div class="card-body">
                                <div class="flex justify-center items-center">
                                    <div class="text-8xl font-extrabold ...">
                                        <p class="bg-clip-text text-transparent bg-gradient-to-r from-pink-500 to-violet-500">

                                            {{$users->where('type', 'parent')->count()}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--Students--}}
                    <div class="lg:col-span-2">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-user-graduate mr-1"></i>
                                {{ __('Students') }}
                            </div>
                            <div class="card-body">
                                <div class="flex justify-center items-center">
                                    <div class="text-8xl font-extrabold ...">
                                        <p class="bg-clip-text text-transparent bg-gradient-to-r from-emerald-400 to-cyan-400">

                                            {{$users->where('type', 'student')->count()}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--Calendar--}}
                <div class="col-span-4 row-span-3">
                    <div class="">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                {{ __('Calendar') }}
                            </div>
                            <div class="card-body overflow-auto">
{{--                                <div id="admin-calendar"></div>--}}
                                <calendar :show-all-lessons="true"></calendar>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-4">
                    <div>

                    </div>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
