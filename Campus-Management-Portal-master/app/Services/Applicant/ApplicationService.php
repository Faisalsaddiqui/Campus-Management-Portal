<?php

namespace App\Services\Applicant;

use App\Models\Program;
use App\Models\User;
use Exception;

class ApplicationService
{
  /**
   * 
   * Validate if user can apply
   * 
   */
  public function validate(User $user, Program $program)
  {
    if ($user->applications->contains('program_id', $program->id)) {
      throw new Exception("Already applied to " . $program->full_program_name);
    }
    if ($user->applications()->count() >= config('constants.application.max_allowed')) {
      throw new Exception("Applied 5 times. Cannot apply anymore!");
    }
  }
}
