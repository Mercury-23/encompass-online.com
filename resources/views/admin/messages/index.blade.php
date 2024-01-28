@push('css')
    <style>
    </style>
    @vite('resources/css/admin.index.css')
@endpush

@push('js')
{{--    @vite('resources/js/admin.index.js')--}}
@endpush


@push('js')
    {{--todo - move all this to resources/css, load with vite--}}
    <!-- Intel input phone number plugin -->
    <script>
        // todo - fix or remove this...
        // jquery plugin for phone number
        // const input = document.querySelector("#phone");
        // const iti = window.intlTelInput(input, {
        //     // separateDialCode:true,
        //     utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.0/build/js/utils.js",
        // });
        //
        // // store the instance variable, so we can access it in the console e.g. window.iti.getNumber()
        // window.iti = iti;

        $(document).ready(function () {
            // const $phone = $("#phone");
            // const $edit_phone = $("#edit_phone");
            // const maskConfig = {
            //     mask: '###-###-####',
            //     placeholder: '#'
            // };
            //
            // // If $phone is not empty
            // if ($phone.length > 0) {
            //     $phone.inputmask(maskConfig);
            // }
            //
            // if ($edit_phone.length > 0) {
            //     $edit_phone.inputmask(maskConfig);
            // }
            //
            //
            // // todo - fix or remove this...
            // function aiAssit() {
            //     $phone.intlTelInput({
            //         separateDialCode: true,
            //         initialCountry: "auto",
            //         geoIpLookup: function (callback) {
            //             $.get('https://ipinfo.io', function () {
            //             }, "jsonp").always(function (resp) {
            //                 var countryCode = (resp && resp.country) ? resp.country : "";
            //                 callback(countryCode);
            //             });
            //         },
            //         utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
            //     });
            //     $edit_phone.intlTelInput({
            //         separateDialCode: true,
            //         initialCountry: "auto",
            //         geoIpLookup: function (callback) {
            //             $.get('https://ipinfo.io', function () {
            //             }, "jsonp").always(function (resp) {
            //                 var countryCode = (resp && resp.country) ? resp.country : "";
            //                 callback(countryCode);
            //             });
            //         },
            //         utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
            //     });
            //     $phone.on("countrychange", function (e, countryData) {
            //         console.log(countryData);
            //     });
            // }
        });


        {{--const vueApp = Vue.createApp({--}}
        {{--    data() {--}}
        {{--        // init Calendar--}}
        {{--        let Events = [--}}
        {{--            { // this object will be "parsed" into an Event Object--}}
        {{--                title: 'The Title', // a property!--}}
        {{--                start: '2023-12-20', // a property!--}}
        {{--                end: '2023-12-22' // a property! ** see important note below about 'end' **--}}
        {{--            }--}}
        {{--        ]--}}
        {{--        return {--}}
        {{--            Events,--}}
        {{--            calendar: '',--}}
        {{--            /* Create user */--}}
        {{--            first_name: '',--}}
        {{--            last_name: '',--}}
        {{--            email: '',--}}
        {{--            phone: '',--}}
        {{--            role: 'student',--}}
        {{--            password: '',--}}
        {{--            address: '',--}}
        {{--            bio: '',--}}

        {{--            /* update user */--}}
        {{--            edit_first_name: '',--}}
        {{--            edit_last_name: '',--}}
        {{--            edit_email: '',--}}
        {{--            edit_role: 'student',--}}
        {{--            edit_password: '',--}}
        {{--            edit_address: '',--}}
        {{--            edit_bio: '',--}}

        {{--            /* Create instrument */--}}
        {{--            instr_name: '',--}}
        {{--            hour_rate: '',--}}

        {{--            /* Edit instrument */--}}
        {{--            edit_instr_name: "",--}}
        {{--            edit_hourly_rate: "",--}}


        {{--            /* User data object */--}}
        {{--            id: '',--}}
        {{--            userData: [],--}}
        {{--            /* Image preview */--}}
        {{--            previewImage: '{{ URL::to('/') }}/assets/images/upload.png',--}}
        {{--            /* Preview Instrument image */--}}
        {{--            preview_instr_image: '{{ URL::to('/') }}/assets/images/upload.png'--}}
        {{--        }--}}
        {{--    },--}}
        {{--    methods: {--}}
        {{--        EventHandler() {--}}
        {{--            let start = moment($('#evtStart').val()).format('YYYY-MM-DDTHH:mm')--}}
        {{--            let end = moment($('#evtEnd').val()).format('YYYY-MM-DDTHH:mm')--}}
        {{--            let title = $('#eventTitle').val()--}}
        {{--            // this.calendar.render()--}}
        {{--            this.calendar.addEvent({--}}
        {{--                title: title, // a property!--}}
        {{--                start: start, // a property!--}}
        {{--                end: end // a property! ** see important note below about 'end' **--}}
        {{--            })--}}
        {{--            $('#teacher-calendar-modal').modal('hide');--}}
        {{--        },--}}
        {{--        /*--}}
        {{--        |----------------------------------------------------------------------------}}
        {{--        | For Select And Preview Image--}}
        {{--        |----------------------------------------------------------------------------}}
        {{--        */--}}
        {{--        selectImage() {--}}
        {{--            this.$refs.fileInput.click();--}}
        {{--        },--}}
        {{--        pickFile() {--}}
        {{--            let input = this.$refs.fileInput;--}}
        {{--            let file = input.files;--}}
        {{--            if (file && file[0]) {--}}
        {{--                let reader = new FileReader();--}}
        {{--                reader.onload = (e) => {--}}
        {{--                    this.previewImage = e.target.result;--}}
        {{--                };--}}
        {{--                reader.readAsDataURL(file[0]);--}}
        {{--                this.$emit("input", file[0]);--}}
        {{--            }--}}
        {{--        },--}}

        {{--        /*--}}
        {{--        |----------------------------------------------------------------------------}}
        {{--        | For Select And Preview Instrument Image--}}
        {{--        |----------------------------------------------------------------------------}}
        {{--        */--}}

        {{--        select_instr_image() {--}}
        {{--            this.$refs.instr_file.click();--}}
        {{--        },--}}
        {{--        pick_instr_file() {--}}
        {{--            let input = this.$refs.instr_file;--}}
        {{--            let file = input.files;--}}
        {{--            if (file && file[0]) {--}}
        {{--                let reader = new FileReader();--}}
        {{--                reader.onload = (e) => {--}}
        {{--                    this.preview_instr_image = e.target.result;--}}
        {{--                };--}}
        {{--                reader.readAsDataURL(file[0]);--}}
        {{--                this.$emit("input", file[0]);--}}
        {{--            }--}}
        {{--        },--}}

        {{--        saveRecord(e) {--}}
        {{--            let that = this;--}}
        {{--            const password = document.getElementById('password').value;--}}
        {{--            const phone = document.getElementById('phone').value;--}}

        {{--            $(".spinner").removeClass('d-none');--}}

        {{--            // todo - Youcef, save the image...--}}

        {{--            let form_data = new FormData();--}}
        {{--            form_data.append('first_name', that.first_name);--}}
        {{--            form_data.append('last_name', that.last_name);--}}
        {{--            form_data.append('phone_number', phone);--}}
        {{--            form_data.append('email', that.email);--}}
        {{--            form_data.append('password', password);--}}
        {{--            form_data.append('type', that.role);--}}
        {{--            form_data.append('address', that.address);--}}
        {{--            form_data.append('bio', that.bio);--}}

        {{--            axios.post('/user', form_data).then(response => {--}}
        {{--                /* Stop spinner */--}}
        {{--                $(".spinner").addClass('d-none');--}}

        {{--                if (response.data.status_code >= 200 && response.data.status_code <= 299) {--}}
        {{--                    Swal.fire({--}}
        {{--                        icon: "success",--}}
        {{--                        title: "Success",--}}
        {{--                        text: "Operation performed successfully!",--}}
        {{--                    });--}}

        {{--                    setTimeout(function () {--}}
        {{--                        window.location.reload();--}}
        {{--                    }, 1000);--}}
        {{--                } else {--}}
        {{--                    Swal.fire({--}}
        {{--                        icon: "error",--}}
        {{--                        title: "Oops...",--}}
        {{--                        text: response.data.message,--}}
        {{--                    });--}}
        {{--                }--}}

        {{--                // todo - refresh page, fix this, do better--}}
        {{--            }).catch((e) => {--}}
        {{--                console.log(e);--}}
        {{--                $(".spinner").addClass('d-none');--}}
        {{--                Swal.fire({--}}
        {{--                    icon: "error",--}}
        {{--                    title: "Oops...",--}}
        {{--                    text: "Something went wrong!",--}}
        {{--                });--}}
        {{--            })--}}
        {{--        },--}}

        {{--        /* Edit user popup */--}}
        {{--        editUserPopup(data) {--}}
        {{--            let that = this;--}}

        {{--            that.userData = data;--}}
        {{--            that.id = that.userData.id;--}}
        {{--            that.edit_first_name = that.userData.first_name;--}}
        {{--            that.edit_last_name = that.userData.last_name;--}}
        {{--            that.edit_email = that.userData.email;--}}
        {{--            that.edit_role = that.userData.type;--}}
        {{--            $("#edit_phone").val(that.userData.phone_number);--}}
        {{--            // that.edit_address = that.userData.address.address;--}}
        {{--            // that.edit_bio = that.userData.bio.short_bio;--}}
        {{--            $("#editUser").modal("show");--}}
        {{--        },--}}

        {{--        /* Store updated data */--}}
        {{--        updateRecord() {--}}
        {{--            let that = this;--}}
        {{--            const edit_phone_number = document.getElementById('edit_phone').value;--}}

        {{--            $(".spinner").removeClass('d-none');--}}

        {{--            axios.patch('/user', {--}}
        {{--                id: that.id,--}}
        {{--                first_name: that.edit_first_name,--}}
        {{--                last_name: that.edit_last_name,--}}
        {{--                email: that.edit_email,--}}
        {{--                type: that.edit_role,--}}
        {{--                phone_number: edit_phone_number--}}
        {{--            }).then(response => {--}}
        {{--                /* Stop spinner */--}}
        {{--                $(".spinner").addClass('d-none');--}}

        {{--                if (response.data.status_code >= 200 && response.data.status_code <= 299) {--}}
        {{--                    Swal.fire({--}}
        {{--                        icon: "success",--}}
        {{--                        title: "Success",--}}
        {{--                        text: "Record updated successfully!",--}}
        {{--                    });--}}
        {{--                    // todo - refresh page, fix this, do better--}}
        {{--                    setTimeout(function () {--}}
        {{--                        window.location.reload();--}}
        {{--                    }, 1000);--}}
        {{--                } else {--}}
        {{--                    console.log(response);--}}
        {{--                    Swal.fire({--}}
        {{--                        icon: "error",--}}
        {{--                        title: "Oops...",--}}
        {{--                        text: "Some error",--}}
        {{--                    });--}}
        {{--                }--}}
        {{--            }).catch((e) => {--}}
        {{--                console.log(e);--}}
        {{--                $(".spinner").addClass('d-none');--}}
        {{--                Swal.fire({--}}
        {{--                    icon: "error",--}}
        {{--                    title: "Oops...",--}}
        {{--                    text: "Something went wrong!",--}}
        {{--                });--}}
        {{--            })--}}
        {{--        },--}}

        {{--        /* Store instrument */--}}
        {{--        saveInstrument() {--}}
        {{--            let that = this;--}}
        {{--            $(".spinner").removeClass('d-none');--}}

        {{--            axios.post('/instrument', {--}}
        {{--                name: that.instr_name,--}}
        {{--                hourly_rate: that.hour_rate,--}}
        {{--            }).then(response => {--}}

        {{--                /* Stop spinner */--}}
        {{--                $(".spinner").addClass('d-none');--}}

        {{--                if (response.data.status_code >= 200 && response.data.status_code <= 299) {--}}
        {{--                    Swal.fire({--}}
        {{--                        icon: "success",--}}
        {{--                        title: "Success",--}}
        {{--                        text: "Record Added successfully!",--}}
        {{--                    });--}}
        {{--                    // todo - refresh page, fix this, do better--}}
        {{--                    setTimeout(function () {--}}
        {{--                        window.location.reload();--}}
        {{--                    }, 1000);--}}
        {{--                } else {--}}
        {{--                    console.log(response);--}}
        {{--                    Swal.fire({--}}
        {{--                        icon: "error",--}}
        {{--                        title: "Oops...",--}}
        {{--                        text: "Some error",--}}
        {{--                    });--}}
        {{--                }--}}
        {{--            }).catch((e) => {--}}
        {{--                console.log(e);--}}
        {{--                $(".spinner").addClass('d-none');--}}
        {{--                Swal.fire({--}}
        {{--                    icon: "error",--}}
        {{--                    title: "Oops...",--}}
        {{--                    text: "Something went wrong!",--}}
        {{--                });--}}
        {{--            });--}}
        {{--        },--}}

        {{--        /* Update Instrument */--}}
        {{--        editInstrumentPopup(data) {--}}
        {{--            let that = this;--}}
        {{--            that.instrumentData = data;--}}
        {{--            that.edit_instr_name = data.name;--}}
        {{--            that.edit_hourly_rate = data.hourly_rate;--}}

        {{--            $("#editInstrument").modal("show");--}}
        {{--        },--}}

        {{--        /* Store updated data */--}}
        {{--        updateInstrument() {--}}
        {{--            let that = this;--}}
        {{--            $(".spinner").removeClass('d-none');--}}

        {{--            axios.patch('/instrument', {--}}
        {{--                id: that.instrumentData.id,--}}
        {{--                name: that.edit_instr_name,--}}
        {{--                hourly_rate: that.edit_hourly_rate,--}}
        {{--            }).then(response => {--}}
        {{--                /* Stop spinner */--}}
        {{--                $(".spinner").addClass('d-none');--}}

        {{--                if (response.data.status_code >= 200 && response.data.status_code <= 299) {--}}
        {{--                    Swal.fire({--}}
        {{--                        icon: "success",--}}
        {{--                        title: "Success",--}}
        {{--                        text: "Record updated successfully!",--}}
        {{--                    });--}}
        {{--                    // todo - refresh page, fix this, do better--}}
        {{--                    setTimeout(function () {--}}
        {{--                        window.location.reload();--}}
        {{--                    }, 1000);--}}
        {{--                } else {--}}
        {{--                    console.log(response);--}}
        {{--                    Swal.fire({--}}
        {{--                        icon: "error",--}}
        {{--                        title: "Oops...",--}}
        {{--                        text: "Some error",--}}
        {{--                    });--}}
        {{--                }--}}
        {{--            }).catch((e) => {--}}
        {{--                console.log(e);--}}
        {{--                $(".spinner").addClass('d-none');--}}
        {{--                Swal.fire({--}}
        {{--                    icon: "error",--}}
        {{--                    title: "Oops...",--}}
        {{--                    text: "Something went wrong!",--}}
        {{--                });--}}
        {{--            })--}}
        {{--        }--}}
        {{--    },--}}
        {{--    mounted() {--}}
        {{--        const calendarEl = document.getElementById('teacher-calendar');--}}
        {{--        this.calendar = new FullCalendar.Calendar(calendarEl, {--}}
        {{--            initialView: 'dayGridMonth',--}}
        {{--            selectable: true,--}}
        {{--            select: (e) => {--}}
        {{--                $('#teacher-calendar-modal').find('#evtStart').val(moment(e.start).format('YYYY-MM-DD'));--}}
        {{--                $('#teacher-calendar-modal').find('#evtEnd').val(moment(e.end).format('YYYY-MM-DD'));--}}
        {{--                $('#teacher-calendar-modal').modal('show');--}}
        {{--            },--}}
        {{--            events: this.Events--}}
        {{--        });--}}
        {{--        this.calendar.render();--}}

        {{--        $('#submit_event').on('click',this.EventHandler)--}}
        {{--    },--}}
        {{--});--}}

        // vueApp.mount('#vue-app');
    </script>
@endpush


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-user-shield mr-1"></i>
            <i class="fas fa-users mr-1"></i>
            {{ __('Users') }}
        </h2>
    </x-slot>

    {{--Admin Nav--}}
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <h3>
                            <i class="fas fa-user-shield mr-1"></i>
                            {{ __('Admin') }}
                        </h3>
                        <div class="my-2">
                            @include('admin.nav.admin-nav')
                        </div>
                        <div class="row my-2">

                            <ul class="nav nav-pills nav-fill">
                                <li class="nav-item">
{{--                                    <a class="nav-link active" aria-current="page" href="#">Active</a>--}}
                                    <a class="nav-link" aria-current="page" href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-tachometer-alt mr-1"></i>
                                        Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.users.index') }}">
                                        <i class="fas fa-users mr-1"></i>
                                        Users</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--Vue App--}}
    <div id="vue-app" class="py-2">


        {{--Wrapper--}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">

                        <div class="row d-none">
                            <div class="col">

                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="#">Active</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Link</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Link</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                                    </li>
                                </ul>


                                <ul class="nav nav-pills nav-fill">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="#">Active</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Much longer nav link</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Link</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                                    </li>
                                </ul>
                            </div>
                        </div>


                        <div class="row mb-1 d-none">
                            <div class="col">
                                <div class="accordion" id="accordionPanelsStayOpenExample">

                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                                Accordion Item #1
                                            </button>
                                        </h2>
                                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                            <div class="accordion-body">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                                Accordion Item #2
                                            </button>
                                        </h2>
                                        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                                            <div class="accordion-body">
                                                <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                                Accordion Item #3
                                            </button>
                                        </h2>
                                        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                                            <div class="accordion-body">
                                                <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="row mb-2">



                            {{--Create User and Instrument--}}


                            {{--Create User--}}
                            <div class="col-md-8">
                                <div class="card mb-1">
                                    <h5 class="card-header">
                                        <i class="fa-solid fa-user mr-1"></i>
                                        Create User
                                    </h5>
                                    <div class="card-body">
                                        <form action="#" method="POST" class="" @submit.prevent="saveRecord()">
                                            <!-- Image Preview Before Upload(Begin) -->
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-center my-2">
                                                    <img :src="previewImage" alt="profile_image" @click="selectImage"
                                                         class="rounded-full cursor-pointer"
                                                         style="object-fit: cover; width: 100px;height: 100px;">
                                                </div>
                                                <input ref="fileInput" name="photo" type="file" @input="pickFile"
                                                       style="display:none;"
                                                       accept="image/*">
                                            </div>

                                            <!-- Image Preview Before Upload(End) -->
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <label for="first_name" class="form-label">First Name</label>
                                                    <input type="text" class="form-control rounded-2" id="first_name"
                                                           name="first_name"
                                                           v-model="first_name" aria-describedby="first_nameHelp"
                                                           placeholder="Enter first name" autocomplete required>
                                                </div>
                                                <div class="col">
                                                    <label for="last_name" class="form-label">Last Name</label>
                                                    <input type="text"
                                                           class="form-control rounded-2"
                                                           id="last_name"
                                                           name="last_name"
                                                           v-model="last_name" aria-describedby="last_nameHelp"
                                                           placeholder="Enter last name" autocomplete required>
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email"
                                                           class="form-control rounded-2"
                                                           id="email"
                                                           name="email"
                                                           v-model="email" aria-describedby="emailHelp"
                                                           placeholder="abc@gmail.com" required>
                                                </div>
                                                <div class="col">
                                                    <label for="phone" class="form-label">Phone</label><br/>
                                                    <input type="tel" class="form-control rounded-2" id="phone"
                                                           name="phone"
                                                           aria-describedby="phoneHelp" placeholder="000 0000000"
                                                           required>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <label for="password">Password</label>
                                                    <input
                                                        id="password"
                                                        class="form-control border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                                        type="password"
                                                        name="password"
                                                        v-model="password"
                                                        required
                                                        autocomplete
                                                    >
                                                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                                                </div>
                                                <div class="col">
                                                    <!-- drop down with Teacher, Parent, Student -->
                                                    <x-input-label for="role" :value="__('Role')"/>
                                                    <select id="role" name="role" v-model="role"
                                                            class="form-control rounded-2"
                                                            required>
                                                        <option value="teacher">Teacher</option>
                                                        <option value="parent">Parent</option>
                                                        <option value="student">Student</option>
                                                    </select>
                                                    <x-input-error :messages="$errors->get('role')" class="mt-2"/>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary bg-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{--Create Instrument--}}
                            <div class="col-md-4">
                                <div class="card">
                                    <h5 class="card-header">
                                        <i class="fa-solid fa-guitar mr-1"></i>
                                        Instruments
                                    </h5>
                                    <div class="card-body">
                                        <form action="" method="POST" @submit.prevent="saveInstrument()">
                                            <!-- Image Preview Before Upload(Begin) -->
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-center my-2">
                                                    <img :src="preview_instr_image" alt="instrument image"
                                                         @click="select_instr_image"
                                                         class="rounded-full cursor-pointer"
                                                         style="object-fit: cover; width: 100px;height: 100px;">
                                                </div>
                                                <input ref="instr_file" name="instr_file" type="file"
                                                       @input="pick_instr_file" style="display:none;"
                                                       accept="image/*">
                                            </div>

                                            <!-- Image Preview Before Upload(End) -->
                                            <div class="mb-3">
                                                <label for="instr_name" class="form-label">Name*</label>
                                                <input type="text" class="form-control rounded-2" id="instr_name"
                                                       v-model="instr_name" aria-describedby="nameHelp"
                                                       placeholder="Enter instrument name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="hour_rate" class="form-label">Hour rate*</label>
                                                <input type="number" class="form-control rounded-2" id="hour_rate"
                                                       v-model="hour_rate" aria-describedby="nameHelp"
                                                       placeholder="Enter per hour rate" required>
                                            </div>

                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary bg-primary ">Submit
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--Lessons Calendar--}}
                        <div class="row mb-2">
                            <div class="col">
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
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Instruments Table -->
        <div class="my-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-1 text-gray-900">
                        {{--Instruments Table--}}
                        <div class="card">
                            <div class="card-header">
                                <h3>
                                    <i class="fa-solid fa-guitar mr-1"></i>
                                    <i class="fa-solid fa-table-list"></i>
                                    Instruments Table
                                </h3>
                            </div>
                            <div class="card-body px-2">
                                <table id="instruments-table" class="display">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Hourly Rate</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="my-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-1 text-gray-900">
                        <div class="card">
                            <div class="card-header">
                                <h3>
                                    <i class="fa-solid fa-users mr-1"></i>
                                    <i class="fa-solid fa-table-list mr-1"></i>
                                    Users Table
                                </h3>
                            </div>
                            <div class="card-body px-2">
                                <table id="users-table" class="display">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
