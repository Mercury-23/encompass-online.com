@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.css"/>
    <link rel="stylesheet" href="/css/data-tables.css"/>
    <style>
    </style>
@endpush

@push('js')
    @vite('resources/js/admin/instruments.js')
@endpush

<x-app-layout>

    {{--Header--}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-user-shield mr-1"></i>
            <i class="fas fa-drum mr-1"></i>
            {{ __('Instruments') }}
        </h2>
    </x-slot>

    {{--Admin Nav--}}
    @include('admin.nav.admin-nav')

    {{--Vue App--}}
    <div id="vue-app" class="py-2">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container py-2">
                    <div class="row">

                        {{--Instruments Form--}}
                        <div class="col-sm-12 col-md-12 col-lg-3">
                            @include('admin.instruments.form')
                        </div>

                        {{--Instruments Table--}}
                        <div class="col-sm-12 col-md-12 col-lg-9">
                            <div class="card">
                                <div class="card-header">
                                    <h3>
                                        <i class="fas fa-drum mr-1"></i>
                                        <i class="fas fa-table-list"></i>
                                        Instruments Table
                                    </h3>
                                </div>
                                <div class="card-body px-2">
                                    <table id="instruments-table" class="display">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
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
        </div>
    </div>
</x-app-layout>
