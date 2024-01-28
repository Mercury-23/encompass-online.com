{{--Scheduler--}}
{{--https://fullcalendar.io/docs--}}
{{--https://fullcalendar.io/docs/event-object--}}

@push('css')
    @vite('resources/css/admin.index.css')
    <style>
        #scheduler-calendar {
            /*border: 1px solid red;*/
            min-height: 75vh;
        }
    </style>
@endpush

@push('js')
    <script src='//cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>

    <script>
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

                },
            },
            mounted() {
                const calendarEl = document.getElementById('scheduler-calendar');
                this.calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'timeGridWeek',
                    selectable: true,
                    select: (e) => {
                        // $('#teacher-calendar-modal').find('#evtStart').val(moment(e.start).format('YYYY-MM-DD'));
                        // $('#teacher-calendar-modal').find('#evtEnd').val(moment(e.end).format('YYYY-MM-DD'));
                        // $('#teacher-calendar-modal').modal('show');
                    },
                    // events: this.Events
                });
                this.calendar.render();
                // $('#submit_event').on('click', this.EventHandler)
            },
        });
        vueApp.mount('#vue-app');
    </script>
@endpush

<x-app-layout>

    {{--Header--}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fa-duotone fa-calendar-alt mr-1"></i>
            {{ __('Scheduler') }}
        </h2>
    </x-slot>

    {{--App--}}
    <div class="py-1" id="vue-app">
        <div class="container mx-auto sm:px-1 lg:px-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-1">
                <div id="scheduler-calendar"
                    class=""
                ></div>
            </div>
        </div>
    </div>

</x-app-layout>
