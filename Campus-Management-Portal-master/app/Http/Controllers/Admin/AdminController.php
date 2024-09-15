<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Faculty;
use App\Http\Controllers\Controller;
use App\Services\Admin\AdminService;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UpdateUserAdminRequest;
use App\Http\Resources\PermissionsResource;

class AdminController extends Controller
{
    public function create()
    {
        $this->authorize('create', User::class);

        return Inertia::render('Admin/Users/Admins/Create');
    }

    public function store(StoreUserRequest $request, AdminService $adminService)
    {
        $this->authorize('create', User::class);

        try {
            $adminService->createUserAdmin($request->validated());
        } catch (Exception $e) {
            return redirect()->route('admin.users')->with('error', $e->getMessage());
        }

        return redirect()->route('admin.users')->with('success', 'Admin created successfully');
    }


    public function edit(User $user)
    {

        $this->authorize('update', $user);
        return Inertia::render("Admin/Users/Admins/Edit", [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'roles' => $user->roles->pluck('name'),
                'faculties' => Faculty::select('id', 'faculty_name')->get()->transform(fn ($faculty) => [
                    'id' => $faculty->id,
                    'faculty_name' => $faculty->faculty_name,
                    'owns_faculty' => $user->faculties->contains($faculty->id),
                ]),
                'permissions' =>  [
                    'create_faculties' => $user->can('create_faculties'),
                    'update_faculties' => $user->can('update_faculties'),
                    'delete_faculties' => $user->can('delete_faculties'),
                    'create_users' => $user->can('create_users'),
                    'update_users' => $user->can('update_users'),
                    'delete_users' => $user->can('delete_users'),
                    'manage_applications' => $user->can('manage_applications'),
                    'manage_enrollments' => $user->can('manage_enrollments')
                ],
            ],
            'permissions' => new PermissionsResource($user)
        ]);
    }


    public function update(UpdateUserAdminRequest $request, User $user, AdminService $adminService)
    {

        $this->authorize('update', $user);
        $adminService->updateUserAdmin($request->validated(), $user);
        return Redirect::route('admin.users')->with('success', 'User updated.');
    }
}
