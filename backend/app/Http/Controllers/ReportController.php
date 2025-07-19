<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::all();
        return response()->json([
            'status' => 200,
            'message' => 'success retrive all reports',
            'data' => $reports
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReportRequest $request)
    {
        $valid = $request->validated();

        $selfi_path = $request->file('selfi_path')->store('selfie');

        $photo_path = $request->file('photo_path')->store('photo_report', 'public');
        $report = Report::create([
            'user_id' => auth()->id(),
            'description' => $valid->description,
            'selfi_path' => $selfi_path,
            'photo_path' => $photo_path,
            'location' => $valid->location,
            'status' => 'open',
            'type' => $valid->type
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'successfully create report',
            'data' => $report
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportRequest $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }
}
