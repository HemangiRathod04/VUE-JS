<?php

namespace App\Http\Controllers;

use App\Models\Schedules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $scheduleList = Schedules::get();

        if (!$scheduleList) {
            return response()->json([
                'status' => 'error',
                'message' => 'No schedules found',
                'data' => [],
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'schedule Retrived Successfull',
            'data' => $scheduleList
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'start_time' => 'required_without:start_datetime|date_format:H:i',
            'end_time' => 'required_without:end_datetime|date_format:H:i',
            'start_datetime' => 'required_without:start_time|date_format:Y-m-d\TH:i',
            'end_datetime' => 'required_without:end_time|date_format:Y-m-d\TH:i',
            'type' => 'required|in:class,event,meeting,exam',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 422);
        }
        $schedule = new Schedules();
        $schedule->title = $request->title;
        $schedule->description = $request->description;
        $schedule->type = $request->type;
        if ($schedule->type == 'class') {
            $currentDate = date('Y-m-d');
            $schedule->start_time = date('Y-m-d H:i:s', strtotime($currentDate . ' ' . $request->start_time));
            $schedule->end_time = date('Y-m-d H:i:s', strtotime($currentDate . ' ' . $request->end_time));
       } else {
            $schedule->start_time = date('Y-m-d H:i:s', strtotime($request->start_datetime));
            $schedule->end_time = date('Y-m-d H:i:s', strtotime($request->end_datetime));
        }
        $schedule->save();

        return response()->json([
            'status'=>'success',
            'message'=>'Schedule created successfully',
            'data' => $schedule
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
