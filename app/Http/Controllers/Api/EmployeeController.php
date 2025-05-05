<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Employee::with('employeeDetail', 'department')->paginate(50);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees',
            'department_id' => 'required|exists:departments,id',
            'designation' => 'required',
            'salary' => 'required|numeric',
            'address' => 'nullable|string',
            'joined_date' => 'required|date',
        ]);

        $employee = Employee::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'email' => $request->email,
            'department_id' => $request->department_id,
        ]);

        $employee->detail()->create($request->only(['designation', 'salary', 'address', 'joined_date']));

        return response()->json($employee->load('detail'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Employee::with('department', 'detail')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->update($request->only(['name', 'email', 'department_id']));
        $employee->detail()->update($request->only(['designation', 'salary', 'address', 'joined_date']));
        return response()->json($employee->load('detail'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Employee::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
