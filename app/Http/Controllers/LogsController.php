<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;



class LogsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $logs = DB::table('logs')
                ->join('users', 'logs.user_id', '=', 'users.id')
                ->select(
                    '*',
                    'users.name',
                    'logs.id As log_id'

                )
                ->get();
            return Datatables::of($logs)
                ->addIndexColumn()
                ->make(true);
        }
        return view('Log.index');
    }
}
