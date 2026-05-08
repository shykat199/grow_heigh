<?php

namespace App\Http\Controllers;

use App\Models\ServicePrice;
use App\Models\Service;
use Illuminate\Http\Request;

class ServicePriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prices = ServicePrice::with('service')->get();
        return view('service-prices.index', compact('prices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();
        return view('service-prices.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'item' => 'nullable|string',
        ]);

        ServicePrice::create($validated);

        return redirect()->route('service-prices.index')->with('success', 'Service price created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ServicePrice $servicePrice)
    {
        return view('service-prices.show', compact('servicePrice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServicePrice $servicePrice)
    {
        $services = Service::all();
        return view('service-prices.edit', compact('servicePrice', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServicePrice $servicePrice)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'item' => 'nullable|string',
        ]);

        $servicePrice->update($validated);

        return redirect()->route('service-prices.index')->with('success', 'Service price updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServicePrice $servicePrice)
    {
        $servicePrice->delete();

        return redirect()->route('service-prices.index')->with('success', 'Service price deleted successfully.');
    }
}

