@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.css"/>

    @vite('resources/css/admin.index.css')

    <style>
        .alert-dismissible .btn-close {
            font-size: 1.5rem;
            padding: .7rem;
        }

        .no-wrap {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
@endpush

@push('js')

    {{--todo - update this--}}
    {{--    @vite('resources/js/admin.index.js')--}}

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

{{--    <script src="{{ asset('/assets/jquery/jquery.min.js') }}"></script>--}}

    <script>
        // Doc ready
        $(document).ready(function () {
            // todo - tighten these up
            flatpickr(".start-time", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                minDate: "today",
                maxDate: new Date().fp_incr(365),
                defaultDate: new Date(),
                // time_24hr: true,
                // defaultHour: 12,
                // defaultMinute: 0,
                // minTime: "08:00",
                // maxTime: "18:00",
                // time_24hr: true,
                // minuteIncrement: 30,
                // plugins: [new rangePlugin({ input: "#to" })]
            });
        });

        // $(document).ready(function () {
        //     // show spinner on button click
        //     $('button').on('click', function () {
        //         $(this).html(`
        //             <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        //         `);
        //     });
        // });

    </script>

    {{--todo - move all this to resources/css, load with vite--}}
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
                    Events
                }
            },

            methods: {
                saveRecord(e) {
                    console.log('saveRecord')
                    console.log(e)
                    return;
                    let that = this;
                    const password = document.getElementById('password').value;
                    const phone = document.getElementById('phone').value;

                    $(".spinner").removeClass('d-none');

                    // todo - Youcef, save the image...

                    let form_data = new FormData();
                    form_data.append('first_name', that.first_name);
                    form_data.append('last_name', that.last_name);
                    form_data.append('phone_number', phone);
                    form_data.append('email', that.email);
                    form_data.append('password', password);
                    form_data.append('type', that.role);
                    form_data.append('address', that.address);
                    form_data.append('bio', that.bio);

                    axios.post('/user', form_data).then(response => {
                        /* Stop spinner */
                        $(".spinner").addClass('d-none');

                        if (response.data.status_code >= 200 && response.data.status_code <= 299) {
                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                text: "Operation performed successfully!",
                            });

                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: response.data.message,
                            });
                        }

                        // todo - refresh page, fix this, do better
                    }).catch((e) => {
                        console.log(e);
                        $(".spinner").addClass('d-none');
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                        });
                    })
                },
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
            <i class="fas fa-user-shield mr-1"></i>
            <i class="fas fa-person-chalkboard mr-1"></i>
            {{ __('Lessons') }}
        </h2>
    </x-slot>

    {{--Admin Nav--}}
    @include('admin.nav.admin-nav')


    {{--Vue App--}}
    <div id="vue-app" class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container">

                    {{--Alerts--}}
                    {{--@include('components.alerts')--}}

                    {{--Create Lesson--}}
                    @include('admin.lessons.form', [
                        'teachers' => $teachers,
                        'students' => $students,
                        'instruments' => $instruments,
                        'durations' => $durations,
                        'rates' => $rates,
                    ])


                    {{--Lessons--}}
                    @include('admin.lessons.lessons-table', ['models' => $lessons])

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
