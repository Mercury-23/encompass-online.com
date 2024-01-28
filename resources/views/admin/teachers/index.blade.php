{{--Teachers--}}
@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.css"/>
    <link rel="stylesheet" href="/css/data-tables.css"/>
@endpush

@push('js')

    @vite('resources/js/admin/teachers.index.js')

    <script>
        const vueApp = Vue.createApp({
            data() {
            },
            methods: {},
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
            <i class="fas fa-chalkboard-teacher mr-1"></i>
            {{ __('Teachers') }}
        </h2>
    </x-slot>

    {{--Admin Nav--}}
    @include('admin.nav.admin-nav')

    {{--Vue App--}}
    <div id="vue-app" class="py-2">

        {{--Wrapper--}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container py-2">
                    <div class="row">

                        {{--DataTable--}}
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <h3>
                                        <i class="fas fa-chalkboard-teacher mr-1"></i>
                                        <i class="fa-solid fa-table-list mr-1"></i>
                                        Teachers
                                    </h3>
                                </div>
                                <div class="card-body px-2 overflow-auto">
                                    <table id="users-table" class="display">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Avatar</th>
                                            <th>Type</th>
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
    </div>
</x-app-layout>
