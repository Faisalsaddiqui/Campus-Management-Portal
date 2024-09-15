<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Program;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Traits\UserStudentTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserStudentRequest;
use App\Http\Resources\PermissionsResource;
use App\Http\Resources\ProgramCollection;
use App\Http\Resources\UserResource;
use App\Services\Admin\StudentService;
use Exception;

class StudentController extends Controller
{

    public function create()
    {
        $this->authorize('create', User::class);

        $programs = Program::with(['department', 'degree'])->get();

        return Inertia::render('Admin/Users/Students/Create', [
            'programs' => new ProgramCollection($programs)
        ]);
    }

    public function store(StoreUserStudentRequest $request, StudentService $studentService)
    {
        $this->authorize('create', User::class);

        $studentService->createUserStudent($request->validated());

        return redirect()->route('admin.users')->with('success', 'Student created successfully');
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return Inertia::render('Admin/Users/Students/Edit', [
            'user' => new UserResource($user->load(['enrollments', 'enrollments.program'])),
            'permissions' => new PermissionsResource($user),
        ]);
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        //add student info validation

        $user->update($request->validated());

        return redirect()->route('admin.users')->with('success', 'Student updated successfully');
    }

    public function show(User $user)
    {
        return Inertia::render("Admin/Users/Students/Show", [
            'user' => new UserResource($user->load(['student', 'student.program'])),
            'permissions' => new PermissionsResource($user),
        ]);
    }
}
