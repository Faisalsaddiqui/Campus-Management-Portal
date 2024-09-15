<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicationResource;
use App\Models\Application;
use App\Models\ApplicationStatus;
use Composer\XdebugHandler\Status;
use Illuminate\Support\Facades\Redirect;

class ApplicationController extends Controller
{
  public function index(Request $request)
  {
    $this->authorize('viewAny', Application::class);
    $filters = $request->all('search', 'status');

    $applications = Application::orderBy('created_at', 'DESC')
      ->with(['applicant', 'program', 'program.department', 'program.degree', 'status'])
      ->availableTo(auth()->user())
      ->filter($request->only('search', 'status'))
      ->paginate(10)
      ->withQueryString();

    return Inertia::render('Admin/Applications/Index', [
      'statuses' => ApplicationStatus::all(),
      'applications' =>  ApplicationResource::collection($applications),
      'filters' => $filters,
    ]);
  }

  public function show(Application $application)
  {
    return Inertia::render('Admin/Applications/Show', [
      'application' => new ApplicationResource($application->load('applicant', 'program', 'applicant.academicDetails', 'applicant.academicDetails.organization'))
    ]);
  }

  public function update(Application $application, Request $request)
  {
    $request->validate([
      'status' => 'required|in:accepted,rejected'
    ]);

    $status = ApplicationStatus::where('status', $request->status)->first();
    $application->update([
      'status_id' => $status->id
    ]);

    return Redirect::route('admin.applications')->with('success', 'Updated to ' . $status->status . ' succcessfully');
  }
}
