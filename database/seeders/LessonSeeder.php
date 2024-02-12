<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use App\Models\Instrument;
use App\Models\Lesson;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $lessonsCount = $this->command->ask('How many lessons do you want to create?', 30);

        // Get all teachers and students
        $teachers = User::where('type', 'teacher')->get();
        $students = User::where('type', 'student')->get();
        $instruments = Instrument::all();
        // Generate lessons
        // $lessonsCount = 30; // Change this to the number of lessons you want to create

        for ($i = 0; $i < $lessonsCount; $i++) {
            // Get a random teacher and student
            $teacher = $teachers->random();
            $student = $students->random();
            $instrument = $instruments->random();
            // Generate random start time and end time within the last month
            $startTime = Carbon::now()->subDays(rand(0, 30))->addHours(rand(0, 23))->addMinutes(rand(0, 59));
            $endTime = $startTime->copy()->addMinutes(rand(30, 180)); // Assuming lessons last between 30 minutes to 3 hours

            // Randomly select the completed status
            $completed = $faker->randomElement([0, 1]);

            // Set completed to 2 if end_time is in the past
            if ($endTime->isPast()) {
                $completed = 2;
            }
            // Create a new lesson
            Lesson::create([
                'teacher_id' => $teacher->id,
                'student_id' => $student->id,
                'instrument_id' => $instrument->id,
                'completed' => $completed,
                'price' => $faker->randomElement([30, 45, 50, 60, 70]),
                'start_time' => $startTime,
                'end_time' => $endTime,
            ]);
        }
    }
}
