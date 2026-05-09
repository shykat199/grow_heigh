<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{

    public function frontIndex()
    {
        $blogs = Blog::with('category')->latest()->get();
        return view('blog', compact('blogs'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with('category')->get();

        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('type', 'blog')->get();

        return view('admin.blogs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {

            $image = $request->file('image');

            // Generate unique filename
            $fileName = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();

            // Upload path
            $uploadPath = public_path('uploads/blogs');

            // Create folder if not exists
            if (! file_exists($uploadPath)) {

                mkdir($uploadPath, 0755, true);
            }

            // Move uploaded file
            $image->move($uploadPath, $fileName);

            // Save relative path in DB
            $validated['image'] = 'uploads/blogs/'.$fileName;
        }

        Blog::create($validated);

        toast('Blog created successfully.', 'success');

        return redirect()->route('admin.blogs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('admin.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $categories = Category::where('type', 'blog')->get();

        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug,' . $blog->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {

            /*
            |--------------------------------------------------------------------------
            | Delete Old Image
            |--------------------------------------------------------------------------
            */
            if ($blog->image && file_exists(public_path($blog->image))) {

                unlink(public_path($blog->image));
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
            $uploadPath = public_path('uploads/blogs');

            // Create folder if not exists
            if (! file_exists($uploadPath)) {

                mkdir($uploadPath, 0755, true);
            }

            // Move uploaded file
            $image->move($uploadPath, $fileName);

            // Save relative path in DB
            $validated['image'] = 'uploads/blogs/'.$fileName;
        }

        /*
        |--------------------------------------------------------------------------
        | Update Blog
        |--------------------------------------------------------------------------
        */
        $blog->update($validated);

        toast('Blog updated successfully.', 'success');

        return redirect()->route('admin.blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        // Delete image if exists
        if ($blog->image && file_exists(public_path($blog->image))) {
            unlink(public_path($blog->image));
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
    }
}
