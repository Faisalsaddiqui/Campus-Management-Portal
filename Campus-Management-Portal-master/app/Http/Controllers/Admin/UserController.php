<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;

use Illuminate\Http\Request;
use App\Traits\UserStudentTrait;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionsResource;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    use UserStudentTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = $request->all('search', 'role');

        $users = User::with(['roles'])->orderBy('name')
            ->filter($request->only('search', 'role'))
            ->paginate(10)
            ->withQueryString();


        return Inertia::render("Admin/Users/Index", [
            'users' => new UserCollection($users),
            'roles' => Role::select('name', 'id')->get(),
            'filters' => $filters,
            'permissions' => new PermissionsResource(User::class)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        if ($user->hasRole('student')) {
            $user->load(['enrollments', 'enrollments.program']);
        }
        return Inertia::render("Admin/Users/Show", [
            'user' => new UserResource($user),
            'permissions' =>  new PermissionsResource($user)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return Redirect::route('admin.users')->with('success', 'User deleted.');
    }
}
