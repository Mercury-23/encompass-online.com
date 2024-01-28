@push('css')
    <style>
    </style>
@endpush
@push('js')
    <script src="//cdn.jsdelivr.net/npm/chart.js"></script>
    <script src='//cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
    <script>
        initRevenueByMonthChart();
        initCalendar();

        function initCalendar() {
            const calendarEl = document.getElementById('admin-calendar');
            this.calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                selectable: true,
                select: (e) => {
                    // $('#teacher-calendar-modal').find('#evtStart').val(moment(e.start).format('YYYY-MM-DD'));
                    // $('#teacher-calendar-modal').find('#evtEnd').val(moment(e.end).format('YYYY-MM-DD'));
                    // $('#teacher-calendar-modal').modal('show');
                },
                events: this.Events
            });
            this.calendar.render();
            // $('#submit_event').on('click', this.EventHandler)
        }

        function initRevenueByMonthChart() {
            const revenueByMonthChart = document.getElementById('revenue-by-month-chart');
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            const monthlyRevenue = [5000, 6000, 5500, 6500, 7000, 7500, 8000, 7500, 7200, 6800, 7000, 7500];

            new Chart(revenueByMonthChart, {
                type: 'line',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Monthly Revenue',
                        data: monthlyRevenue,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2
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

            // todo -
            // loop all test charts
            const testCharts = document.querySelectorAll('.test-chart');
            testCharts.forEach((testChart) => {
                new Chart(testChart, {
                    type: 'line',
                    data: {
                        labels: months,
                        datasets: [{
                            label: 'Monthly Revenue',
                            data: monthlyRevenue,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 2
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
            });
        }
    </script>


    {{--todo - only load this where needed--}}
    {{--<script src="//cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>--}}
    {{--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>--}}
    {{--todo - inputmask are conflicting, can only include one--}}
    {{--    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js" ></script>--}}
    {{--<script src="{{ asset('/assets/plugins/phone-masking/inputmask.js') }}"></script>--}}
    {{--todo - fix these ^^^^--}}


    {{--    // todo - move this to config--}}
    {{--<script>--}}
    {{--    tailwind.config = {--}}
    {{--        darkMode: 'class',--}}
    {{--        blocklist: [--}}
    {{--            'collapse',--}}
    {{--        ],--}}
    {{--    }--}}
    {{--</script>--}}



    {{--todo - where is this being used?--}}
    {{--    <link href="//cdn.jsdelivr.net/npm/intl-tel-input@16.0.3/build/css/intlTelInput.css" rel="stylesheet">--}}
    {{--todo - only load where needed--}}
    {{--    <link href="//cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet"/>--}}

@endpush

<x-app-layout>

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
    <div class="max-w-7xl mx-auto sm:px-1 lg:px-1">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="container text-gray-900 px-1">

                {{--Revenue and Lessons--}}
                <div class="row">
                    {{--Revenue--}}
                    <div class="col mt-1">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-dollar-sign mr-1"></i>
                                {{ __('Revenue') }}
                                <span class="float-right badge bg-success">
                                    ${{ 650 ?? __('No Data') }}
                                </span>
                            </div>
                            <div class="card-body">
                                <span
                                    class="badge  align-items-center p-1 pe-2 text-success-emphasis bg-success-subtle border border-success-subtle rounded-pill">
                                    +$100
                                </span>
                                <span class="badge  align-items-center p-1 pe-2 text-success-emphasis bg-success-subtle border border-success-subtle rounded-pill">
                                    +2.3%
                                </span>
                                <div>
                                    <canvas id="revenue-by-month-chart" height="120"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--Lessons--}}
                    <div class="col my-1">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                {{ __('Lessons') }}
                                <span class="float-right badge bg-secondary">
                                        {{ 33 ?? __('No Data') }}
                                    </span>
                            </div>
                            <div class="card-body">
                                <span
                                    class="badge  align-items-center p-1 pe-2 text-success-emphasis bg-secondary-subtle border border-success-subtle rounded-pill">
                                    +2.3%
                                </span>
                                <div>
                                    <canvas class="test-chart" height="120"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--Users, Teachers, Parents, Students--}}
                <div class="row">
                    {{--Users--}}
                    <div class="col col-md-6 col-lg-3 my-1">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-users mr-1"></i>
                                {{ __('Users') }}
                                <span class="float-right badge bg-secondary">
                                    <i class="fas fa-users mr-1"></i>
                                        {{ 33 ?? __('No Data') }}
                                    </span>
                            </div>
                            <div class="card-body">
                                <span
                                    class="badge  align-items-center p-1 pe-2 text-success-emphasis bg-secondary-subtle border border-success-subtle rounded-pill">
                                    +2.3%
                                </span>
                                <div>
                                    <canvas class="test-chart" height="120"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--Teachers--}}
                    <div class="col col-md-6 col-lg-3 my-1">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-chalkboard-teacher mr-1"></i>
                                {{ __('Teachers') }}
                                <span class="float-right badge bg-secondary">
                                    <i class="fas fa-chalkboard-teacher mr-1"></i>
                                        {{ 33 ?? __('No Data') }}
                                    </span>
                            </div>
                            <div class="card-body">
                                <span
                                    class="badge  align-items-center p-1 pe-2 text-success-emphasis bg-secondary-subtle border border-success-subtle rounded-pill">
                                    +2.3%
                                </span>
                                <div>
                                    <canvas class="test-chart" width="400" height="120"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--Parents--}}
                    <div class="col col-md-6 col-lg-3 my-1">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-user-friends mr-1"></i>
                                {{ __('Parents') }}
                                <span class="float-right badge bg-secondary">
                                <i class="fas fa-user-friends mr-1"></i>
                                    {{ 33 ?? __('No Data') }}
                                </span>
                            </div>
                            <div class="card-body">
                                <span
                                    class="badge  align-items-center p-1 pe-2 text-success-emphasis bg-secondary-subtle border border-success-subtle rounded-pill">
                                    +2.3%
                                </span>
                                <div>
                                    <canvas class="test-chart" width="400" height="120"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--Students--}}
                    <div class="col col-md-6 col-lg-3 my-1">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-user-graduate mr-1"></i>
                                {{ __('Students') }}
                                <span class="float-right badge bg-secondary">
                                <i class="fas fa-user-graduate mr-1"></i>
                                    {{ 33 ?? __('No Data') }}
                                </span>
                            </div>
                            <div class="card-body">
                                <span
                                    class="badge  align-items-center p-1 pe-2 text-success-emphasis bg-secondary-subtle border border-success-subtle rounded-pill">
                                    +2.3%
                                </span>
                                <div>
                                    <canvas class="test-chart" width="400" height="120"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--Calendar--}}
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                {{ __('Calendar') }}
                            </div>
                            <div class="card-body">
                                <div id="admin-calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
