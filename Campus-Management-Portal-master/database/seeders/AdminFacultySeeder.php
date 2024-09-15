<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminFacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all faculties
        $faculties = Faculty::all();

        // Populate the pivot table
        $user = User::whereHas("roles", function ($q) {
            $q->where("name", "admin");
        })->get();
        $user->each(function ($user) use ($faculties) {

            $user->faculties()->attach(
                $faculties->random(rand(1, 7))->pluck('id')->toArray()
            );
        });
    }
}
