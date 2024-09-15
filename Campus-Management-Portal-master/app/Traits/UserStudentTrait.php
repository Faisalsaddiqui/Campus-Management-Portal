<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Models\Student;
use Error;

trait UserStudentTrait
{
  public function generateRegNumber()
  {
    //Format: random 5 digits
    //append with admission year and branch name like
    // branch-year-registration

    $reg_number = rand(1, 9)  . rand(1, 9)   . rand(1, 9)  . rand(1, 9) .  rand(1, 9);
    if (Student::where('registration_number', $reg_number)->where('admission_year', Carbon::now()->year)->exists()) {
      $reg_number = $this->generateRegNumber();
    }
    return $reg_number;
  }
}
