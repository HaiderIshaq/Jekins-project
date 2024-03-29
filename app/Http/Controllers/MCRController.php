<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Clear;
use App\Muccaduum;
use App\SaleTax;
use App\Bill_Ibr;
use App\Log;
use DataTables;
use PDF;
use Illuminate\Support\Facades\Storage;

class MCRController extends Controller
{
    public function index()
    {
        return view('MCR.index');
    }
    
    public function create(Request $request)
    {

        $uid = $request->user()->company;
        $token = $request->session()->get('token');
        $user = Muccaduum::getUserCompany($uid, $token);
        return view('MCR.create', compact('user'));
    
        // return view('Muccadum.create');
    }

    
}
