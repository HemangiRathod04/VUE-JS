<?php

namespace App\Http\Controllers;

use App\Models\classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes=classes::with('teacher')->get();
        if (count($classes) <= 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'No Class found',
                'data' => []
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Classes Retrieved Successfully',
            'data' => $classes
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
        $validator= Validator::make($request->all(),[
          'year'=>'required',
          'section'=>'required',
          'teacher_id'=>'required',
          'status'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        
        $existingClass = Classes::where('year', $request->year)
        ->where('section', $request->section)
        ->first();

    if ($existingClass) {
        return response()->json([
            'status' => 'error',
            'message' => 'Class Already Exists!',
        ], 409); 
    }


        $classes= new classes();
        $classes->year=$request->year;
        $classes->section=$request->section;
        $classes->teacher_id=$request->teacher_id;
        $classes->status=$request->status;
        $classes->save();

        return response()->json([
            'status'=>'success',
            'message'=>'Class Added Successfully',
            'data'=>$classes
        ],201);
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
        $validator = Validator::make($request->all(), [
            'year' => 'required',
            'section' => 'required',
            'teacher_id' => 'required',
            'status' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
    
        // $existingClass = Classes::where('year', $request->year)
        //     ->where('section', $request->section)
        //     ->where('id', '!=', $id)
        //     ->first();
    
        // if ($existingClass) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Class Already Exists!',
        //     ], 409); 
        // }
    
        $classes = Classes::find($id);
        if (!$classes) {
            return response()->json([
                'status' => 'error',
                'message' => 'Class Not Found!',
            ], 404);
        }
    
        $classes->year = $request->year;
        $classes->section = $request->section;
        $classes->teacher_id = $request->teacher_id;
        $classes->status = $request->status;
        $classes->save();
    
        return response()->json([
            'status' => 'success',
            'message' => 'Class Updated Successfully',
            'data' => $classes
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
