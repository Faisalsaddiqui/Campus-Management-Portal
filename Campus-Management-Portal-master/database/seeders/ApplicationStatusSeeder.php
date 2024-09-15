<?php

namespace Database\Seeders;

use App\Models\ApplicationStatus;
use Illuminate\Database\Seeder;

class ApplicationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ApplicationStatus::create(['status' => 'waiting review']);
        ApplicationStatus::create(['status' => 'pending fee']);
        ApplicationStatus::create(['status' => 'accepted']);
        ApplicationStatus::create(['status' => 'rejected']);
    }
}
