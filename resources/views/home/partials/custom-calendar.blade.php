@push('css')
    <style>
        .calendar {
            width: 100%;
        }
        .calendar-header .col,
        .calendar-week .col {
            border: 1px solid #ddd;
        }
        .calendar-header .col {
            font-weight: bold;
            text-align: center;
            background-color: #e9ecef;
            line-height: 40px;
            min-height: 40px;
        }
        .calendar-week .col {
            position: relative; /* Add position relative to the day cell */
            background-color: #f9f9f9;
        }

        .day {
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            position: relative; /* Ensure day cell is positioned relatively to contain absolutely positioned elements */
        }
        .day-number {
            position: absolute;
            top: 0;
            left: 0;
            font-weight: bold;
            padding: 5px;
            background-color: #c8c6c6;
            /*font-size: 1.2em;*/
            /*border: 1px solid gray;*/
        }
        .day-events {
            margin-top: 20px; /* Adjust as needed based on your design */
        }

        .event {
            background-color: #f3f3f3; /* Light background for the event; adjust as needed */
            /*padding: 5px;*/
            /*border-radius: 5px;*/
            /*margin-bottom: 5px; !* Space between events *!*/
        }
        .event-time {
            font-weight: bold;
        }
        .event-title {
            /* Style for the event title */
        }

        /* ... rest of your styles ... */
        .day:hover {
            background-color: #f0f0f0;
        }
        .day.active {
            background-color: #007bff;
            color: #fff;
        }
        .day.active:hover {
            background-color: #0069d9;
        }
        .day.today {
            background-color: #007bff;
            color: #fff;
        }
        .day.today:hover {
            background-color: #0069d9;
        }
        .day.disabled {
            color: #ddd;
            cursor: not-allowed;
        }
        .day.disabled:hover {
            background-color: #f9f9f9;
        }
        .day.selected {
            background-color: #007bff;
            color: #fff;
        }
        .day.selected:hover {
            background-color: #0069d9;
        }
    </style>
@endpush

@push('js')
    <script>

        /*
        * Create the calendar
        * */
        document.addEventListener('DOMContentLoaded', function () {
            const calendarContainer = document.querySelector('.calendar');

            function clearCalendar() {
                const calendarWeeks = calendarContainer.querySelectorAll('.calendar-week');
                calendarWeeks.forEach(week => week.remove());
            }

            function getDaysInMonth(month, year) {
                return new Date(year, month, 0).getDate();
            }

            // ... existing JS ...

            function addEvent(dayCell, time, title) {
                const eventDiv = document.createElement('div');
                eventDiv.className = 'event';

                const eventTime = document.createElement('div');
                eventTime.className = 'event-time';
                eventTime.innerText = time;

                const eventTitle = document.createElement('div');
                eventTitle.className = 'event-title';
                eventTitle.innerText = title;

                eventDiv.appendChild(eventTime);
                eventDiv.appendChild(eventTitle);

                dayCell.querySelector('.day-events').appendChild(eventDiv);
            }

            // Usage example:
            // Assuming you have a dayCell element and event data
            // addEvent(dayCell, '10:00 AM', 'Lesson with John');


            function createCalendar(year, month) {
                clearCalendar();

                const daysInMonth = getDaysInMonth(month + 1, year);
                let dayOfWeek = new Date(year, month).getDay();
                let dayCount = 1;

                // Create weeks
                while (dayCount <= daysInMonth) {
                    const weekRow = document.createElement('div');
                    weekRow.className = 'row calendar-week';

                    // Create days in week
                    let daysAdded = 0; // Track if any days were added in the week
                    for (let i = 0; i < 7; i++) {
                        const dayCell = document.createElement('div');
                        dayCell.className = 'col day';

                        // Structure inside each day cell
                        const dayNumber = document.createElement('span');
                        dayNumber.className = 'day-number';

                        const dayEvents = document.createElement('div');
                        dayEvents.className = 'day-events';

                        // Add the day number and events container to the day cell
                        dayCell.appendChild(dayNumber);
                        dayCell.appendChild(dayEvents);

                        if (dayCount <= daysInMonth && (i >= dayOfWeek || dayCount > 1)) {
                            dayNumber.innerText = dayCount; // Set the day number
                            dayCount++;
                            daysAdded++;

                            // Example of adding an event (you would use real data here)
                            // This is just to show the structure; you'd likely want to add events based on some condition or data
                            addEvent(dayCell, '10:00 AM', 'Lesson with John');
                        }

                        weekRow.appendChild(dayCell);
                    }

                    if (daysAdded > 0) {
                        calendarContainer.appendChild(weekRow);
                    } else {
                        // Break the loop if no days were added in the week, preventing an empty row
                        break;
                    }

                    dayOfWeek = 0; // Reset day of the week
                }
            }

// addEvent function as defined earlier...


            function createCalendar2(year, month) {
                clearCalendar();

                const daysInMonth = getDaysInMonth(month + 1, year);
                let dayOfWeek = new Date(year, month).getDay();
                let dayCount = 1;

                // Create weeks
                while (dayCount <= daysInMonth) {
                    const weekRow = document.createElement('div');
                    weekRow.className = 'row calendar-week';

                    // Create days in week
                    let daysAdded = 0; // Track if any days were added in the week
                    for (let i = 0; i < 7; i++) {
                        const dayCell = document.createElement('div');

                        // todo - I want to add more content to the day cell
                        // todo - like: if there is a lesson, show the lesson start time

                        dayCell.className = 'col day';

                        if (dayCount <= daysInMonth && (i >= dayOfWeek || dayCount > 1)) {
                            dayCell.innerText = dayCount;
                            dayCount++;
                            daysAdded++;
                        }

                        addEvent(dayCell, '10:00 AM', 'Lesson with John');

                        weekRow.appendChild(dayCell);
                    }

                    if (daysAdded > 0) {
                        calendarContainer.appendChild(weekRow);
                    } else {
                        // Break the loop if no days were added in the week, preventing an empty row
                        break;
                    }

                    dayOfWeek = 0; // Reset day of the week
                }
            }

            const today = new Date();
            createCalendar(today.getFullYear(), today.getMonth());
        });


        /*
        * Set/update the current date/time
        * */
        document.addEventListener('DOMContentLoaded', function () {
            function updateDateTime() {
                const now = new Date();
                document.getElementById('currentDateTime').innerText = now.toLocaleString('en-US', {
                    hour: 'numeric',
                    minute: 'numeric',
                    second: 'numeric',
                    hour12: true,
                    month: 'long',
                    day: 'numeric',
                    year: 'numeric'
                });
            }

            updateDateTime();
            setInterval(updateDateTime, 1000);
        });

    </script>
@endpush

<div class="card">
    <h5 class="card-header">
        <i class="fas fa-calendar-alt mr-1"></i>
        {{ __('Calendar') }}

        <div class="badge bg-secondary float-right p-2">
            <i class="fas fa-clock mr-2"></i>
            <span id="currentDateTime" class="float-right"></span>
        </div>
    </h5>
    <div class="card-body p-0">
        <div class="container">
            <div class="calendar">
                <div class="row calendar-header">
                    <div class="col">Sun</div>
                    <div class="col">Mon</div>
                    <div class="col">Tue</div>
                    <div class="col">Wed</div>
                    <div class="col">Thu</div>
                    <div class="col">Fri</div>
                    <div class="col">Sat</div>
                </div>
                <div class="row calendar-week">

                    {{--spinner--}}
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>

                    <div class="col day">

                        <span class="day-number">1</span> <!-- The day number -->

                        <!-- Example of how you might structure an event; repeat or loop through your events as needed -->
                        <div class="day-events">

                            <div class="event">
                                <div class="event-time">10:00 AM</div>
                                <div class="event-title">Lesson with John</div>
                            </div>
                            <!-- More events can go here -->

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
