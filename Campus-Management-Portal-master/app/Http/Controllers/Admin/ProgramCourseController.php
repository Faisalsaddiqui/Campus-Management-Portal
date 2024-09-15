<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\StoreCoursesForProgram;
use Inertia\Inertia;
use App\Models\Course;
use App\Models\Program;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseProgramRequest;
use App\Http\Resources\PermissionsResource;
use App\Http\Resources\ProgramResource;
use Illuminate\Support\Facades\Redirect;

class ProgramCourseController extends Controller
{
    public function index(Program $program, $semester)
    {
        $this->authorize('update', $program);


        if (!$this->hasSemester($semester, $program)) {
            return Redirect::route('admin.programs')->with('error', 'Semester is not available.');
        }

        $program_courses = $program->courses()->where('semester', $semester)->get();

        $courses =  Course::orderBy('course_name')
            ->get()
            ->transform(fn ($course) => [
                'id' => $course->id,
                'course_name' => $course->course_name,
                'course_code' => $course->course_code,
                'theory_credit_hours' => $course->theory_credit_hours,
                'practical_credit_hours' => $course->practical_credit_hours,
                'department_code' => $course->department_code,
                'belongs_to_program' => $program_courses->contains('id', $course->id),
                'credit_hours' => $course->credit_hours,
            ]);
        return Inertia::render('Admin/Programs/AddCourse', [
            'semester' => $semester,
            'program' => new ProgramResource($program),
            'courses' => $courses,
            'program_courses' => $program_courses,
            'permissions' => new PermissionsResource($program)
        ]);
    }

    public function store(StoreCourseProgramRequest $request, Program $program, $semester, StoreCoursesForProgram $storeCoursesForProgram)
    {
        $this->authorize('update', $program);
        if (!$this->hasSemester($semester, $program)) {
            return Redirect::route('admin.programs')->with('error', 'Semester is not available.');
        }

        $storeCoursesForProgram->handle($program, $request->courses, $semester);

        return Redirect::route('admin.programs.edit', $program->slug)->with('success', 'Courses added successfully');
    }

    private function hasSemester(int $semester, Program $program): bool
    {
        return $semester > 0 && $semester <= $program->degree->semesters;
    }
}
