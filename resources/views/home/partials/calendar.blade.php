@push('css')
    <style>
        #lessons-calendar {
            /*font-size: .7rem;*/
        }
        /* Small Screens */
        @media (max-width: 768px) {
            #lessons-calendar {
                font-size: .5rem;
            }
        }
    </style>
@endpush

@push('js')
    <script src='//cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>

    <script>

        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('lessons-calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth'
            });
            calendar.render();
        });

        // initCalendar();
        function initCalendar() {
            const calendarEl = document.getElementById('lessons-calendar');
            this.calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                selectable: true,
                select: (e) => {
                    console.log('select')
                    console.log(e)
                    // $('#teacher-calendar-modal').find('#evtStart').val(moment(e.start).format('YYYY-MM-DD'));
                    // $('#teacher-calendar-modal').find('#evtEnd').val(moment(e.end).format('YYYY-MM-DD'));
                    // $('#teacher-calendar-modal').modal('show');
                },
                events: this.Events
            });
            this.calendar.render();
            // $('#submit_event').on('click', this.EventHandler)
        }

    </script>
@endpush

<div class="card">
    <div class="card-header">
        <i class="fas fa-calendar-alt mr-1"></i>
        {{ __('Calendar') }}
    </div>
    <div class="card-body">
        <div id="lessons-calendar"></div>
    </div>
</div>
