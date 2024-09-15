<?php

namespace App\Actions\Admin;

use Illuminate\Support\Facades\DB;

class StoreCoursesForProgram
{

  public function handle($program, $courses, $semester)
  {
    //Filter where course belongs to program, and grab course ids
    DB::transaction(function () use ($program, $courses, $semester) {
      $selected_courses = array_column(array_filter($courses, function ($course) {
        return $course['belongs_to_program'] == true;
      }), 'id');


      //Detaching course where semester is given semester from program
      $program->courses()->wherePivot('semester', '=', $semester)->detach();


      //Attach courses sent from frontend to program with given semester
      $program->courses()->attach($selected_courses, ['semester' => $semester]);
    });
  }
}
