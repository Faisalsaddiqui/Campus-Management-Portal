<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin']);
    }

    public function index(Request $request)
    {
        $user = User::find($request->user()->id);

        return  Inertia::render('Admin/Profile/Index', [
            'user' => $user,
        ]);
    }

    public function edit()
    {
        $user = User::find(auth()->user()->id);

        return Inertia::render('Admin/Profile/Edit', [
            'user' => $user,
        ]);
    }
}
