<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

class EmployeeController extends Controller
{

    public function index()
    {
        $employees = Employee::with(['department', 'designation', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        $departments = Department::where('status', 'active')->get();
        $designations = Designation::with('department')->get();
        
        return view('employees.index', compact(
            'employees',
            'departments',
            'designations'
        ));
    }

    public function datatable(Request $request)
    {
        $columns = [
            0 => 'employee_code',
            1 => 'first_name',
            2 => 'department_id',
            3 => 'designation_id',
            4 => 'employment_status',
        ];

        $limit = $request->input('length');
        $start = $request->input('start');
        $orderColumnIndex = $request->input('order.0.column');
        $order = $columns[$orderColumnIndex] ?? 'created_at';
        $dir   = $request->input('order.0.dir') ?? 'desc';

        $query = Employee::with(['department', 'designation']);

        // DATATABLE DEFAULT SEARCH
        if ($request->filled('search.value')) {
            $search = $request->input('search.value');

            $query->where(function ($q) use ($search) {
                $q->where('employee_code', 'like', "%{$search}%")
                ->orWhere('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhereHas('department', function ($d) use ($search) {
                        $d->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('designation', function ($d) use ($search) {
                        $d->where('title', 'like', "%{$search}%");
                });
            });
        }

        // CUSTOM TEXT SEARCH (FILTER BOX)
        if ($request->filled('search_text')) {
            $search = $request->search_text;

            $query->where(function ($q) use ($search) {
                $q->where('employee_code', 'like', "%{$search}%")
                ->orWhere('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        // DEPARTMENT FILTER
        if ($request->filled('department')) {
            $query->where('department_id', $request->department);
        }

        // COUNTS (VERY IMPORTANT)
        $totalData = Employee::count();
        $totalFiltered = $query->count();

        // PAGINATION + ORDER
        $employees = $query
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

        // RESPONSE DATA
        $data = [];

        foreach ($employees as $employee) {
            $data[] = [
                'id'            => $employee->id,
                'employee_code' => $employee->employee_code,
                'first_name'    => $employee->first_name,
                'last_name'     => $employee->last_name,
                'name' => '
                    <div class="flex items-center">
                        <img class="h-10 w-10 rounded-full"
                            src="'.($employee->profile_photo
                                ? asset('storage/'.$employee->profile_photo)
                                : 'https://ui-avatars.com/api/?name='.urlencode($employee->first_name.' '.$employee->last_name)).'">
                        <div class="ml-3">
                            <div class="font-medium">'.$employee->first_name.' '.$employee->last_name.'</div>
                            <div class="text-sm text-gray-500">'.$employee->personal_email.'</div>
                        </div>
                    </div>
                ',
                'gender'=> $employee->gender,
                'personal_email'=> $employee->personal_email,
                'department'  => optional($employee->department)->name ?? '-',
                'designation' => optional($employee->designation)->title ?? '-',
                'designation_id'=> $employee->designation_id,
                'department_id' => $employee->department_id,
                'current_address' => $employee->current_address,
                'employment_type' => $employee->employment_type,
                'employment_status' => $employee->employment_status,
                'date_of_birth' => $employee->date_of_birth 
                        ? \Carbon\Carbon::parse($employee->date_of_birth)->format('Y-m-d') 
                        : null,
                'joining_date'  => $employee->joining_date
                        ? \Carbon\Carbon::parse($employee->joining_date)->format('Y-m-d') 
                        : null,
                'status' => '<span class="px-2 py-1 text-xs rounded-full '
                    .($employee->employment_status == 'active'
                        ? 'bg-green-100 text-green-800'
                        : 'bg-red-100 text-red-800').'">'
                    .ucfirst($employee->employment_status).'</span>',
                'actions' => '
                    <button type="button"
                            class="text-yellow-600 mr-2 viewBtn"
                            data-id="{{ $employee->id }}">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button type="button"
                            class="text-blue-600 mr-2 editBtn"
                            data-id="{{ $employee->id }}">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button type="button"
                        class="text-red-600 mr-2 deleteBtn"
                        data-id="{{ $employee->id }}">
                        <i class="fas fa-trash"></i>
                    </button>
                ',
            ];
        }

        return response()->json([
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data,
        ]);
    }

    public function save(Request $request)
    {
        // Validation
        $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'designation_id'=> 'required|exists:designations,id',
            'date_of_birth' => 'required|date',
            'joining_date'  => 'required|date',
            'current_address' => 'required|string',
        ]);

        // Update or create
        $employee = $request->filled('employee_id')
            ? Employee::findOrFail($request->employee_id)
            : new Employee();

        // Assign data
        $employee->employee_code     = $request->employee_code ?? 'EMP-'.time();
        $employee->first_name        = $request->first_name;
        $employee->last_name         = $request->last_name;
        $employee->department_id     = $request->department_id;
        $employee->designation_id    = $request->designation_id;
        $employee->gender            = $request->gender ?? 'male';
        $employee->employment_type   = $request->employment_type ?? 'probation';
        $employee->employment_status = $request->employment_status ?? 'active';
        $employee->date_of_birth     = $request->date_of_birth;
        $employee->joining_date      = $request->joining_date;
        $employee->current_address   = $request->current_address;

        // user_id mandatory
        $employee->user_id = auth()->id() ?? 1;

        $employee->save();

        return response()->json([
            'message' => $request->filled('employee_id') ? 'Employee updated successfully' : 'Employee added successfully',
            'employee' => $employee
        ]);
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json([
                'message' => 'Employee not found'
            ], 404);
        }

        $employee->delete();

        return response()->json([
            'message' => 'Employee deleted successfully'
        ]);
    }

}
