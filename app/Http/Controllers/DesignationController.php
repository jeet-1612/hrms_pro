<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class DesignationController extends Controller
{

    public function index()
    {
        return view('designation.index');
    }

    public function datatable(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'department_id',
            3 => 'level',
            4 => 'status',
        ];

        $totalData = Designation::count();
        $totalFiltered = $totalData;

        $limit  = $request->input('length');
        $start  = $request->input('start');
        $order  = $columns[$request->input('order.0.column')] ?? 'id';
        $dir    = $request->input('order.0.dir') ?? 'desc';

        $query = Designation::with('department');

        // 🔍 Search
        if (!empty($request->input('search.value'))) {
            $search = $request->input('search.value');

            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('level', 'LIKE', "%{$search}%")
                  ->orWhere('status', 'LIKE', "%{$search}%")
                  ->orWhereHas('department', function ($dq) use ($search) {
                      $dq->where('name', 'LIKE', "%{$search}%");
                  });
            });

            $totalFiltered = $query->count();
        }

        $designations = $query
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

        $data = [];
        $i = $start + 1;

        foreach ($designations as $designation) {

            $data[] = [
                'id' => $i++,

                'name' => '<span class="font-medium text-gray-900">'.$designation->title.'</span>',

                'department' => $designation->department
                    ? '<span class="text-gray-700">'.$designation->department->name.'</span>'
                    : '<span class="text-gray-400">N/A</span>',

                'level' => '<span class="font-semibold">'.$designation->level.'</span>',

                'status' => $designation->status === 'active'
                    ? '<span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-green-100 text-green-800">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>Active
                       </span>'
                    : '<span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-red-100 text-red-800">
                            <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>Inactive
                       </span>',

                'actions' => '
                    <button class="text-blue-600 hover:text-blue-900 mr-3 editDesignation"
                        data-id="'.$designation->id.'" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </button>

                    <button class="text-red-600 hover:text-red-900 deleteDesignation"
                        data-id="'.$designation->id.'" title="Delete">
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

}