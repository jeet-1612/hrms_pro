<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{

    public function index()
    {
        return view('permissions.index');
    }

}