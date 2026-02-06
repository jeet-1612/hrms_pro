<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{

    public function index()
    {
        return view('departments.index');
    }

    public function datatable(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'code',
            3 => 'status',
        ];

        $totalData = Department::count();
        $totalFiltered = $totalData;

        $limit  = $request->input('length');
        $start  = $request->input('start');
        $order  = $columns[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');

        $query = Department::query();

        // 🔍 Search
        if (!empty($request->input('search.value'))) {
            $search = $request->input('search.value');

            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('code', 'LIKE', "%{$search}%")
                  ->orWhere('status', 'LIKE', "%{$search}%");
            });

            $totalFiltered = $query->count();
        }

        $departments = $query
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

        $data = [];
        $i = $start + 1;

        foreach ($departments as $dept) {
            $nestedData = [];

            $nestedData['id'] = $i++;

            $nestedData['name'] = '
                <div class="text-sm font-medium text-gray-900">'.$dept->name.'</div>
            ';

            $nestedData['code'] = '<span class="font-semibold">'.$dept->code.'</span>';

            $nestedData['status'] = $dept->status === 'active'
                ? '<span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-green-100 text-green-800">
                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>Active
                   </span>'
                : '<span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-red-100 text-red-800">
                        <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>Inactive
                   </span>';

            $nestedData['actions'] = '
                <button class="text-blue-600 hover:text-blue-900 mr-3 editDepartment" data-id="'.$dept->id.'" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                <button class="text-red-600 hover:text-red-900 deleteDepartment" data-id="'.$dept->id.'" title="Delete"><i class="fas fa-trash"></i></button>
            ';

            $data[] = $nestedData;
        }

        return response()->json([
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data,
        ]);
    }

}