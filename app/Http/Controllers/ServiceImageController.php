<?php

namespace App\Http\Controllers;

use App\Models\ServiceImage;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = ServiceImage::with('service')->get();
        return view('service-images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();
        return view('service-images.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        if ($request->hasFile('images')) {
            $imagePath = $request->file('images')->store('service-images', 'public');
            $validated['images'] = $imagePath;
        }

        ServiceImage::create($validated);

        return redirect()->route('service-images.index')->with('success', 'Service image uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceImage $serviceImage)
    {
        return view('service-images.show', compact('serviceImage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceImage $serviceImage)
    {
        $services = Service::all();
        return view('service-images.edit', compact('serviceImage', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceImage $serviceImage)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        if ($request->hasFile('images')) {
            $imagePath = $request->file('images')->store('service-images', 'public');
            $validated['images'] = $imagePath;
        }

        $serviceImage->update($validated);

        return redirect()->route('service-images.index')->with('success', 'Service image updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceImage $serviceImage)
    {
        $serviceImage->delete();

        return redirect()->route('service-images.index')->with('success', 'Service image deleted successfully.');
    }
}

