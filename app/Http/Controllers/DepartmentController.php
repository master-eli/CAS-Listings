<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Validator;
use Gate;

class DepartmentController extends Controller
{
    

    public function addDept()
    {
        if(Gate::allows('isAdmin')) {
            $departments = Role::orderBy('role', 'asc')->get();
            $role = Role::where('role', '=', 'Dean`s Office');

            return view('pages.addDept', compact('departments', 'role'));
        } else {
            return redirect()->back();
        }
    }

    public function storeDept(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'department_name' => 'required|unique:roles,role',
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            $department = new Role;
            $department->role = $request->input('department_name');
            $department->save();
           
            return response()->json($department); 
        }
    }
}
