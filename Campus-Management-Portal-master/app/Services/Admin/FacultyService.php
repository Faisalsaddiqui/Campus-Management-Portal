<?php

namespace App\Services\Admin;

use App\Http\Resources\FacultyCollection;
use App\Models\User;
use App\Models\Faculty;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class FacultyService
{


  //Improve this
  public function getUserFaculties(User $user, array $filters)
  {

    $faculties = Faculty::when(auth()->user()->hasRole('super-admin'), function ($query) {
      return $query;
    })->when(!auth()->user()->hasRole('super-admin'), function ($query) {
      return $query->whereHas('admins', function ($query) {
        return $query->where('admin_id', '=', auth()->id());
      });
    });

    return $faculties;
  }

  public function getFacultyDepartments(Faculty $faculty): Collection
  {
    return $faculty->departments()->orderBy('department_name')->get()->map->only('id', 'department_name', 'slug');
  }
}
