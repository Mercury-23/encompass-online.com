/*
* users.index.js
* - This file is the entry point for the admin dashboard
* */

import {createApp} from 'vue';
import Inputmask from 'inputmask';

import {initUsersTable} from "../utils.js";

let $table = $('#users-table');
initUsersTable('all', $table);

const vueApp = createApp({
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
            form_data: {
                tags: [],
                type:'student'
            },

            /* Create user */
            first_name: '',
            last_name: '',
            email: '',
            phone: '',
            role: 'student',
            password: '',
            address: '',
            bio: '',

            /* update user */
            edit_first_name: '',
            edit_last_name: '',
            edit_email: '',
            edit_role: 'student',
            edit_password: '',
            edit_address: '',
            edit_bio: '',

            /* Create instrument */
            instr_name: '',
            hour_rate: '',

            /* Edit instrument */
            edit_instr_name: "",
            edit_hourly_rate: "",


            /* User data object */
            id: '',
            userData: [],
            /* Image preview */
            previewImage: '{{ URL::to('/') }}/assets/images/upload.png',
            /* Preview Instrument image */
            preview_instr_image: '{{ URL::to('/') }}/assets/images/upload.png'
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
        /*
        |--------------------------------------------------------------------------
        | For Select And Preview Image
        |--------------------------------------------------------------------------
        */
        selectImage() {
            this.$refs.fileInput.click();
        },
        pickFile() {
            let input = this.$refs.fileInput;
            let file = input.files;
            if (file && file[0]) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.previewImage = e.target.result;
                };
                reader.readAsDataURL(file[0]);
                this.$emit("input", file[0]);
            }
        },

        /*
        |--------------------------------------------------------------------------
        | For Select And Preview Instrument Image
        |--------------------------------------------------------------------------
        */

        select_instr_image() {
            this.$refs.instr_file.click();
        },
        pick_instr_file() {
            let input = this.$refs.instr_file;
            let file = input.files;
            if (file && file[0]) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.preview_instr_image = e.target.result;
                };
                reader.readAsDataURL(file[0]);
                this.$emit("input", file[0]);
            }
        },

        saveRecord(e) {
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

        /* Edit user popup */
        editUserPopup(data) {
            let that = this;

            that.userData = data;
            that.id = that.userData.id;
            that.edit_first_name = that.userData.first_name;
            that.edit_last_name = that.userData.last_name;
            that.edit_email = that.userData.email;
            that.edit_role = that.userData.type;
            $("#edit_phone").val(that.userData.phone_number);
            // that.edit_address = that.userData.address.address;
            // that.edit_bio = that.userData.bio.short_bio;
            $("#editUser").modal("show");
        },

        /* Store updated data */
        updateRecord() {
            let that = this;
            const edit_phone_number = document.getElementById('edit_phone').value;

            $(".spinner").removeClass('d-none');

            axios.patch('/user', {
                id: that.id,
                first_name: that.edit_first_name,
                last_name: that.edit_last_name,
                email: that.edit_email,
                type: that.edit_role,
                phone_number: edit_phone_number
            }).then(response => {
                /* Stop spinner */
                $(".spinner").addClass('d-none');

                if (response.data.status_code >= 200 && response.data.status_code <= 299) {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "Record updated successfully!",
                    });
                    // todo - refresh page, fix this, do better
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                } else {
                    console.log(response);
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Some error",
                    });
                }
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

        /* Store instrument */
        saveInstrument() {
            let that = this;
            $(".spinner").removeClass('d-none');

            axios.post('/instrument', {
                name: that.instr_name,
                hourly_rate: that.hour_rate,
            }).then(response => {

                /* Stop spinner */
                $(".spinner").addClass('d-none');

                if (response.data.status_code >= 200 && response.data.status_code <= 299) {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "Record Added successfully!",
                    });
                    // todo - refresh page, fix this, do better
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                } else {
                    console.log(response);
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Some error",
                    });
                }
            }).catch((e) => {
                console.log(e);
                $(".spinner").addClass('d-none');
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                });
            });
        },

        /* Update Instrument */
        editInstrumentPopup(data) {
            let that = this;
            that.instrumentData = data;
            that.edit_instr_name = data.name;
            that.edit_hourly_rate = data.hourly_rate;

            $("#editInstrument").modal("show");
        },

        /* Store updated data */
        updateInstrument() {
            let that = this;
            $(".spinner").removeClass('d-none');

            axios.patch('/instrument', {
                id: that.instrumentData.id,
                name: that.edit_instr_name,
                hourly_rate: that.edit_hourly_rate,
            }).then(response => {
                /* Stop spinner */
                $(".spinner").addClass('d-none');

                if (response.data.status_code >= 200 && response.data.status_code <= 299) {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "Record updated successfully!",
                    });
                    // todo - refresh page, fix this, do better
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                } else {
                    console.log(response);
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Some error",
                    });
                }
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

        renderTags() {
            console.log(event)
        },
        save() {
            this.form_data.inActive = $('#inActive').val()
            this.form_data.enrollment = $('#enrollment').val()
            this.form_data.home_phone = $('#home_phone').val()
            this.form_data.cell_phone = $('#cell_phone').val()

            console.log(this.form_data)

            axios.post('/profile', this.form_data).then((res) => {
                window.location.reload();
            })
        },
    },

    mounted() {
        jQuery.noConflict();
        jQuery(document).ready(function($) {
            const phoneMask = '# (###) ###-####';
            Inputmask({"mask": phoneMask, placeholder: "#"}).mask($("#home_phone"));
            Inputmask({"mask": phoneMask, placeholder: "#"}).mask($("#cell_phone"));
            Inputmask({"mask": "##/##/####", placeholder: "#"}).mask($(".date_input"));
        });


        // const calendarEl = document.getElementById('teacher-calendar');
        // this.calendar = new FullCalendar.Calendar(calendarEl, {
        //     initialView: 'dayGridMonth',
        //     selectable: true,
        //     select: (e) => {
        //         $('#teacher-calendar-modal').find('#evtStart').val(moment(e.start).format('YYYY-MM-DD'));
        //         $('#teacher-calendar-modal').find('#evtEnd').val(moment(e.end).format('YYYY-MM-DD'));
        //         $('#teacher-calendar-modal').modal('show');
        //     },
        //     events: this.Events
        // });
        // this.calendar.render();


        $('#submit_event').on('click', this.EventHandler)
    },
});

vueApp.mount('#vue-app');
