@push('css')
    <style>
        #admin-menu-off-canvas {}
        .nav-tabs a {
            color: #6c757d;
        }
        .admin-navigation .nav-tabs .nav-link.active {
            color: #495057;
            background-color: #fff;
            border-color: #dee2e6 #dee2e6 #fff;
        }
        .admin-navigation {
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
            /*display: none;*/
        }
        #totals a {
            color: #2783d5;
        }
        #totals a:hover {
            color: #2783d5;
        }
        #totals a i {
            font-size: 1rem;
        }
    </style>
@endpush

@push('js')
{{--    <script src="{{ asset('/assets/jquery/jquery.min.js') }}"></script>--}}

    <script>

        // Doc ready
        $(document).ready(function () {
            // On click of any nav tab link, set spinner
            $('#totals a').on('click', function (e) {
                // remove any fa-* or fa-*-* classes
                $('#totals a i').removeClass(function (index, className) {
                    return (className.match(/(^|\s)fa-\S+/g) || []).join(' ');
                });
                $(this).find('i').addClass('fa-spinner fa-spin');
            });
        });

        initTotals();

        function initTotals() {
            try {
                // Get totals from /admin/api/totals
                const totalsUrl = '{{ route('admin.api.totals') }}';
                const totalsData = [
                    {
                        label: 'Revenue',
                        icon: 'fas fa-dollar-sign',
                        url: '{{ route('admin.dashboard') }}'
                    },
                    {
                        label: 'Lessons',
                        icon: 'fas fa-person-chalkboard',
                        url: '{{ route('admin.lessons.index') }}'
                    },
                    {
                        label: 'Invoices',
                        icon: 'fas fa-file-invoice-dollar',
                        url: '{{ route('admin.invoices.index') }}'
                    },
                    {
                        label: 'Instruments',
                        icon: 'fas fa-drum',
                        url: '{{ route('admin.instruments.index') }}'
                    },
                    {
                        label: 'Users',
                        icon: 'fas fa-users',
                        url: '{{ route('admin.users.index') }}'
                    },
                    {
                        label: 'Admins',
                        icon: 'fas fa-user-shield',
                        url: '{{ route('admin.dashboard') }}'
                    },
                    {
                        label: 'Teachers',
                        icon: 'fas fa-chalkboard-teacher',
                        url: '{{ route('admin.teachers.index') }}'
                    },
                    {
                        label: 'Parents',
                        icon: 'fas fa-user-friends',
                        url: '{{ route('admin.parents.index') }}'
                    },
                    {
                        label: 'Students',
                        icon: 'fas fa-user-graduate',
                        url: '{{ route('admin.students.index') }}'
                    },
                ];

                $.ajax({
                    url: totalsUrl,
                    type: 'GET',
                    dataType: 'json',
                    success: showData,
                    error: function (e) {
                        console.log('Error: ', e);
                    }
                });

                function showData(data) {
                    const {totals} = data;
                    const elContainer = document.getElementById('totals');

                    // Loop totalsData, so can control the order
                    for (let i = 0; i < totalsData.length; i++) {
                        const item = totalsData[i];
                        const pillBadge = `<a href="${item.url}" class="badge  p-1 px-4 w-100 text-secondary-emphasis bg-secondary-subtle border border-secondary-subtle rounded-pill">
                                <i class="${item.icon} mr-1"></i>
                                ${totals[item.label.toLowerCase()] ?? 'No Data'}</a>`;
                        const card = document.createElement('div');
                        card.classList.add('col', 'my-1', 'text-center');
                        card.innerHTML = pillBadge;
                        elContainer.appendChild(card);
                    }
                }
            } catch (e) {
                console.log(e);
            }
        }
    </script>
@endpush

<div class="py-1 admin-navigation">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-1 text-gray-900">
                <div class="container">

                    {{--Totals--}}
                    <div class="row" id="totals"></div>

                    {{--Navigation Tabs--}}
                    <div class="row d-none d-lg-block">
                        <div class="col">
                            <ul class="nav nav-tabs">

                                {{--Dashboard--}}
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                                       aria-current="page"
                                       href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-tachometer-alt mr-1"></i>
                                        Dashboard
                                    </a>
                                </li>

                                {{--Lessons--}}
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.lessons.index') ? 'active' : ''}}"
                                       href="{{ route('admin.lessons.index') }}">
                                        <i class="fas fa-person-chalkboard mr-1"></i>
                                        Lessons
                                    </a>
                                </li>

                                {{--Invoices--}}
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.invoices.index') ? 'active' : ''}}"
                                       href="{{ route('admin.invoices.index') }}">
                                        <i class="fas fa-file-invoice-dollar mr-1"></i>
                                        Invoices
                                    </a>
                                </li>

                                {{--Instruments--}}
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.instruments.index') ? 'active' : ''}}"
                                       href="{{ route('admin.instruments.index') }}">
                                        <i class="fas fa-drum mr-1"></i>
                                        Instruments
                                    </a>
                                </li>

                                {{--Database--}}
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.database') ? 'active' : ''}}"
                                       href="{{ route('admin.database') }}">
                                        <i class="fas fa-database mr-1"></i>
                                        Database
                                    </a>
                                </li>

                                {{--Users--}}
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : ''}}"
                                       href="{{ route('admin.users.index') }}">
                                        <i class="fas fa-users mr-1"></i>
                                        Users
                                    </a>
                                </li>

                                {{--Teachers--}}
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.teachers.index') ? 'active' : ''}}"
                                       href="{{ route('admin.teachers.index') }}">
                                        <i class="fas fa-chalkboard-teacher mr-1"></i>
                                        Teachers
                                    </a>
                                </li>

                                {{--Parents--}}
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.parents.index') ? 'active' : ''}}"
                                       href="{{ route('admin.parents.index') }}">
                                        <i class="fas fa-user-friends mr-1"></i>
                                        Parents
                                    </a>
                                </li>

                                {{--Students--}}
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.students.index') ? 'active' : ''}}"
                                       href="{{ route('admin.students.index') }}">
                                        <i class="fas fa-user-graduate mr-1"></i>
                                        Students
                                    </a>
                                </li>



                            </ul>
                        </div>
                    </div>

                    {{--Menu Button - TODO - offcanvas menu--}}
{{--                    <div class="col text-right d-none">--}}
{{--                        <button class="btn btn-secondary btn-sm right-0 bg-secondary px-4" type="button"--}}
{{--                                data-bs-toggle="offcanvas"--}}
{{--                                data-bs-target="#admin-menu-off-canvas" aria-controls="admin-menu-off-canvas">--}}
{{--                            <i class="fas fa-bars mr-1"></i>--}}
{{--                            Admin Menu--}}
{{--                        </button>--}}
{{--                    </div>--}}

                    {{--Off Canvas Menu--}}
{{--                    <div class="offcanvas offcanvas-start"--}}
{{--                         id="admin-menu-off-canvas"--}}
{{--                         tabindex="-1"--}}
{{--                         aria-labelledby="admin-menu-label"--}}
{{--                         style="width: 14rem !important; max-width: 14rem !important;">--}}
{{--                        <div class="offcanvas-header">--}}
{{--                            <h5 class="offcanvas-title" id="admin-menu-label">Admin Menu</h5>--}}
{{--                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"--}}
{{--                                    aria-label="Close"></button>--}}
{{--                        </div>--}}
{{--                        <div class="offcanvas-body">--}}
{{--                            <ul class="nav flex-column">--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="{{ route('admin.dashboard') }}" class="nav-link">--}}
{{--                                        <i class="fas fa-tachometer-alt mr-1"></i>--}}
{{--                                        Dashboard--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="{{ route('users.index')     }}" class="nav-link">--}}
{{--                                        <i class="fas fa-users mr-1"></i>--}}
{{--                                        Users--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                </div>
            </div>
        </div>
    </div>
</div>
