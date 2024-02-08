<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use App\Models\Invoice;
use App\Models\Lesson;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    private int|float $CACHE_TIME = 60 * 2; // 2 minutes

    /*
     * AdminController constructor.
     */
    public function __construct()
    {
    }

    // todo - lessons
    //  - Get through whole flow
    /*
    * Admin Dashboard
    * @return \Illuminate\Http\Response
    * */
    public function dashboard()
    {
//        $tables = DB::select('SHOW TABLES');
//        dd($tables);


        $users = User::all();
        $instruments = Instrument::all();
        return view('admin.dashboard', compact('users', 'instruments'));
    }

    /*
         * Admin Database
         * @return \Illuminate\Http\Response
         * */
    public function database()
    {
        return view('admin.database.index');
    }

    public function lessons()
    {
        $users = User::all();
        $instruments = Instrument::all();

        // Get Lessons, sort by most recent
//        $lessons = Lesson::with('teacher', 'student')->get();
//        $lessons = Lesson::with('teacher', 'student')->orderBy('start_time', 'desc')->get();
        $lessons = Lesson::with('teacher', 'student')->orderBy('created_at', 'desc')->get();

        // Get Teachers, Parents, Students
        $teachers = User::where('type', 'teacher')->get();
        $parents = User::where('type', 'parent')->get();
        $students = User::where('type', 'student')->get();

        // add random avatar to each user
        $teachers = $this->addRandomAvatar($teachers);
        $parents = $this->addRandomAvatar($parents);
        $students = $this->addRandomAvatar($students);

        // sort teachers, parents, students by name
        $teachers = $teachers->sortBy('name');
        $parents = $parents->sortBy('name');
        $students = $students->sortBy('name');
        $instruments = $instruments->sortBy('name');

        // todo - ----------------- fake data -----------------
        // Fake durations, 45, 60, 90
        $durations = [30, 45, 60, 90];
        // Fake Rates
        $rates = [30, 35, 40, 45, 50, 55, 60];

        // todo - ----------------- fake data -----------------


        $fields = [
            [
                'type' => 'select',
                'name' => 'teacher_id',
                'label' => 'Teacher',
                'options' => $teachers->map(function ($teacher) {
                    return [
                        'value' => $teacher->id,
                        'label' => $teacher->name
                    ];
                })->toArray(),
                'selected' => old('teacher_id'),
                'class' => 'form-select', // Optional: additional classes for styling
            ],
            [
                'type' => 'select',
                'name' => 'student_id',
                'label' => 'Student',
                'options' => $students->map(function ($student) {
                    return [
                        'value' => $student->id,
                        'label' => $student->name
                    ];
                })->toArray(),
                'selected' => old('student_id'),
                'class' => 'form-select', // Optional
            ],
            [
                'type' => 'select',
                'name' => 'instrument_id',
                'label' => 'Instrument',
                'options' => $instruments->map(function ($instrument) {
                    return [
                        'value' => $instrument->id,
                        'label' => $instrument->name
                    ];
                })->toArray(),
                'selected' => old('instrument_id'),
                'class' => 'form-select', // Optional
            ],
            [
                'type' => 'text',
                'name' => 'start_time',
                'label' => 'Start Time',
                'value' => old('start_time'),
                'class' => 'form-control start-time', // Optional: additional classes for styling
                'placeholder' => 'Start Time', // Optional
            ],
            [
                'type' => 'textarea',
                'name' => 'notes',
                'label' => 'Notes',
                'value' => old('notes'),
                'class' => 'form-control', // Optional: additional classes for styling
                'placeholder' => 'Notes', // Optional
            ],
            // ... Add more fields as necessary
        ];


        return view(
            'admin.lessons.index',
            compact('users', 'instruments', 'lessons', 'teachers', 'parents', 'students', 'durations', 'rates', 'fields')
        );
    }

    public function lessonsStore(Request $request)
    {
//        dd($request->all());

        // Validate request
        $request->validate([
            // todo - add validation
            'teacher_id' => 'required|numeric',
            'student_id' => 'required|numeric',
            'instrument_id' => 'required|numeric',

            'price' => 'required|numeric',
            'duration' => 'required|numeric',

//            'utcStartTime' => 'required|date',
        ]);
        // add duration to start time
        $startTime = Carbon::parse($request->startTime);
        // $endTime = $startTime->addMinutes((int) $request->duration);
        $endTime = Carbon::parse($request->startTime)->addMinutes((int)$request->duration);

       // dd($request->all() , $startTime , $endTime);

        try {
            $request->merge([
                'start_time' => $startTime->toDateTimeString(),
                'end_time' => $endTime->toDateTimeString(),
            ]);

            $lessonData = $request->only([
                'teacher_id',
                'student_id',
                'instrument_id',
                'price',
                'duration',
                'start_time',
                'end_time',
            ]);

            $lesson = Lesson::create($lessonData);
            $lesson->save();

            // Flash a success message to the session
            session()->flash('success', 'Saved successfully!');
            session()->flash('badgeMessage', 'Saved successfully!');

            // todo - if ajax, return json, else redirect back
//        return response()->json($lesson);
            return redirect()->back();
        } catch (Exception $e) {
            dd($e);
            // Handle the exception and maybe log it
            // return some error response
//            session()->flash('error', 'Error saving lesson!');
//            return redirect()->back();

        }
    }

    public function lessonsDestroy($id)
    {
        // todo - add some validation, etc...
        // todo - delete lesson
        $lesson = Lesson::find($id);
        $lesson->delete();
        // Flash a success message to the session
        session()->flash('lessonsTableSuccess', 'Deleted successfully!');
        return redirect()->back();
    }


    /*todo - invoices*/
    public function invoices()
    {
        $invoices = Invoice::all();
        $teachers = User::where('type', 'teacher')->get();
        $parents = User::where('type', 'parent')->get();
        $students = User::where('type', 'student')->get();
        $instruments = Instrument::all();

        // add random avatar to each user
        $teachers = $this->addRandomAvatar($teachers);
        $parents = $this->addRandomAvatar($parents);
        $students = $this->addRandomAvatar($students);

        // sort teachers, parents, students by name
        $teachers = $teachers->sortBy('name');
        $parents = $parents->sortBy('name');
        $students = $students->sortBy('name');
        $instruments = $instruments->sortBy('name');

        // todo - ----------------- fake data -----------------
        // Fake durations, 45, 60, 90
        $durations = [30, 45, 60, 90];
        // Fake Rates
        $rates = [30, 35, 40, 45, 50, 55, 60];
        // todo - ----------------- fake data -----------------

        return view('admin.invoices.index',
            compact('invoices', 'teachers', 'parents', 'students', 'instruments', 'durations', 'rates'));
    }

    public function invoicesStore(Request $request)
    {
        // Validate request
        $request->validate([
            // todo - add validation
            'teacher_id' => 'required|numeric',
            'student_id' => 'required|numeric',
            'instrument_id' => 'required|numeric',
            'price' => 'required|numeric',
            'duration' => 'required|numeric',
            'utcStartTime' => 'required|date',
        ]);

        // add duration to start time
        dd('invoicesStore');
        // todo - add some validation, etc...
        // todo - delete lesson
        // Flash a success message to the session
        session()->flash('success', 'Saved successfully!');
        return redirect()->back();
    }

    public function invoicesDestroy($id)
    {
        // todo - add some validation, etc...
        // todo - delete lesson
        // Flash a success message to the session
        session()->flash('success', 'Deleted successfully!');
        return redirect()->back();
    }


    public function users()
    {
        $users = User::all();
        $instruments = Instrument::all();
        $teachers = User::where('type', 'teacher')->get();
        $teachers = $this->addRandomAvatar($teachers);
        return view('admin.users.index', compact('users', 'instruments', 'teachers'));
    }

    // todo - fix teachers, parents, students, instruments
    public function teachers()
    {
        $teachers = User::where('type', 'teacher')->get();
        return view('admin.teachers.index', compact('teachers'));
    }

    public function parents()
    {
        $parents = User::where('type', 'parent')->get();
        return view('admin.parents.index', compact('parents'));
    }

    public function students()
    {
        $students = User::where('type', 'student')->get();
        return view('admin.students.index', compact('students'));
    }


    /*
     * Instruments Index
     * @return \Illuminate\Http\Response
     * */
    public function instruments()
    {
        $instruments = Instrument::all();
        return view('admin.instruments.index', compact('instruments'));
    }

    /*
     * Instruments Store
     * @return \Illuminate\Http\Response
     * */
    public function instrumentsStore(Request $request)
    {
        // Validate request
        $request->validate([
            'name' => 'required|string',
        ]);

        // Create instrument
        $instrument = Instrument::create($request->only(['name']));
        $instrument->save();

        // Flash a success message to the session
        session()->flash('success', 'Saved successfully!');
        return redirect()->back();
    }


    /* ------------------------------------------------ */

    public function rooms()
    {
        $users = User::all();
        $instruments = Instrument::all();
        return view('admin.rooms.index', compact('users', 'instruments'));
    }

    public function attendance()
    {
        $users = User::all();
        $instruments = Instrument::all();
        return view('admin.attendance.index', compact('users', 'instruments'));
    }

    public function messages()
    {
        $users = User::all();
        $instruments = Instrument::all();
        return view('admin.messages.index', compact('users', 'instruments'));
    }

    public function scheduler()
    {
        $users = User::all();
        $instruments = Instrument::all();
        return view('admin.scheduler.index', compact('users', 'instruments'));
    }

    public function settings()
    {
        $users = User::all();
        $instruments = Instrument::all();
        return view('admin.settings.index', compact('users', 'instruments'));
    }

    /* ------------------------------------------------ */


    /*
     * Admin Routes
     * @return \Illuminate\Http\JsonResponse
     * */
    public function superAdminRoute()
    {
        if ($this->isSuperAdmin()) {
            return response()->json(['message' => 'You are super admin']);
        } else
            return response()->json(['message' => 'You are not super admin']);
    }

    /*
     * cmac and youcef routes only
     * */
    private function isSuperAdmin()
    {
        // If is user id 1 or 20
        define('SUPER_ADMIN', [1, 20]);
        return in_array(auth()->user()->id, SUPER_ADMIN);
    }

    /*
 * Admin Dashboard
 * @return \Illuminate\Http\Response
 * */
    private function addRandomAvatar($users)
    {
        // avatars
        $data = ['user-1.jpeg', 'user-2.png', 'user-3.jpeg', 'user-4.jpeg'];
        // add random avatar to each user
        foreach ($users as $user) {
            $user->avatar = $data[array_rand($data)];
        }
        return $users;
    }


    /* ------------------------------------------------ */
    /*  ---------------- API Routes ------------------ */
    /*------------------------------------------------- */

    /*
     * API function for totals
     * @return \Illuminate\Http\JsonResponse
     * */
    public function apiTotals()
    {
        $cached = Cache::remember('totals', $this->CACHE_TIME, function () {
            return [
                'users' => User::count(),
                'admins' => User::where('type', 'admin')->count(),
                'teachers' => User::where('type', 'teacher')->count(),
                'parents' => User::where('type', 'parent')->count(),
                'students' => User::where('type', 'student')->count(),
                'instruments' => Instrument::count(),
                'lessons' => Lesson::count(),
            ];
        });

        return response()->json(['totals' => (array)$cached]);
    }

    /*
     * Get all users
     * @return \Illuminate\Http\JsonResponse
     * */
    public function allUsers()
    {
        $users = User::all();
        return response()->json($users);
    }

    /*
     * Get all teachers
     * @return \Illuminate\Http\JsonResponse
     * */
    public function allTeachers()
    {
        $teachers = User::where('type', 'teacher')->get();
        return response()->json($teachers);
    }

    /*
     * Get all parents
     * @return \Illuminate\Http\JsonResponse
     * */
    public function allParents()
    {
        $parents = User::where('type', 'parent')->get();
        return response()->json($parents);
    }

    /*
     * Get all students
     * @return \Illuminate\Http\JsonResponse
     * */
    public function allStudents()
    {
        $students = User::where('type', 'student')->get();
        return response()->json($students);
    }

}
