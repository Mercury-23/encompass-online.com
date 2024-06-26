<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /*
     * Home Index
     * @return \Illuminate\Contracts\Support\Renderable
     * */
    public function index()
    {
        $user = Auth::getUser();

        if ($user->hasRole('admin')) {
            return view('home.admin', compact('user'));
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
