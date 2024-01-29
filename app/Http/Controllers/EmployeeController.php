<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function showEmployees(){
        $employees = User::where('role_id' , 3)->get();
        return $employees;
    }

    public function handleCreateEmployee(Request $request){

        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required',
            'password' => 'required|string',
        ]);

        $employee = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'Employee created successfully', 'data' => $employee], 201);
    }

    public function handleUpdateEmployee(Request $request, $user_id){

        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email',
            'password' => 'string',
        ]);


        $employee = User::findOrFail($user_id);

        $employee->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'Employee updated successfully', 'data' => $employee], 200);
    }

    public function handleDeleteEmployee($user_id){
        $employee = User::findOrFail($user_id);
        $employee->delete();

        return response()->json(['message' => 'Employee deleted successfully' ], 200);
    }
}
