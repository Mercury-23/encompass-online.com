<script>
export default {
    props:{
      showAllLessons:{
          type:Boolean,
          default:false,
      }
    },
    data() {
        return {
            calendar: '',
            Events:[]
        }
    },
    mounted() {
        this.initCalendar()
        this.get_lessons()
    },
    methods: {
        initCalendar() {
            const calendarEl = document.getElementById('lessons-calendar');
            this.calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridWeek',
                selectable: true,
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'dayGridWeek,dayGridDay,listWeek' // user can switch between the two
                },
                select: (e) => {
                    console.log(e)
                    // $('#teacher-calendar-modal').find('#evtStart').val(moment(e.start).format('YYYY-MM-DD'));
                    // $('#teacher-calendar-modal').find('#evtEnd').val(moment(e.end).format('YYYY-MM-DD'));
                    // $('#teacher-calendar-modal').modal('show');
                },
                events: this.Events,
                eventDidMount: function(info) {
                    if (info.event.extendedProps.status === 'canceled') {
                        // Change background color of row
                        info.el.style.backgroundColor = '#f86767';
                    }
                    if (info.event.extendedProps.status === 'complete') {
                        // Change background color of row
                        info.el.style.backgroundColor = '#63f17d';

                        // Change color of dot marker
                        // var dotEl = info.el.getElementsByClassName('fc-event-dot')[0];
                        // if (dotEl) {
                        //     dotEl.style.backgroundColor = 'white';
                        // }
                    }
                }
            });
            this.calendar.render();
        },
        get_lessons() {
            console.log(this.$props.showAllLessons)
            if(this.$props.showAllLessons){
                axios.get('/all_lessons').then((res) => {
                    this.Events = res.data.map((event)=>{
                        let instrument = event.instrument?event.instrument.name:'';
                        let title = instrument  +' | '+ (event.student.name? event.student.name : event.student.first_name)
                        this.calendar.addEvent({
                            id: event.id,
                            title:title, // Customize as needed
                            start: event.start_time,
                            end: event.end_time,
                            extendedProps: {
                                status: new Date() > new Date(event.end_time)?'complete':''
                            }
                        });
                    })
                })
            }else {
                axios.get('/teacher_lessons', {}).then((res) => {
                    this.Events = res.data.map((event)=>{
                        let instrument = event.instrument?event.instrument.name:'';
                        let title =  instrument  +' | '+ (event.student.name? event.student.name : event.student.first_name)
                        this.calendar.addEvent({
                            id: event.id,
                            title:title, // Customize as needed
                            start: event.start_time,
                            end: event.end_time,
                            extendedProps: {
                                status: new Date() > new Date(event.end_time)?'complete':''
                            }
                        });
                    })
                })
            }
        }
    },
}
</script>
<!--@endpush-->
<template>
    <div id="lessons-calendar"></div>
</template>
