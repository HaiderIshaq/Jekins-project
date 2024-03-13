<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BankersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $data=[
            'profile'=>url('/').'/'.$request->user()->profile
        ];
        return view('Banker.index',compact('data'));
    }

}
