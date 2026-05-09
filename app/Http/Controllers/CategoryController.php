<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'type' => 'nullable|string|in:blog,service,project,other',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'short_description' => 'nullable|string',
            'status' => 'required|in:0,1',
        ]);

        if ($request->hasFile('icon')) {

            $file = $request->file('icon');

            $fileName = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

            // Website root/uploads/categories
            $uploadPath = $_SERVER['DOCUMENT_ROOT'].'/uploads/categories';

            if (! file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $file->move($uploadPath, $fileName);

            $validated['icon'] = 'uploads/categories/'.$fileName;
        }

        Category::create($validated);

        toast('Success', 'Category created successfully.');

        return redirect()
            ->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,'.$category->id,
            'type' => 'nullable|string|in:blog,service,project,other',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'short_description' => 'nullable|string',
            'status' => 'required|in:0,1',
        ]);

        // Upload new image
        if ($request->hasFile('icon')) {

            /*
            |--------------------------------------------------------------------------
            | Delete Old Image
            |--------------------------------------------------------------------------
            */
            if ($category->icon && file_exists(public_path($category->icon))) {

                unlink(public_path($category->icon));
            }

            /*
            |--------------------------------------------------------------------------
            | Upload New Image
            |--------------------------------------------------------------------------
            */
            $file = $request->file('icon');

            // Generate unique filename
            $fileName = time().'_'.uniqid('', true).'.'.$file->getClientOriginalExtension();

            // Upload path
            $uploadPath = public_path('uploads/categories');

            // Create folder if not exists
            if (! file_exists($uploadPath)) {

                if (! mkdir($uploadPath, 0755, true) && ! is_dir($uploadPath)) {

                    throw new \RuntimeException(
                        sprintf('Directory "%s" was not created', $uploadPath)
                    );
                }
            }

            // Move file
            $file->move($uploadPath, $fileName);

            // Save relative path in DB
            $validated['icon'] = 'uploads/categories/'.$fileName;
        }

        /*
        |--------------------------------------------------------------------------
        | Update Category
        |--------------------------------------------------------------------------
        */
        $category->update($validated);

        toast('Category updated successfully.', 'success');

        return redirect()
            ->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        toast('Category deleted successfully..', 'success');

        return redirect()->route('admin.categories.index');
    }
}
