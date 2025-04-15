<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class WelcomeController extends Controller
{
    public function index()
    {
        $reports = Report::latest()->take(5)->get(); 
        return view('welcome', compact('reports'));
    }
}
