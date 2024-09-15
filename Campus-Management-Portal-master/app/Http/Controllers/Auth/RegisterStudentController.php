<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RegisterStudentController extends Controller
{
    public function login()
    {
    }

    public function register()
    {
        return Inertia::render('Student/Index');
    }
}
