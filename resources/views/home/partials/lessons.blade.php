@push('css')
    <style>

    </style>
@endpush

@push('js')
    <script>
        // todo - on complete click
        $(document).ready(function () {
            $('.complete').click(function () {
                // add active class
                $(this).toggleClass('active');

                let lessonId = $(this).data('lesson-id');
                let url = '/lessons/' + lessonId + '/complete';
                console.log(url);
                // Add CSRF token to ajax request
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    }
                });
                $.ajax({
                    url: url,
                    type: 'PATCH',
                    success: function (response) {
                        console.log(response);
                        // todo - show success message
                        // todo - reload page
                    },
                    error: function (response) {
                        console.log(response);
                        // todo - show error message
                    }
                });
            });

            // todo - edit click
            // todo - delete click

        });


        // todo - on cancel click
        // todo - on edit click
        // todo - on delete click

    </script>
@endpush

<div class="card">
    <h5 class="card-header">
        <i class="fas fa-list mr-1"></i>
        {{ __('Lessons') }}
        <span class="font-bold rounded-full bg-red-500 text-white w-5 h-5 flex items-center justify-center float-right">{{$user->lessons->count()}}</span>
    </h5>
    <div class="card-body max-h-[15rem] overflow-auto" >
        @if($user->lessons->count() === 0)
            <p class="card-text text-muted text-sm">{{ __('You have no lessons.') }}</p>
        @else
            <ul>
                @foreach($user->lessons()->get() as $lesson)
                    <li class="border shadow rounded my-2 p-2 text-center">

                        {{--Delete - todo - fix this--}}
                        <form action="{{ route('lessons.destroy', $lesson->id) }}"
                              method="POST"
                              class="float-right"
                        >
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>

                        {{--                        <a href="{{ route('lessons.show', $lesson->id) }}">--}}
                        <a href="#{{ $lesson->id }}">
                            <div class="font-bold">
                                <p>
                                    {{--clock--}}
                                    <i class="fas fa-clock mr-1"></i>
                                    {{--start time - human--}}
                                    {{ $lesson->start_time->format('H:i a') }}
                                    {{--date--}}
                                    <i class="fas fa-calendar-alt ml-1"></i>
                                    {{ $lesson->start_time->format('d/m/Y') }}
                                </p>
                                {{--duration--}}
                                <small class="font-bold">({{ $lesson->duration }} minutes)</small>

                                <p class="font-bold">{{ $lesson->start_time->diffForHumans() }}</p>
                            </div>

                            <div class="flex">
                                <div class="flex-1 rounded p-1 m-1">
                                    <p>
                                        <i class="fas fa-chalkboard-teacher mr-1"></i>
                                        {{ $lesson->teacher->name }}
                                    </p>
                                    <p>
                                        <i class="fas fa-hourglass-half mr-1"></i>
                                        <small class="font-bold">Duration:</small>
                                        {{ $lesson->duration }}
                                        <small>minutes</small>
                                    </p>

                                </div>
                                <div class="flex-1 rounded p-1 m-1">
                                    <p>
                                        <i class="fas fa-user-graduate mr-1"></i>
                                        {{ $lesson->student->name }}
                                    </p>
                                    <p>
                                        <i class="fas fa-dollar-sign mr-1"></i>
                                        <small class="font-bold">Price:</small>
                                        ${{ $lesson->price }}
                                    </p>
                                </div>
                            </div>

                        </a>


                        {{--Buttons--}}
                        {{--Small Cancel, Complete, Edit Buttons--}}
                        <div>
                            <div class="flex">

                                <div class="flex-1 p-1">
                                    <button
{{--                                        href="{{ route('lessons.complete', $lesson->id) }}"--}}

                                        data-lesson-id="{{ $lesson->id }}"
                                       class="btn btn-sm btn-outline-success w-100 complete
                                        {{ $lesson->completed ? ' active' : '' }}"
                                    >

                                        @if($lesson->completed)
                                            {{ __('Completed') }}
                                            <i class="fas fa-check-circle mr-1"></i>
                                        @else
                                            <i class="fas fa-check mr-1"></i>
                                            {{ __('Complete') }}
                                        @endif

{{--                                        <i class="fas fa-check mr-1"></i>--}}
{{--                                        {{ __('Complete') }}--}}
                                    </button>

                                </div>

                                <div class="flex-1 p-1">
                                    <a href="{{ route('lessons.edit', $lesson->id) }}"
                                       class="btn btn-sm btn-outline-primary w-100">
                                        <i class="fas fa-edit mr-1"></i>
                                        {{ __('Edit') }}
                                    </a>
                                </div>

                                <div class="flex-1 p-1">
                                    <a href="{{ route('lessons.cancel', $lesson->id) }}"
                                       class="btn btn-sm btn-outline-danger w-100">
                                        <i class="fas fa-times-circle mr-1"></i>
                                        {{ __('Cancel') }}
                                    </a>
                                </div>


                            </div>
                        </div>

                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
