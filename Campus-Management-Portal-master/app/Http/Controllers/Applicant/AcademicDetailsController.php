<?php

namespace App\Http\Controllers\Applicant;

use Inertia\Inertia;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\AcademicDetailsResource;
use App\Http\Requests\StoreAcademicDetailRequest;
use App\Models\AcademicDetail;
use App\Services\Applicant\AcademicDetailService;
use Illuminate\Support\Facades\DB;

class AcademicDetailsController extends Controller
{
    public function index(AcademicDetailService $academicDetailService)
    {
        return Inertia::render('Applicant/AcademicDetails/Index', [
            'academic_details' =>  AcademicDetailsResource::collection(auth()->user()->academicDetails->load('organization')),
            'canAdd' => !empty($academicDetailService->availableAcademicTypes(auth()->user()))
        ]);
    }

    public function create(AcademicDetailService $academicDetailService)
    {
        if (empty($academicDetailService->availableAcademicTypes(auth()->user()))) {
            return Redirect::route('applicant.academic-details')->with('error', 'Already added all details. Delete previous if you want to add again');
        }

        return Inertia::render('Applicant/AcademicDetails/Create', [
            'organizations' => Organization::all(),
            'degreeTypes' => $academicDetailService->availableAcademicTypes(auth()->user())
        ]);
    }

    public function store(AcademicDetailService $academicDetailService, StoreAcademicDetailRequest $request)
    {
        if (empty($academicDetailService->availableAcademicTypes(auth()->user()))) {
            return Redirect::route('applicant.academic-details')->with('error', 'Already added all details. Delete previous if you want to add again');
        }

        try {
            DB::transaction(function () use ($request) {
                $academicDetail = auth()->user()->academicDetails()->create($request->validated());
                $this->addImage($academicDetail, $request->validated()['image']);
            });
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error: ' . $th->getMessage());
        }

        return Redirect::route('applicant.academic-details')->with('success', 'Added successfully!');
    }

    public function addImage(AcademicDetail $academicDetail, $image)
    {
        if ($academicDetail->media) {
            $academicDetail->media->delete();
        }
        $academicDetailMedia = $academicDetail->media()->create([]);
        $academicDetailMedia->baseMedia()->associate(
            $academicDetailMedia->addMedia($image)->toMediaCollection()
        )->save();
    }
}
