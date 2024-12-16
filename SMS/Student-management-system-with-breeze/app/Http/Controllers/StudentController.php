<?php

namespace App\Http\Controllers;

use App\Models\classes;
use App\Models\parents;
use App\Models\students;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function studentClasses()
    {
        $studentClasses = classes::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Students retrieved successfully',
            'data' => $studentClasses
        ], 200);
    }

    public function index()
    {
        $students = students::with([
        'schedule'=>function($query){
            $query->select('id','title','start_time','end_time');
        },
        'classes'=>function($query){
           $query->select('id','year','section');
        },
        ])
        ->where('status',1)
        ->get();
        if (count($students) <= 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'No students found',
                'data' => []
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Students retrieved successfully',
            'data' => $students
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'grNumber' => 'required|string|max:30|unique:students,gr_no',
            'class' => 'required',
            'firstName' => 'required|string|max:20',
            'middleName' => 'nullable|string|max:20',
            'lastName' => 'required|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone' => 'required|string|max:20',
            'currentAddress' => 'required|string',
            'permanentAddress' => 'required|string',
            'email' => 'nullable|email|max:50|unique:students,email',
            'gender' => 'required|in:male,female,other',
            'dob' => 'required|date',
            'joining_date' => 'nullable|date',
            'status' => 'nullable|in:0,1,2',
            'emergency_contact' => 'required|string|max:20',
            'bloodGroup' => 'nullable|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
            'parentFirstName' => 'required|string|max:20',
            'parentLastName' => 'required|string|max:20',
            'parentEmail' => 'required|email|max:50',
            'parentPassword'=>'required|string|min:8',
            'parentPhone' => 'required|string|max:20',
            'parentDob' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        $student = new students();
        $student->class_id = $request->class;
        $student->parents_id = null;
        $student->gr_no = $request->grNumber;
        $student->first_name = $request->firstName;
        $student->middle_name = $request->middleName;
        $student->last_name = $request->lastName;
        $student->phone = $request->phone;
        $student->current_address = $request->currentAddress;
        $student->permanent_address = $request->permanentAddress;
        $student->email = $request->email;
        $student->gender = $request->gender;
        $student->schedule_id=$request->scheduled;

        $student->date_of_birth = date('Y-m-d', strtotime($request->dob));
        $student->joining_date = date('Y-m-d', strtotime($request->joining_date));
        $student->status = $request->status;
        $student->emergency_contact = $request->emergency_contact;
        $student->blood_group = $request->bloodGroup;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/photos', $filename);
            $student->photo = $filename;
        }
        $student->save();

        $parent = new parents();
        $parent->first_name = $request->parentFirstName;
        $parent->last_name = $request->parentLastName;
        $parent->email = $request->parentEmail;
        $parent->password=Hash::make($request->parentPassword);
        $parent->phone = $request->parentPhone;
        $parent->date_of_birth = date('Y-m-d', strtotime($request->parentDob));

        $parent->save();

        $student->parents_id = $parent->id;
        $student->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Student Stored Successfully',
            'data' => $student
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
    public function edit(string $id)
    {
        $teachers = students::find($id);
        if (!$teachers) {
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
        $validator = Validator::make($request->all(), [
            'gr_no' => 'required|string|max:30|unique:students,gr_no,' . $id,
            'class_id' => 'required',
            'parents_id' => 'required',
            'first_name' => 'required|string|max:20',
            'middle_name' => 'nullable|string|max:20',
            'last_name' => 'required|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone' => 'required|string|max:20',
            'current_address' => 'required|string',
            'permanent_address' => 'required|string',
            'email' => 'nullable|email|max:50|unique:students,email,' . $id,
            'gender' => 'required|in:male,female,other',
            'from_shift' => 'required|string|max:20',
            'to_shift' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'joining_date' => 'nullable|date',
            'status' => 'nullable|in:0,1,2',
            'emergency_contact' => 'required|string|max:20',
            'blood_group' => 'nullable|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $student = students::findOrFail($id);
        $student->class_id = $request->class_id;
        $student->parents_id = $request->parents_id;
        $student->gr_no = $request->gr_no;
        $student->first_name = $request->first_name;
        $student->middle_name = $request->middle_name;
        $student->last_name = $request->last_name;
        $student->phone = $request->phone;
        $student->current_address = $request->current_address;
        $student->permanent_address = $request->permanent_address;
        $student->email = $request->email;
        $student->gender = $request->gender;
        $student->from_shift = $request->from_shift;
        $student->to_shift = $request->to_shift;
        $student->date_of_birth = \Carbon\Carbon::createFromFormat('d-m-Y', $request->date_of_birth)->format('Y-m-d');
        $student->joining_date = \Carbon\Carbon::createFromFormat('d-m-Y', $request->joining_date)->format('Y-m-d');
        $student->status = $request->has('status') ? $request->status : null;
        $student->emergency_contact = $request->emergency_contact;
        $student->blood_group = $request->has('blood_group') ? $request->blood_group : null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/photos', $filename);
            $student->photo = $filename;
        }
        $student->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Student Updated Successfully',
            'data' => $student
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function view($id)
    {
            $student = students::with(['classes','parents','schedule'])->find($id);
            return response()->json([
                'success' => 'StudentData retrieved successfully',
                'status' => 'success',
                'data' => $student,
            ], 200);
            if(count($student) <= 0){
                return response()->json([
                    'error' => 'Data not found',
                    'status' => 'error',
                    'message' => 'Student not found',
                ], 404);
            }
    }
}
