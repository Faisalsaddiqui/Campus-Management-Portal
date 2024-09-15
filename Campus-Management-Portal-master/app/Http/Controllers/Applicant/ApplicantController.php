<?php

namespace App\Http\Controllers\Applicant;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ApplicantController extends Controller
{
    public function dashboard(Request $request)
    {
        $notifications = [];

        //Hardcoded notification
        //Is shown when user first registers account
        //Remove hardcoded after adding database notifications

        if ($request->query('status') === 'registered') {
            $notifications = [[
                'text' => 'Welcome to  RL Academia. In order to apply on one of our programs, you need to add your academic details.'
            ]];
        }
        return Inertia::render("Applicant/Dashboard", [
            'notifications' => $notifications
        ]);
    }
}
