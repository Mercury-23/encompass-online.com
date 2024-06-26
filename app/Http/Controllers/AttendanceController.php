<?php

namespace App\Http\Controllers;

use App\Models\User;

class AttendanceController extends Controller
{
    public function index()
    {
        // Eager load address and bio relationships
        $users = User::with('address', 'bio')->get();

//        foreach ($users as $user) {
//            // Ensure 'address' is a loaded relation and 'address' field exists in the address model
//            echo $user->address->address ?? 'No address';
//            echo $user->bio->short_bio ?? 'No bio';
//        }

//        dd($users);
        return view('pages.attendance.index', compact('users'));
    }
}
