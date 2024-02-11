/*
* users.index.js
* - This file is the entry point for the admin dashboard
* */

import {createApp} from 'vue';
import Inputmask from 'inputmask';
import Swal from "sweetalert2";

import {initUsersTable} from "../utils.js";

const vueApp = createApp({
    data() {
        return {
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

            /* update user */
            edit_first_name: '',
            edit_last_name: '',
            edit_email: '',
            edit_role: 'student',
            edit_password: '',
            edit_address: '',

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

        renderTags() {
            console.log(event)
        },

        save() {
            this.form_data.inActive = $('#inActive').val()
            this.form_data.enrollment = $('#enrollment').val()
            this.form_data.home_phone = $('#home_phone').val()
            this.form_data.cell_phone = $('#cell_phone').val()

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

            let $table = $('#users-table');
            initUsersTable('all', $table);
        });
    },
});

vueApp.mount('#vue-app');
