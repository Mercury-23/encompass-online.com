@push('css')
    <style>
        .table-container {
            overflow-y: scroll !important;
            /*padding: .5rem;*/
            /*border-radius: 6px;*/
        }

        .table-container table thead {
            /*border: 1px solid #ccc;*/
        }

        .table-container table tbody {
            /*border: 1px solid #ccc;*/
        }

        .table-container table tbody tr {
            border: 1px solid #ccc;
        }

        .table-container table tbody tr:hover {
            cursor: pointer;
        }

        .table-container img {
            max-height: 32px;
            max-width: 32px;
        }


    </style>
@endpush

@push('js')
    <script>

        $(document).ready(function () {
            const $lessonsCard = $('.lessons-card');

            // todo - fix button spinners
            // show spinner on button click
            // $lessonsCard.find('button').on('click', function () {
            //     $(this).html(`
            //         <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            //     `);
            //     $lessonsCard.find('.spinner-border').removeClass('d-none');
            //     $lessonsCard.find('.fa-spinner').removeClass('d-none');
            // });

            // close badge after 3 seconds
            setTimeout(function () {
                $lessonsCard.find('.alert').addClass('animate__zoomOut');
                setTimeout(function () {
                    $lessonsCard.find('.alert').remove();
                }, 1000);
            }, 5000);
        });


    </script>
@endpush

<div class="row my-2">
    <div class="col">
        <div class="lessons-card card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h5>
                            <i class="fa-solid fa-person-chalkboard mr-1"></i>
                            <i class="fa-solid fa-list mr-1"></i>
                            Lessons
                        </h5>
                    </div>
                    <div class="col-6">
                        {{--Success--}}
                        @if( session('lessonsTableSuccess') )
                            <span
                                class="alert alert-success text-center py-0 mb-0 animate__animated animate__zoomIn d-inline-block float-right">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    <strong>{{ session('lessonsTableSuccess') }}</strong>
                                </span>
                        @endif
                        {{--spinner--}}
                        <span class="fa fa-spinner fa-spin float-right d-none mr-2" role="status"
                              aria-hidden="true"></span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-container">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr class="text-center">
                            <th scope="col">ID</th>

                            <th scope="col">
                                <i class="fas fa-chalkboard-teacher mr-1"></i>
                                Teacher
                            </th>

                            <th scope="col">
                                <i class="fas fa-user-graduate mr-1"></i>
                                Student
                            </th>

                            <th scope="col">
                                <i class="fas fa-drum mr-1"></i>
                                Instrument
                            </th>

                            <th scope="col">
                                <i class="fas fa-dollar-sign mr-1"></i>
                                Rate
                            </th>

                            <th scope="col">
                                <i class="fas fa-hourglass-half mr-1"></i>
                                Duration
                            </th>

                            <th scope="col">
                                <i class="fas fa-clock mr-1"></i>
                                Start Time
                            </th>

                            <th scope="col">
                                <i class="fas fa-clock mr-1"></i>
                                End Time
                            </th>

                            {{--Complete Button--}}
                            <th scope="col">
                                <i class="fas fa-check-circle"></i>
                            </th>

                            {{--Edit Button--}}
                            <th scope="col">
                                <i class="fas fa-edit"></i>
                            </th>

                            {{--Delete--}}
                            <th scope="col">
                                <i class="fas fa-trash-alt"></i>
                            </th>

                        </tr>
                        </thead>
                        <tbody class="table-body">
                        @foreach($models as $n)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 text-sm">{{ $n->id }}</h6>
                                    </div>
                                </td>

                                <td>
                                    <div>
                                        <img src="{{ asset('/img/avatars/default.jpeg') }}" alt=""
                                             class="rounded-circle mx-auto" style="width: 50px; height: 50px;">
                                    </div>
                                    <div class="text-center">
                                        <span class="badge bg-secondary"
                                              style="top: -.7rem; position: relative;">
                                            {{ isset($n->teacher) ? $n->teacher->name : 'No User' }}
                                        </span>
                                    </div>
                                </td>

                                <td>
                                    <div>
                                        <img src="{{ asset('/img/avatars/default.jpeg') }}" alt=""
                                             class="rounded-circle mx-auto" style="width: 50px; height: 50px;">
                                    </div>
                                    <div class="text-center">
                                        <span class="badge bg-secondary"
                                              style="top: -.7rem; position: relative;">
                                            {{ isset($n->student) ? $n->student->name : 'No User' }}
                                        </span>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="/img/instruments/noun-drums.png"
                                             class="w-10 border mx-auto"
                                             alt="">
                                        {{--todo - fix this--}}
                                    </div>
                                </td>

                                <td>
                                    <div class="text-center">
                                        <h1 class="mb-0 text-xl">${{ $n->price }}</h1>
                                    </div>
                                </td>

                                <td>
                                    <div class="text-center">
                                        <h6 class="mb-0 text-sm">{{ $n->duration }}</h6>
                                        <div>
                                            <small>Minutes</small>
                                        </div>
                                    </div>
                                </td>

                                {{--Start Time--}}
                                <td class="no-wrap text-center">
                                    <div>
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <h6 class="mb-0 text-sm">{{ $n->start_time->diffForHumans() }}</h6>
                                    <small class="">{{ $n->start_time->toDayDateTimeString() }}</small>
                                </td>

                                {{--End Time--}}
                                <td class="no-wrap text-center">
                                    <div>
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <h6 class="mb-0 text-sm">{{ $n->end_time->diffForHumans() }}</h6>
                                    <small class="">{{ $n->end_time->toDayDateTimeString() }}</small>
                                </td>

                                {{--Complete Button--}}
                                <td class="text-center">
                                    <button type="button"
                                            {{--                                            class="btn btn-sm btn-success bg-green-500 text-gray-100 px-3">--}}
                                            class="btn btn-sm btn-secondary text-gray-500 px-3">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                </td>

                                {{--Edit Button--}}
                                <td class="text-center">
                                    {{--                                    <a href="{{ route('admin.lessons.edit', $n->id) }}"--}}
                                    <a href="#"
                                       class="btn btn-sm btn-primary bg-blue-500 text-gray-100 px-3">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>

                                {{--Delete--}}
                                <td class="text-center">
                                    <form action="{{ route('admin.lessons.destroy', $n->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-danger bg-red-500 text-gray-100 px-3">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
