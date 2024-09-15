<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Course;
use App\Models\Faculty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Resources\CourseCollection;
use App\Http\Resources\CourseResource;
use App\Http\Resources\PermissionsResource;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->all('search');

        $courses =  Course::orderBy('course_name')
            ->filter($request->only('search'))
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Admin/Courses/Index', [
            'courses' => new CourseCollection($courses),
            'permissions' => new PermissionsResource(Course::class),
            'filters' => $filters,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Courses/Create');
    }

    public function store(StoreCourseRequest $request)
    {
        $this->authorize('create', Course::class);
        Course::create($request->validated());

        return redirect()->route('admin.courses')->with('success', 'Course created successfully.');
    }

    public function edit(Course $course)
    {
        $this->authorize('update', $course);

        return Inertia::render("Admin/Courses/Edit", [
            'course' => new CourseResource($course),
            'permissions' => new PermissionsResource($course)
        ]);
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $this->authorize('update', $course);

        $course->update($request->validated());

        return redirect()->route('admin.courses')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $this->authorize('delete', $course);

        $course->delete();

        return redirect()->route('admin.courses')->with('success', 'Course deleted successfully.');
    }
}
