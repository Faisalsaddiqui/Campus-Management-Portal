<?php

namespace App\Services\Admin;

use App\Models\Enrollment;
use App\Models\Program;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentService
{

  public function createUserStudent(array $data): User
  {
    $user = DB::transaction(function () use ($data) {
      $userService = new UserService();

      $created = $userService->createUser($data);

      $created->enrollments()->create([
        'session_type' => $data['session_type'],
        'registration_number' => $this->generateRegNumber(),
        'session_start' => now()->year,
        'program_id' => $data['program'],
        'current_semester' => 1
      ]);

      $created->assignRole('student');

      return $created;
    });

    return $user;
  }


  public function generateRegNumber()
  {
    //Format: random 5 digits
    //append with admission year and branch name like
    // branch-year-registration

    $reg_number = rand(1, 9)  . rand(1, 9)   . rand(1, 9)  . rand(1, 9) .  rand(1, 9);
    if (Enrollment::where('registration_number', $reg_number)->where('session_start', Carbon::now()->year)->exists()) {
      $reg_number = $this->generateRegNumber();
    }
    return $reg_number;
  }
}
