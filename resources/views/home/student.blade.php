@php use Carbon\Carbon; @endphp

<x-app-layout>

    {{--Header--}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fa-duotone fa-home mr-1"></i>
            {{ __('Student\'s Home') }}
        </h2>
    </x-slot>

    {{--App--}}
    <div class="py-1" id="vue-app" >
        <div class="container p-1" >
            <div class="bg-white shadow-sm rounded p-2">
                <div class="row">
                    {{--User Info--}}
                    <div class="col-xs-12 col-md-4">
                        @include('home.partials.user-info')
                    </div>
                    {{--Logo--}}
                    <div class="col-xs-12 col-md-4">
                        <div class="border rounded text-center m-1">
                            <div class="text-center">
                                <span id="dateTime" class="text-2xl"></span>

                                <p>
                                    {{ Carbon::now()->format('Y-m-d H:i:s') }}
                                </p>
                            </div>
                            <i class="fa-brands fa-slack display-1"></i>
                        </div>
                    </div>

                    {{--Financials--}}
                    <div class="col-xs-12 col-md-4">
                        <div class="card">
                            <h5 class="card-header">
                                <i class="fas fa-money-bill mr-1"></i>
                                Finance
                            </h5>
                            <div class="card-body">

                                <div class="financial-cards mt-2">
                                    <div class="card daily-income">
                                        <h5 class="card-header">
                                            <i class="fa-solid fa-calendar-day mr-1"></i>
                                            Daily
                                        </h5>
                                        <div class="card-body">
                                            <div class="amount">$ 256.00</div>
                                            <div class="change positive">
                                                <i class="fa-solid fa-arrow-up"></i> 5% from yesterday
                                            </div>
                                            <div class="projection">
                                                Tomorrow's Projection: $ 260.00
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="financial-cards">
                                    <div class="card daily-income">
                                        <h5 class="card-header">
                                            <i class="fa-solid fa-calendar-day mr-1"></i>
                                            Daily
                                        </h5>
                                        <div class="card-body">
                                            <div class="amount">$ 256.00</div>
                                            <div class="change positive">
                                                <i class="fa-solid fa-arrow-up"></i> 5% from yesterday
                                            </div>
                                            <div class="projection">
                                                Tomorrow's Projection: $ 260.00
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Similar structure for weekly and monthly cards -->
                                </div>



                                {{--Daily, Weekly, Monthly income--}}
                                <div class="flex flex-col-3 gap-1">
                                    <div class="card">
                                        <h5 class="card-header">
                                            <i class="fa-solid fa-calendar mr-1"></i>
                                            Daily
                                        </h5>
                                        <div class="card-body">
                                            $ 0.00
                                        </div>
                                    </div>
                                    <div class="card">
                                        <h5 class="card-header">
                                            <i class="fa-solid fa-calendar mr-1"></i>
                                            Weekly
                                        </h5>
                                        <div class="card-body">
                                            $ 0.00
                                        </div>
                                    </div>
                                    <div class="card">
                                        <h5 class="card-header">
                                            <i class="fa-solid fa-calendar mr-1"></i>
                                            Monthly
                                        </h5>
                                        <div class="card-body">
                                            $ 0.00
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>
                </div>


                <hr>
                <hr>
                <hr>
                <h3>Todo</h3>
                <h3>Todo</h3>
                <h3>Todo</h3>
                <hr>
                <hr class="mb-7">


                {{--todo - old--}}
                {{--todo - old--}}
                {{--todo - old--}}
                <div class="grid lg:grid-cols-6 gap-4">

                    <div class=" col-span-2">

                        <div class="card">
                            <h5 class="card-header">
                                <i class="fas fa-user-circle mr-1"></i>
                                {{ $user->name }}
                                <i class="fas fa-chalkboard-teacher float-right"></i>
                            </h5>
                            <div class="card-body">
                                <p class="text-lg font-bold">
                                    <i class="fa-duotone fa-user mr-1"></i>
                                    {{ $user->name }}
                                </p>

                                <p class="font-bold text-gray-500">
                                    <i class="fa-duotone fa-envelope mr-1"></i>
                                    {{ $user->email }}
                                </p>

                                <p class="font-bold text-gray-500 float-right">
                                    <i class="fa-duotone fa-phone mr-1"></i>
                                    {{ $user->phone_number }}
                                </p>

                                {{--Member Since--}}
                                <p class="font-bold text-xs text-gray-500">
                                    <i class="fa-duotone fa-calendar mr-1"></i>
                                    {{ __('Member Since') }}
                                    {{ $user->created_at->format('M d, Y') }}
                                </p>

                                {{--Member Since--}}
                                <p class="font-bold text-xs text-gray-500">
                                    <i class="fa-duotone fa-calendar mr-1"></i>
                                    {{ __('Member Since') }}
                                    {{ $user->created_at->format('M d, Y') }}
                                </p>
                            </div>
                        </div>

                    </div>

                    <div class=" col-span-2 flex flex-col gap-4 items-center justify-center">
                        <div>
                            <span id="dateTime" class="text-2xl"></span>
                        </div>
                        <i class="fa-brands fa-slack display-1"></i>
                    </div>

                    <div class="col-span-2">
                        <div class="flex flex-col gap-4">
                            <div class="card">
                                <h5 class="card-header">
                                    <i class="fa-solid fa-money-bill mr-1"></i>
                                    Finance
                                </h5>
                                <div class="card-body">
                                    <img
                                        src="{{ asset('/img/coming-soon.jpg') }}"
                                        alt="Coming Soon"
                                        class="w-full rounded">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-4">
                        <div class="card">
                            <h5 class="card-header">
                                <i class="fa-solid fa-calendar-alt mr-1"></i>
                                Lessons Schedule
                            </h5>
                            <div class="card-body">
                                <div id="teacher-calendar"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-2">
                        <div class="card">
                            <h5 class="card-header">
                                <i class="fa-solid fa-list  mr-1"></i>
                                Events list
                            </h5>
                            <div class="card-body">
                                <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action " aria-current="true">
                                        The current link item
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">A second link item</a>
                                    <a href="#" class="list-group-item list-group-item-action">A third link item</a>
                                    <a href="#" class="list-group-item list-group-item-action active">A fourth link
                                        item</a>
                                    <a href="#" class="list-group-item list-group-item-action">A third link item</a>
                                    <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
                                    <a href="#" class="list-group-item list-group-item-action">A third link item</a>
                                    <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
                                    <a href="#" class="list-group-item list-group-item-action">A third link item</a>
                                    <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
                                    <a href="#" class="list-group-item list-group-item-action">A third link item</a>
                                    <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <div class="card">
                            <h5 class="card-header">
                                <i class="fa-solid fa-money-bill mr-1"></i>
                                Messages
                            </h5>
                            <div class="card-body">
                                <div class="flex max-h-[30rem] border border-gray-300 rounded-lg overflow-hidden">
                                    <div class="w-80 border-r border-gray-300 ">
                                        <div class="list-group list-group-flush">
                                            <a href="#" class="list-group-item list-group-item-action "
                                               aria-current="true">
                                                The current link item
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">A second link
                                                item</a>
                                            <a href="#" class="list-group-item list-group-item-action">A third link
                                                item</a>
                                            <a href="#" class="list-group-item list-group-item-action active">A fourth
                                                link item</a>
                                        </div>
                                    </div>
                                    <div class="flex-1">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @push('js')
        <script>
            let dateTime = setInterval(() => {
                $('#dateTime').html(moment().format('LLL'))
            }, 1000)


            const vueApp = Vue.createApp({
                data() {
                    // init Calendar
                    let Events = [
                        { // this object will be "parsed" into an Event Object
                            title: 'The Title', // a property!
                            start: '2023-12-20', // a property!
                            end: '2023-12-22' // a property! ** see important note below about 'end' **
                        }
                    ]
                    return {
                        Events,
                        calendar: '',
                    }
                },
                methods: {
                    EventHandler() {
                        let start = moment($('#evtStart').val()).format('YYYY-MM-DDTHH:mm')
                        let end = moment($('#evtEnd').val()).format('YYYY-MM-DDTHH:mm')
                        let title = $('#eventTitle').val()
                        // this.calendar.render()
                        this.calendar.addEvent({
                            title: title, // a property!
                            start: start, // a property!
                            end: end // a property! ** see important note below about 'end' **
                        })
                        $('#teacher-calendar-modal').modal('hide');
                    },
                },
                mounted() {
                    const calendarEl = document.getElementById('teacher-calendar');
                    this.calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        selectable: true,
                        select: (e) => {
                            $('#teacher-calendar-modal').find('#evtStart').val(moment(e.start).format('YYYY-MM-DD'));
                            $('#teacher-calendar-modal').find('#evtEnd').val(moment(e.end).format('YYYY-MM-DD'));
                            $('#teacher-calendar-modal').modal('show');
                        },
                        events: this.Events
                    });
                    this.calendar.render();
                    $('#submit_event').on('click', this.EventHandler)
                },
            });
            vueApp.mount('#vue-app');

        </script>
    @endpush
</x-app-layout>

