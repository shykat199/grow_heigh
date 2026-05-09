<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{

    public function frontIndex()
    {
        $teams = Team::latest()->get();
        return view('team', compact('teams'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::all();

        return view('admin.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'email' => 'nullable|email|max:255',
            'bio' => 'nullable|string',
            'fb_link' => 'nullable|url|max:255',
            'twitter_link' => 'nullable|url|max:255',
            'linkedin_link' => 'nullable|url|max:255',
            'insta_link' => 'nullable|url|max:255',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {

            $image = $request->file('image');

            // Generate unique filename
            $fileName = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();

            // Upload path
            $uploadPath = public_path('uploads/teams');

            // Create folder if not exists
            if (! file_exists($uploadPath)) {

                mkdir($uploadPath, 0755, true);
            }

            // Move uploaded file
            $image->move($uploadPath, $fileName);

            // Save relative path in DB
            $validated['image'] = 'uploads/teams/'.$fileName;
        }

        Team::create($validated);

        toast('Team member created successfully.', 'success');

        return redirect()->route('admin.teams.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        return view('admin.teams.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        return view('admin.teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'email' => 'nullable|email|max:255',
            'bio' => 'nullable|string',
            'fb_link' => 'nullable|url|max:255',
            'twitter_link' => 'nullable|url|max:255',
            'linkedin_link' => 'nullable|url|max:255',
            'insta_link' => 'nullable|url|max:255',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {

            /*
            |--------------------------------------------------------------------------
            | Delete Old Image
            |--------------------------------------------------------------------------
            */
            if ($team->image && file_exists(public_path($team->image))) {

                unlink(public_path($team->image));
            }

            /*
            |--------------------------------------------------------------------------
            | Upload New Image
            |--------------------------------------------------------------------------
            */
            $image = $request->file('image');

            // Generate unique filename
            $fileName = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();

            // Upload path
            $uploadPath = public_path('uploads/teams');

            // Create folder if not exists
            if (! file_exists($uploadPath)) {

                mkdir($uploadPath, 0755, true);
            }

            // Move uploaded file
            $image->move($uploadPath, $fileName);

            // Save relative path in DB
            $validated['image'] = 'uploads/teams/'.$fileName;
        }

        /*
        |--------------------------------------------------------------------------
        | Update Team Member
        |--------------------------------------------------------------------------
        */
        $team->update($validated);

        toast('Team member updated successfully.', 'success');

        return redirect()->route('admin.teams.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        // Delete image if exists
        if ($team->image && file_exists(public_path($team->image))) {
            unlink(public_path($team->image));
        }

        $team->delete();

        return redirect()->route('admin.teams.index')->with('success', 'Team member deleted successfully.');
    }
}
