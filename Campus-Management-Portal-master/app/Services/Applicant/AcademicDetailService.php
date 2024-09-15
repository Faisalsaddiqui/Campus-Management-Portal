<?php

namespace App\Services\Applicant;

use App\Models\User;

class AcademicDetailService
{
  /**
   * 
   * Returns possible academic types
   * @return array
   * 
   */
  public function availableAcademicTypes(User $user)
  {
    $degree_types = config('constants.academic_details.degree_types');
    $user_types = $user->academicDetails->pluck('type')->toArray();
    $intersection = array_intersect(array_keys($degree_types), $user_types);
    $degree_types = array_diff_key($degree_types, array_flip($intersection));
    return $degree_types;
  }
}
