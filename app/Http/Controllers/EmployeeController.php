<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $department = $request->department;
        $sort = $request->sort;

        /*
        Dynamic Query
        */
        $query = Employee::query()

        ->when($search, function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%");
        })

        ->when($department, function ($q) use ($department) {
            $q->where('department', $department);
        });

        /*
        Salary Sorting
        */
        if ($sort == 'salary_asc') {
            $query->orderBy('salary', 'asc');
        } elseif ($sort == 'salary_desc') {
            $query->orderBy('salary', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        /*
        Pagination
        */
        $employees = $query->paginate(5)->withQueryString();

        /*
        Dashboard Statistics
        */
        $totalEmployees = Employee::count();
        $totalSalary = Employee::sum('salary');
        $highestSalary = Employee::max('salary');
        $lowestSalary = Employee::min('salary');
        $averageSalary = Employee::avg('salary');

        /*
        Top Earners
        */
        $topEarners = Employee::orderBy('salary', 'desc')
                        ->take(5)
                        ->get();

        return view('employees.index', compact(
            'employees',
            'search',
            'department',
            'sort',
            'topEarners',
            'totalEmployees',
            'totalSalary',
            'highestSalary',
            'lowestSalary',
            'averageSalary'
        ));
    }
    public function edit($id)
{
    $employee = Employee::findOrFail($id);

    return view('employees.edit', compact('employee'));
}
public function update(Request $request,$id)
{
    $employee = Employee::findOrFail($id);

    $employee->update([
        'name'=>$request->name,
        'email'=>$request->email,
        'department'=>$request->department,
        'salary'=>$request->salary
    ]);

    return redirect()->route('employees.index')
    ->with('success','Employee updated successfully');
}
public function destroy($id)
{
    $employee = Employee::findOrFail($id);

    $employee->delete();

    return redirect()->route('employees.index')
    ->with('success','Employee deleted successfully');
}
}