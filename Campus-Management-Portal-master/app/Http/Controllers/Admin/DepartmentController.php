<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Faculty;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Http\Resources\DepartmentCollection;
use App\Http\Resources\DepartmentResource;
use App\Http\Resources\PermissionsResource;
use Illuminate\Support\Facades\Redirect;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->all('search');

        $departments =
            Department::with(['faculty'])
            ->availableTo(auth()->user())
            ->orderBy('department_name')
            ->filter($request->only('search'))
            ->paginate(10)
            ->withQueryString();

        return Inertia::render(
            "Admin/Departments/Index",
            [
                'departments' => new DepartmentCollection($departments),
                'filters' => $filters,
                'permissions' => new PermissionsResource(Department::class)
            ]
        );
    }

    public function create()
    {
        $this->authorize('create', Faculty::class);

        $faculties = Faculty::select('faculty_name', 'id')->get();
        return Inertia::render("Admin/Departments/Create", [
            'faculties' => $faculties,
            'permissions' => [
                'create' => auth()->user()->can('create', Department::class),
            ]
        ]);
    }

    public function edit(Department $department)
    {
        $this->authorize('view', $department);

        return Inertia::render("Admin/Departments/Edit", [
            'department' => [
                'id' => $department->id,
                'department_name' => $department->department_name,
                'slug' => $department->slug,
                'faculty_name' => $department->faculty->faculty_name,
                'faculty_id' => $department->faculty->id,
            ],


            'faculties' => Faculty::select('faculty_name', 'id')->get(),
            'permissions' => [
                'update' => auth()->user()->can('update', $department),
                'delete' => auth()->user()->can('delete', $department),
            ],
        ]);
    }

    public function store(StoreDepartmentRequest $request)
    {
        $this->authorize('create', Faculty::class);

        $faculty = Faculty::find($request->faculty_id);

        $faculty->departments()->create($request->validated());
        return Redirect::route('admin.departments')->with('success', 'Department created.');
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $this->authorize('update', $department);
        $department->update($request->validated());
        return Redirect::route('admin.departments')->with('success', 'Department updated.');
    }

    public function destroy(Department $department)
    {
        $this->authorize('delete', $department);
        $department->delete();
        return Redirect::route('admin.departments')->with('success', 'Department deleted.');
    }
}
