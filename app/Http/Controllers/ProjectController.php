<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{

    public function frontIndex()
    {
        $projects = Project::with('category')->latest()->get();
        return view('project', compact('projects'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('category')->get();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('type', 'project')->get();

        return view('admin.projects.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:projects',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'date' => 'nullable|date',
            'status' => 'required|in:0,1',
            'link' => 'nullable|url',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {

            $image = $request->file('image');

            // Generate unique filename
            $fileName = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();

            // Upload path
            $uploadPath = public_path('uploads/projects');

            // Create folder if not exists
            if (! file_exists($uploadPath)) {

                mkdir($uploadPath, 0755, true);
            }

            // Move uploaded file
            $image->move($uploadPath, $fileName);

            // Save path in DB
            $validated['image'] = 'uploads/projects/'.$fileName;
        }

        Project::create($validated);

        toast('Project created successfully.','success');

        return redirect()->route('admin.projects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $categories = Category::where('type', 'project')->get();

        return view('admin.projects.edit', compact('project', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:projects,slug,'.$project->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'date' => 'nullable|date',
            'status' => 'required|in:0,1',
            'link' => 'nullable|url',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {

            // Delete old image
            if ($project->image && file_exists(public_path($project->image))) {

                unlink(public_path($project->image));
            }

            $image = $request->file('image');

            // Generate unique filename
            $fileName = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();

            // Upload path
            $uploadPath = public_path('uploads/projects');

            // Create folder if not exists
            if (! file_exists($uploadPath)) {

                mkdir($uploadPath, 0755, true);
            }

            // Move uploaded file
            $image->move($uploadPath, $fileName);

            // Save path in DB
            $validated['image'] = 'uploads/projects/'.$fileName;
        }

        toast('Project updated successfully.','success');

        $project->update($validated);

        return redirect()->route('admin.projects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // Delete image if exists
        if ($project->image && Storage::disk('public')->exists($project->image)) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }
}
