<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{

    public function frontIndex()
    {
        $testimonials = Testimonial::latest()->get();
        return view('testimonial', compact('testimonials'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::all();

        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'message' => 'nullable|string',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {

            $image = $request->file('image');

            // Generate unique filename
            $fileName = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();

            // Upload path
            $uploadPath = public_path('uploads/testimonials');

            // Create folder if not exists
            if (! file_exists($uploadPath)) {

                mkdir($uploadPath, 0755, true);
            }

            // Move uploaded file
            $image->move($uploadPath, $fileName);

            // Save relative path in DB
            $validated['image'] = 'uploads/testimonials/'.$fileName;
        }

        Testimonial::create($validated);

        toast('Testimonial created successfully.', 'success');

        return redirect()->route('admin.testimonials.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial)
    {
        return view('admin.testimonials.show', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'message' => 'nullable|string',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {

            /*
            |--------------------------------------------------------------------------
            | Delete Old Image
            |--------------------------------------------------------------------------
            */
            if ($testimonial->image && file_exists(public_path($testimonial->image))) {

                unlink(public_path($testimonial->image));
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
            $uploadPath = public_path('uploads/testimonials');

            // Create folder if not exists
            if (! file_exists($uploadPath)) {

                mkdir($uploadPath, 0755, true);
            }

            // Move uploaded file
            $image->move($uploadPath, $fileName);

            // Save relative path in DB
            $validated['image'] = 'uploads/testimonials/'.$fileName;
        }

        /*
        |--------------------------------------------------------------------------
        | Update Testimonial
        |--------------------------------------------------------------------------
        */
        $testimonial->update($validated);

        toast('Testimonial updated successfully.', 'success');

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        // Delete image if exists
        if ($testimonial->image && file_exists(public_path($testimonial->image))) {
            unlink(public_path($testimonial->image));
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
}
