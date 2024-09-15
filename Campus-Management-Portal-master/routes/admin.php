<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\ProgramCourseController;

Route::group(['middleware' => ['auth', 'role:admin']], function () {
  Route::prefix('admin')->group(function () {
    Route::get('/', function () {
      return redirect('admin/dashboard');
    });
    //Dashboard
    Route::inertia('/dashboard', 'Admin/Dashboard/Index')->name('admin.dashboard');

    //Profile
    Route::get('/profile', [AdminProfileController::class, 'index'])->name('admin.profile');
    Route::get('/profile/edit', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');

    //Faculties
    Route::get('/faculties', [FacultyController::class, 'index'])->name('admin.faculties');
    Route::get('/faculties/create', [FacultyController::class, 'create'])->name('admin.faculties.create');
    Route::get('/faculties/{faculty}', [FacultyController::class, 'edit'])->name('admin.faculties.edit');

    Route::post('/faculties/create', [FacultyController::class, 'store'])->name('admin.faculties.store');
    Route::put('/faculties/{faculty}/update', [FacultyController::class, 'update'])->name('admin.faculties.update');
    Route::delete('/faculties/{faculty}/delete', [FacultyController::class, 'destroy'])->name('admin.faculties.destroy');

    //Departments
    Route::get('/departments', [DepartmentController::class, 'index'])->name('admin.departments');
    Route::get('/departments/create', [DepartmentController::class, 'create'])->name('admin.departments.create');
    Route::get('/departments/{department}', [DepartmentController::class, 'edit'])->name('admin.departments.edit');

    Route::post('/departments/create', [DepartmentController::class, 'store'])->name('admin.departments.store');
    Route::put('/departments/{department}/update', [DepartmentController::class, 'update'])->name('admin.departments.update');
    Route::delete('/departments/{department}/delete', [DepartmentController::class, 'destroy'])->name('admin.departments.destroy');

    //Programs
    Route::get('/programs', [ProgramController::class, 'index'])->name('admin.programs');
    Route::get('/programs/create', [ProgramController::class, 'create'])->name('admin.programs.create');
    Route::get('/programs/{program}', [ProgramController::class, 'edit'])->name('admin.programs.edit');

    Route::post('/programs/create', [ProgramController::class, 'store'])->name('admin.programs.store');
    Route::put('/programs/{program}/update', [ProgramController::class, 'update'])->name('admin.programs.update');
    Route::delete('/programs/{program}/delete', [ProgramController::class, 'destroy'])->name('admin.programs.destroy');

    //Courses
    Route::get('/courses', [CourseController::class, 'index'])->name('admin.courses');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('admin.courses.create');
    Route::get('/courses/{course}', [CourseController::class, 'edit'])->name('admin.courses.edit');

    Route::post('/courses/create', [CourseController::class, 'store'])->name('admin.courses.store');
    Route::put('/courses/{course}/update', [CourseController::class, 'update'])->name('admin.courses.update');
    Route::delete('/courses/{course}/delete', [CourseController::class, 'destroy'])->name('admin.courses.destroy');

    //ProgramCourses
    Route::get('/programs/{program}/{semester}/courses', [ProgramCourseController::class, 'index'])->name('admin.programs.courses');

    Route::put('/programs/{program}/{semester}/courses/add', [ProgramCourseController::class, 'store'])->name('admin.programs.courses.store');


    //Applications
    Route::get('/applications', [ApplicationController::class, 'index'])->name('admin.applications');
    Route::get('/applications/{application}', [ApplicationController::class, 'show'])->name('admin.applications.show');

    Route::put('/applications/{application}', [ApplicationController::class, 'update'])->name('admin.applications.update');

    //Users
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('admin.users.show');

    Route::delete('/users/{user}/delete', [UserController::class, 'destroy'])->name('admin.users.destroy');

    //User Admin
    Route::get('/users/admin/create', [AdminController::class, 'create'])->name('admin.users.admin.create');
    Route::get('/users/admin/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.admin.edit');

    Route::post('/users/admin/create', [AdminController::class, 'store'])->name('admin.users.admin.store');
    Route::put('/users/admin/{user}/update', [AdminController::class, 'update'])->name('admin.users.admin.update');

    //User Student
    Route::get('/users/student/create', [App\Http\Controllers\Admin\StudentController::class, 'create'])->name('admin.users.student.create');
    Route::get('/users/student/{user}', [App\Http\Controllers\Admin\StudentController::class, 'show'])->name('admin.users.student.show');

    Route::get('/users/student/{user}/edit', [App\Http\Controllers\Admin\StudentController::class, 'edit'])->name('admin.users.student.edit');

    Route::post('/users/student/create', [App\Http\Controllers\Admin\StudentController::class, 'store'])->name('admin.users.student.store');

    //User Teacher
    Route::get('/user/teacher/create', [TeacherController::class, 'create'])->name('admin.users.teacher.create');
  });
});
