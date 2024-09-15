<?php

namespace App\Http\Controllers\Student;

use Inertia\Inertia;
use App\Models\Program;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseDetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:student']);
    }

    public function index(Request $request)
    {

        $student = Student::with(['program'])->findOrFail($request->user()->id);

        $programs = null;
        if (!$student->program()->exists()) {
            $programs = Program::all()->map(function ($program) {
                return [
                    'id' => $program->id,
                    'program_name' => $program->program_name,
                ];
            });
        }


        return Inertia::render("Student/CourseDetails/Index", [
            'student' => $student,
            'programs' => $programs
        ]);
    }


    public function enroll(Request $request)
    {
        $student = Student::find($request->user()->id);
        if (!$student->program()->exists()) {
            $student->update($request->only(['program_id']));
        }
    }
}
