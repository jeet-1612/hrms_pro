<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaveController extends Controller
{
    public function index()
    {
        return view('leaves.index');
    }

    /* DATATABLE */
    public function datatable(Request $request)
    {
        $draw   = intval($request->draw);
        $start  = intval($request->start);
        $length = intval($request->length);

        $query = Leave::with(['employee', 'leaveType']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->leave_type) {
            $query->where('leave_type_id', $request->leave_type);
        }

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('start_date', [
                $request->start_date,
                $request->end_date
            ]);
        }

        $totalRecords = $query->count();

        $leaves = $query
            ->skip($start)
            ->take($length)
            ->orderBy('id', 'desc')
            ->get();

        $data = [];

        foreach ($leaves as $leave) {
            $data[] = [
                'employee'   => $leave->employee->first_name . ' ' . ($leave->employee->last_name ?? '-'),
                'leave_type' => $leave->leaveType->name ?? '-',
                'dates'      => $leave->start_date.' → '.$leave->end_date,
                'total_days' => $leave->total_days,
                'reason'     => $leave->reason,
                'status'     => ucfirst($leave->status),
                'action'     => '
                    <button class="viewLeave text-blue-600"
                            data-id="'.$leave->id.'" title="View Leave">
                        <i class="fas fa-eye"></i>
                    </button>'
            ];
        }

        return response()->json([
            'draw'            => $draw,
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data'            => $data
        ]);
    }


    /* LEAVE TYPES */
    public function leaveTypes()
    {
        return LeaveType::where('status', 'active')
            ->select('id','name')
            ->get();
    }

    /* APPLY LEAVE */
    public function store(Request $request)
    {
        $request->validate([
            'leave_type_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required'
        ]);

        Leave::create([
            'employee_id' => auth()->id(),
            'leave_type_id' => $request->leave_type_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_days' => now()->parse($request->start_date)
                ->diffInDays(now()->parse($request->end_date)) + 1,
            'reason' => $request->reason,
            'contact_number' => $request->contact_number,
            'contact_address' => $request->contact_address,
            'applied_by' => auth()->id(),
        ]);

        return response()->json(['message' => 'Leave applied successfully']);
    }

    /* VIEW DETAILS */
    public function show(Leave $leave)
    {
        return $leave->load(['employee', 'leaveType', 'approver']);
    }

    /* APPROVE / REJECT */
    public function approveReject(Request $request)
    {
        $leave = Leave::findOrFail($request->leave_id);

        $leave->status = $request->action === 'approve' ? 'approved' :
                         ($request->action === 'reject' ? 'rejected' : 'cancelled');

        $leave->rejection_reason = $request->rejection_reason;
        $leave->approved_by = auth()->id();
        $leave->approved_at = now();
        $leave->save();

        return response()->json(['message' => 'Leave updated']);
    }
}