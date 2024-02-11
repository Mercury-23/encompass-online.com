@push('css')
    @vite('resources/css/admin.index.css')
@endpush

@push('js')
{{--    <script src='//cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>--}}

    @vite('resources/js/admin/users.index.js')
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
    @include('admin.nav.admin-nav')

    {{--Vue App--}}
    <div id="vue-app" class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @include('admin.users.form')

                    {{--DataTable--}}
                    <div class="card">
                        <div class="card-header">
                            <h3>
                                <i class="fas fa-users mr-1"></i>
                                All Users
                            </h3>
                        </div>
                        <div class="card-body overflow-auto px-2">
                            <table id="users-table" class="display">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First name / Last name</th>
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
</x-app-layout>
