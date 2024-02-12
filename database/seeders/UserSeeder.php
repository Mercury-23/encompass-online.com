<?php

namespace Database\Seeders;

use App\Models\Info;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $genders = ['male', 'female'];
        $teacherCount = $this->command->ask('How many teachers do you want to create?', 0);
        $studentCount = $this->command->ask('How many students do you want to create?', 0);
        $admin = $this->command->choice('Do you want to create an admin user?', ['yes', 'no'], 1);

        for ($i = 0; $i < $teacherCount; $i++) {
            // Create teacher user with info
            $f = $faker->firstName();
            $l = $faker->lastName();
            $teacher = User::create([
                'name' => $f . ' ' . $l,
                'first_name' =>  $f,
                'last_name' => $l,
                'email' => 'teacher_'.$faker->userName.'@' . $faker->domainName(),
                'type' => 'teacher',
                'password' => Hash::make('password'),
            ]);

            Info::create([
                'user_id' => $teacher->id,
                'information' => [
                    "tags" => [],
                    "gender" => $faker->randomElement($genders),
                    "grade" => $faker->numberBetween(1, 5),
                    "customer_number" => $faker->numberBetween(1000, 9999),
                    "inActive" => $faker->date(),
                    "enrollment" => $faker->date(),
                    "home_phone" => $faker->phoneNumber(),
                    "cell_phone" => $faker->phoneNumber(),
                    "background" => $faker->text(14),
                    "allergies" => $faker->text(5),
                ],
            ]);
        }
        for ($i = 0; $i < $studentCount; $i++) {
            $f = $faker->firstName();
            $l = $faker->lastName();
            // Create student user with info
            $student = User::create([
                'name' => $f . ' ' . $l,
                'first_name' =>  $f,
                'last_name' => $l,
                'email' => 'student_'.$faker->userName.'@' . $faker->domainName(),
                'type' => 'student',
                'password' => Hash::make('password'),
            ]);

            Info::create([
                'user_id' => $student->id,
                'information' => [
                    "tags" => [],
                    "gender" => $faker->randomElement($genders),
                    "grade" => $faker->numberBetween(1, 5),
                    "customer_number" => $faker->numberBetween(1000, 9999),
                    "inActive" => $faker->date(),
                    "enrollment" => $faker->date(),
                    "home_phone" => $faker->phoneNumber(),
                    "cell_phone" => $faker->phoneNumber(),
                    "background" => $faker->text(15),
                    "allergies" => $faker->text(5),

                    "source" => $faker->text(5),
                    "school_name" => $faker->name(),
                    "special_need" => $faker->text(5),
                    "notes" => $faker->text(),
                ],
            ]);
        }
        // Create admin user
        if ($admin) {
            $admin = User::create([
                'name' => 'Admin',
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin@' . $faker->domainName(),
                'type' => 'admin',
                'password' => Hash::make('password'),
            ]);
            Info::create([
                'user_id' => $admin->id,
                'information' => [
                    "tags" => [],
                    "gender" => $faker->randomElement($genders),
                    "grade" => $faker->numberBetween(1, 5),
                    "customer_number" => $faker->numberBetween(1000, 9999),
                    "inActive" => $faker->date(),
                    "enrollment" => $faker->date(),
                    "home_phone" => $faker->phoneNumber(),
                    "cell_phone" => $faker->phoneNumber(),
                    "background" => $faker->text(15),
                    "allergies" => $faker->text(5),
                ],
            ]);
        }
    }
}
