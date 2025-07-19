<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Report;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Models\User;
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

    public function myindex()
    {
        $reports = User::with('reports')->find(auth()->id());
        return response()->json([
            'status' => 200,
            'message' => 'success retrive my report',
            'data' => $reports->reports
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReportRequest $request)
    {
        $valid = $request->validated();

        $selfi_path = $request->file('selfi_path')->store('selfie', 'public');

        $photo_path = $request->file('photo_path')->store('photo_report', 'public');
        $report = Report::create([
            'user_id' => auth()->id(),
            'description' => $request->input('description'),
            'selfi_path' => url('storage/' . $selfi_path),
            'photo_path' => url('storage/' . $photo_path),
            'location' => $request->input('location'),
            'status' => 'open',
            'type' => $request->input('type')
        ]);






        $randomUser = User::role($request->input('type'))->inRandomOrder()->first();


        $assigned = Assignment::create([
            'user_id' => $randomUser->id,
            'report_id' => $report->id
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
        return response()->json([
            'status' => 200,
            'data' => $report
        ]);
    }

    public function close(Request $request, Report $report)
    {
        if ($request->input('close')) {
            $report->update([
                'status' => 'closed'
            ]);
            $report->save();
            return response()->json([
                'status' => 200,
                'data' => 'successfully closed'
            ]);
        }
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
