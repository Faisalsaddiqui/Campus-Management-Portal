<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Super Admin',
            'father_name' => 'test',
            'email' => 'admin@mail.com',
            'cnic' => '1234567890123',
            'phone' => '03001234567',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password'
        ]);

        $user->assignRole('super-admin');
        $user->assignRole('admin');
    }
}
