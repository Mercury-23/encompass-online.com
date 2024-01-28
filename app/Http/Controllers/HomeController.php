<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Instrument;
use App\Models\Invoice;
use App\Models\Lesson;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class HomeController extends Controller
{

    /*
     * Home Index
     * @return \Illuminate\Contracts\Support\Renderable
     * */
    public function index()
    {
        $user = Auth::getUser();

        // todo - only for testing
        if ($user->id === 1) {
            // load lessons
//            $user->load('lessons');
//            $user->lessons = $user->lessons()->get();

            return view('home.teacher', compact('user'));
        }

        if ($user->hasRole('teacher')) {
            return view('home.teacher', compact('user'));
        }

        if ($user->hasRole('parent')) {
            return view('home.parent', compact('user'));
        }

        if ($user->hasRole('student')) {
            return view('home.student', compact('user'));
        }

        if ($user->hasRole('admin')) {
            return view('home.admin', compact('user'));
        }

        // Send to error page
//        return view('home.error', compact('user'));
    }

    /*
     * Dashboard
     * @return \Illuminate\Contracts\Support\Renderable
     * */
    public function dashboard()
    {
        return view('pages.dashboard');
    }

    /*
     * Lessons
     * @return \Illuminate\Contracts\Support\Renderable
     * */
    public function lessonsShow()
    {
        dd('lessons');
//        return view('pages.lessons');
    }

    /*
     * Lessons Complete
     * @return \Illuminate\Contracts\Support\Renderable
     * */
    public function lessonsComplete(Request $request)
    {
        // todo - add validation
        //  - add validation for id, make sure model exists

        if ($request->id) {
            $lesson = Lesson::find($request->id);
            if (!$lesson) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lesson not found',
                ]);
            }
            $lesson->completed = !$lesson->completed;
            $lesson->save();
        }

        // return json
        return response()->json([
            'success' => true,
            'message' => 'Lesson Completed',
            'lesson' => $lesson,
        ]);
    }
}

