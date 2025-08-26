<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Project;

class DashboardController extends Controller
{
 
    public function index()
    {
        $userId = Auth::id();

        $pendingCount = Project::where('user_id', $userId)->where('status', 'pending')->count();
        $inProgressCount = Project::where('user_id', $userId)->where('status', 'inprogress')->count();
        $submittedCount = Project::where('user_id', $userId)->where('status', 'submitted')->count();

        return view('dashboard', compact('pendingCount', 'inProgressCount', 'submittedCount'));
    }
}
