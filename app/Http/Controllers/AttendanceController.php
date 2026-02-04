<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;


class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('attendance.index');
    }

    public function datatable(Request $request)
    {
        $query = Attendance::with('employee');

        // Filter by date
        if ($request->filled('date')) {
            $query->where('date', $request->date);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $totalData = Attendance::count();
        $totalFiltered = $query->count();

        $attendances = $query
            ->offset($request->start)
            ->limit($request->length)
            ->orderBy('date', 'desc')
            ->get();

        $data = [];

        foreach ($attendances as $att) {
            $data[] = [
                'employee' => $att->employee->first_name.' '.$att->employee->last_name,
                'date' => date('d M Y', strtotime($att->date)),
                'check_in' => $att->check_in ?? '-',
                'check_out' => $att->check_out ?? '-',
                'status' => '<span class="px-2 py-1 rounded text-xs font-medium '
                    .match($att->status){
                        'present' => 'bg-green-100 text-green-700',
                        'late' => 'bg-yellow-100 text-yellow-700',
                        'half_day' => 'bg-orange-100 text-orange-700',
                        'on_leave' => 'bg-blue-100 text-blue-700',
                        'holiday','weekend' => 'bg-gray-200 text-gray-700',
                        default => 'bg-red-100 text-red-700'
                    }.'">'.ucfirst(str_replace('_',' ',$att->status)).'</span>',
                'total_hours' => $att->total_hours ?? '-',
                'approved' => $att->is_approved
                    ? '<span class="text-green-600 font-semibold">Yes</span>'
                    : '<span class="text-red-600 font-semibold">No</span>',
            ];
        }

        return response()->json([
            "draw" => intval($request->draw),
            "recordsTotal" => $totalData,
            "recordsFiltered" => $totalFiltered,
            "data" => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('attendance.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return redirect()->route('attendance.index')
            ->with('success', 'Attendance marked successfully.');
    }

    public function employeeReport($employeeId)
    {
        return view('attendance.report', compact('employeeId'));
    }

    public function markAttendance(Request $request)
    {
        // Temporary implementation
        return redirect()->route('attendance.index')
            ->with('success', 'Attendance marked successfully.');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
