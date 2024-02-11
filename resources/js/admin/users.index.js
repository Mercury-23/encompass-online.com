/*
* users.index.js
* - This file is the entry point for the admin dashboard
* */

import {createApp} from 'vue';
import Inputmask from 'inputmask';

import {initUsersTable} from "../utils.js";
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
