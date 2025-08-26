<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;



class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Project::where('user_id', Auth::id());

    // Apply filter if status selected
    if ($request->has('status') && $request->status != '') {
        $query->where('status', $request->status);
    }

    $projects = $query->get();

    return view('projects.index', compact('projects'));
}

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:Pending,InProgress,Submitted'
        ]);
        $data['user_id'] = auth()->id();

        $newProduct = Project::create($data);
        return redirect(route('projects.index'));
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
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
{
    // Validate form
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|in:Pending,InProgress,Submitted',
    ]);

    // Update project
    $project->update($validated);

    return redirect()->route('projects.index')
                     ->with('success', 'Project updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')
                         ->with('success', 'Project deleted successfully!');
    }
}
