<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Assignment;
use App\Http\Requests\StoreAssignmentRequest;
use App\Http\Requests\UpdateAssignmentRequest;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assignments = Assignment::all();

        return response()->json([
            'status' => 200,
            'message' => 'success retrive all assignments',
            'data' => $assignments
        ]);
    }

    public function myindex()
    {
        $assignments = User::with('assignments', 'reports')->find(auth()->id());

        return response()->json([
            'status' => 200,
            'message' => 'success retrive my assignments',
            'data' => $assignments->assignments
        ], 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAssignmentRequest $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Assignment $assignment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assignment $assignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAssignmentRequest $request, Assignment $assignment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assignment $assignment)
    {
        //
    }
}
