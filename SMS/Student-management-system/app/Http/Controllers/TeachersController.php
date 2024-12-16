<?php

namespace App\Http\Controllers;

use App\Models\Teachers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teachers::all();
        if (!$teachers) {
            return response()->json([
                'status' => 'error',
                'message' => 'No teachers found',
                'data' => []
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Teachers retrieved successfully',
            'data' => $teachers
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
            'name' => 'required|string|max:40',
            'email' => 'required|email|unique:teachers|max:40',
            'password' => 'required',
            'phone' => 'required|digits:10',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'required|date',
            'current_address' => 'nullable|string',
            'permanent_address' => 'nullable|string',
            // 'picture' => 'nullable|image|mimes:jpeg,jpg,png',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $teacher = new Teachers();
        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->password = Hash::make($request->password);
        $teacher->phone = $request->phone;
        $teacher->gender = $request->gender;
        $teacher->date_of_birth = Carbon::parse($request->date_of_birth);
        $teacher->current_address = $request->current_address;
        $teacher->permanent_address = $request->permanent_address;

        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $filename = time() . '.' . $picture->getClientOriginalExtension();
            $picture->storeAs('public/pictures', $filename);
            $teacher->picture = $filename;
        }
        $teacher->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Teacher created successfully',
            'data' => $teacher
        ], 201);
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
    public function edit(Request $request,string $id)
    {
         $teachers=Teachers::find($id);
         if(!$teachers){
            return response()->json([
                'status' => 'error',
                'message' => 'record not found',
                'data' => [],
            ], 201);
         }
         return response()->json([
            'status' => 'success',
            'message' => 'Teacher Retrived successfully',
            'data' => $teachers
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $teacher=Teachers::find($id);
        if(!$teacher){
            return response()->json([
                'status' => 'error',
                'message' => 'record not found',
                'data' => [],
            ], 201);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:40',
            'email' =>[
                'required',
                'email',
                'max:40',
                Rule::unique('teachers', 'email')->ignore($id),
            ],
            'password' => 'required|max:6',
            'phone' => 'required|digits:10',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'required|date',
            'current_address' => 'nullable|string',
            'permanent_address' => 'nullable|string',
            'picture' => 'image|mimes:jpeg,jpg,png',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
      
        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->password = Hash::make($request->password);
        $teacher->phone = $request->phone;
        $teacher->gender = $request->gender;
        $teacher->date_of_birth = Carbon::parse($request->date_of_birth);
        $teacher->current_address = $request->current_address;
        $teacher->permanent_address = $request->permanent_address; 

        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $filename = time() . '.' . $picture->getClientOriginalExtension();
            $picture->storeAs('public/pictures', $filename);
            $teacher->picture = $filename;
        }
        $teacher->update();
        return response()->json([
            'status' => 'success',
            'message' => 'Teacher Updated successfully',
            'data' => $teacher
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
