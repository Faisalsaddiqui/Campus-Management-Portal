<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:student']);
    }

    public function index(Request $request)
    {
        $user = User::with('student')->findOrFail($request->user()->id);

        return  Inertia::render('Student/Profile/Index', [
            'user' => $user,
        ]);
    }
}
