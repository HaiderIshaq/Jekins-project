<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function index()
    {
        return view('Files.index');
    }
    public function getFiles()
    {
        $files = Storage::disk('local')->allFiles('public');
        echo $files;
    }
}
