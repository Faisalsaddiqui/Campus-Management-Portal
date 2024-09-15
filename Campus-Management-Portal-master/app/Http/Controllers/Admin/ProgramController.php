<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Degree;
use App\Models\Faculty;
use App\Models\Program;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProgramRequest;
use App\Http\Requests\UpdateProgramRequest;
use App\Http\Resources\CourseCollection;
use App\Http\Resources\DegreeCollection;
use App\Http\Resources\DepartmentCollection;
use App\Http\Resources\PermissionsResource;
use App\Http\Resources\ProgramCollection;
use App\Http\Resources\ProgramResource;

class ProgramController extends Controller
{
  public function index(Request $request)
  {
    $filters = $request->all('search', 'degree');

    $programs =  Program::orderBy('slug')
      ->filter($request->only('search', 'degree'))
      ->with(['department', 'degree'])
      ->paginate(10)
      ->withQueryString();

    return Inertia::render("Admin/Programs/Index", [
      'programs' =>  new ProgramCollection($programs),
      'degrees' => new DegreeCollection(Degree::all()),
      'permissions' => new PermissionsResource(Program::class),
      'filters' => $filters,
    ]);
  }


  public function create()
  {
    $this->authorize('create', Program::class);

    return Inertia::render("Admin/Programs/Create", [
      'departments' => new DepartmentCollection(Department::all()),
      'degrees' => new DegreeCollection(Degree::all())
    ]);
  }


  public function store(StoreProgramRequest $request)
  {
    $this->authorize('create', Faculty::class);
    Program::create($request->validated());
    return redirect()->route('admin.programs')->with('success', 'Program created successfully.');
  }

  public function edit(Program $program)
  {
    $this->authorize('update', $program);

    return Inertia::render("Admin/Programs/Edit", [
      'program' => new ProgramResource($program),
      'courses' => new CourseCollection($program->courses()->orderBy('semester')->get()),
      'departments' => new DepartmentCollection(Department::all()),
      'degrees' => new DegreeCollection(Degree::all()),
      'permissions' => new PermissionsResource($program),
    ]);
  }

  public function update(UpdateProgramRequest $request, Program $program)
  {
    $this->authorize('update', $program);
    $program->update($request->validated());
    return redirect()->route('admin.programs')->with('success', 'Program updated successfully.');
  }

  public function destroy(Program $program)
  {
    $this->authorize('delete', $program);

    $program->delete();

    return redirect()->route('admin.programs')->with('success', 'Program deleted successfully.');
  }
}
