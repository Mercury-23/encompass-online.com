@push('css')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        select:hover {
            cursor: pointer;
        }

        .event {
            position: absolute;
            width: 3px;
            height: 3px;
            border-radius: 150px;
            bottom: 3px;
            left: calc(50% - 1.5px);
            content: " ";
            display: block;
            background: #3d8eb9;
        }

        .event.busy {
            background: #f64747;
        }
    </style>
@endpush

@push('js')

    <script src="//cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>

        const $utcStartTime = $('.utc-start-time');

        $(document).ready(function () {
            // todo - tighten these up
            flatpickr(".start-time", {
                enableTime: true,
                dateFormat: "Y-m-d h:i K",
                minDate: "today",
                // defaultDate: new Date(),
                defaultHour: 12,
                defaultMinute: 0,
                minTime: "08:00",
                maxTime: "20:00",
                minuteIncrement: 15,
                onReady: function (selectedDates, dateStr, instance) {
                    console.log('onReady')
                    setUtcStartTime(dateStr)
                },
                onChange: function (selectedDates, dateStr, instance) {
                    console.log('onChange')
                    setUtcStartTime(dateStr)
                },
                onDayCreate: function (dObj, dStr, fp, dayElem) {
                    // Utilize dayElem.dateObj, which is the corresponding Date
                    // todo - these are dot events, not flatpickr events
                    //  todo - maybe show available days in green, busy days in red
                    // dummy logic
                    if (Math.random() < 0.15)
                        dayElem.innerHTML += "<span class='event'></span>";
                    else if (Math.random() > 0.85)
                        dayElem.innerHTML += "<span class='event busy'></span>";
                }
            });

            function setUtcStartTime(dateStr) {
                // Parse the dateStr to a moment object in local time
                let localDateTime = moment(dateStr);
                // Convert the localDateTime to UTC and format it for the database
                let utcDateTimeISO = localDateTime.utc().toISOString();
                $utcStartTime.val(utcDateTimeISO);
            }
        });

        // Document ready
        $(document).ready(function () {
            const $formBadges = $('form .badge');
            const $formAlerts = $('form .alert');
            const $saveBtn = $('form .save-btn');

            $saveBtn.on('click', function () {
                // add fa-spinner class
                $(this).find('i').addClass('fa-spinner fa-spin');
            });

            // close badge after 3 seconds
            setTimeout(function () {
                // $('.badge').remove();
                // $('.badge').addClass('d-none')
                $formBadges.addClass('animate__zoomOut');
                $formAlerts.addClass('animate__zoomOut');
                setTimeout(function () {
                    $formBadges.remove();
                    $formAlerts.remove();
                }, 1000);
            }, 5000);
        });

    </script>
@endpush

<div class="row my-2">
    <div class="col">

        {{-- todo - <form action="#" method="POST" class="" @submit.prevent="saveRecord()">--}}
        <form action="{{ route('admin.lessons.store') }}" method="POST" class="">
            @csrf
            {{--hidden utc start time--}}
            <input type="hidden" name="utcStartTime" class="utc-start-time">

            <div class="card mb-1">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h5>
                                <i class="fa-solid fa-calendar-alt mr-1"></i>
                                Create Lesson
                            </h5>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-success bg-success btn-sm px-4 float-right save-btn">
                                <i class="fas fa-save mr-1"></i>
                                Save
                            </button>
                        </div>
                    </div>

                    @if($errors->any() || session('badgeMessage'))
                        <div class="row mt-1">
                            <div class="col-12">
                                {{--Errors--}}
                                @if( $errors->any() )
                                    <span
                                        class="alert alert-danger text-center py-1 w-100 mb-0 animate__animated animate__zoomIn d-inline-block">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    <strong>Whoops!</strong> Please fix the errors and try again.
                                </span>
                                @endif

                                {{--Badge Message--}}
                                @if( session('badgeMessage') )
                                    <span
                                        class="alert alert-success text-center py-1 w-100 mb-0 animate__animated animate__zoomIn d-inline-block">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    <strong>{{ session('badgeMessage') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    @endif

                </div>

                <div class="card-body">
                    {{--Teacher, Student, Instrument--}}
                    <div class="row mb-1">
                        <div class="col-sm-6 col-md-4">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </span>
                                <select class="form-select" name="teacher_id" aria-label="Default Teacher">
                                    <option>Select Teacher...</option>
                                    @foreach($teachers as $teacher)
                                        <option
                                            value="{{ $teacher->id }}"{{ old('teacher_id') == $teacher->id ? 'selected' : ''}}>
                                            {{ $teacher->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="my-1">
                                @if ($errors->has('teacher_id'))
                                    <span class="text-danger">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                        Teacher is required!
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-user-graduate"></i>
                                </span>
                                <select class="form-select" name="student_id" aria-label="Default student example">
                                    <option selected>Select Student...</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}"
                                            {{ old('student_id') == $student->id ? 'selected' : ''}}>
                                            {{ $student->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="my-1">
                                @if ($errors->has('student_id'))
                                    <span class="text-danger">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                        Student is required!
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-guitar"></i>
                                </span>
                                <select class="form-select" name="instrument_id" aria-label="Default select example">
                                    @foreach($instruments as $instrument)
                                        <option value="{{ $instrument->id }}"
                                            {{ old('instrument_id') == $instrument->id ? 'selected' : ''}}>
                                            {{ $instrument->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="my-1">
                                @if ($errors->has('instrument_id'))
                                    <span class="text-danger">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                        Instrument is required!
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{--Rate, Start DateTime, Duration--}}
                    <div class="row mb-1">
                        <div class="col-6 col-md-4 my-1">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-dollar-sign"></i>
                                </span>
                                <select class="form-select" name="price" aria-label="Default select example">
                                    @foreach($rates as $rate)
                                        <option value="{{ $rate }}"
                                            {{ old('price') == $rate ? 'selected' : ''}}>
                                            {{ $rate }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 my-1">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-hourglass-half"></i>
                                </span>
                                <select class="form-select" name="duration" aria-label="Default select example">
                                    @foreach($durations as $duration)
                                        <option value="{{ $duration }}"
                                            {{ old('duration') == $duration ? 'selected' : ''}}>
                                            {{ $duration }} Minutes
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 my-1">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-calendar-alt"></i>
                                </span>
                                <label for="start-time"></label>
                                <input id="start-time"
                                       type="text"
                                       class="form-control start-time"
                                       name="startTime"
                                       placeholder="Start Time"
                                >
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    {{--Notes--}}
                    <div class="row">
                        <div class="col">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-sticky-note"></i>
                                </span>
                                <textarea class="form-control" name="notes" aria-label="With textarea"
                                          placeholder="Notes">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

