<?php

namespace App\Http\Controllers\Applicant;

use Exception;
use Inertia\Inertia;
use App\Models\Program;
use Illuminate\Http\Request;
use App\Models\ApplicationStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\ProgramCollection;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Resources\ApplicationResource;
use App\Services\Applicant\ApplicationService;
use App\Services\Applicant\AcademicDetailService;

class ApplicationController extends Controller
{
    public function __construct()
    {
        //add middlewares
    }

    public function index(Request $request, AcademicDetailService $academicDetailService)
    {
        $applications = $request->user()
            ->applications()
            ->with(['program', 'program.department', 'program.degree', 'status'])->get();


        return Inertia::render('Applicant/Applications/Index', [
            'user' => new UserResource($request->user()->load('academicDetails')),
            'applications' =>  ApplicationResource::collection($applications),
            'max_allowed' => config('constants.application.max_allowed'),
            'canApply' => empty($academicDetailService->availableAcademicTypes(auth()->user()))
        ]);
    }

    public function create(Request $request, AcademicDetailService $academicDetailService)
    {
        if (!empty($academicDetailService->availableAcademicTypes(auth()->user()))) {
            return redirect()->back()->with('error', 'Add all academic details');
        }

        $applied_programs = auth()->user()->applications->pluck('program_id');

        $filters = $request->all('search');

        $programs =  Program::whereNotIn('id', $applied_programs)
            ->orderBy('slug')
            ->filter($request->only('search'))
            ->with(['department', 'degree'])
            ->paginate(10)
            ->withQueryString();

        return Inertia::render(
            'Applicant/Applications/Create',
            [
                'programs' => new ProgramCollection($programs),
                'max_allowed' => config('constants.application.max_allowed'),
                'filter' => $filters
            ]
        );
    }

    public function store(StoreApplicationRequest $request, ApplicationService $applicationService, AcademicDetailService $academicDetailService)
    {
        if (!empty($academicDetailService->availableAcademicTypes(auth()->user()))) {
            return redirect()->back()->with('error', 'Add all academic details');
        }


        $program = Program::find($request->program_id);

        try {
            $applicationService->validate(auth()->user(), $program);
        } catch (Exception $ex) {
            return Redirect::route('applicant.applications')->with('error', $ex->getMessage());
        }

        $request->user()->applications()->create([
            'program_id' => $request->program_id,
            'status_id' => ApplicationStatus::where('status', 'waiting review')->first()->id
        ]);

        return Redirect::route('applicant.applications')->with('success', 'Applied to ' . $program->full_program_name . ' successfully');
    }
}
