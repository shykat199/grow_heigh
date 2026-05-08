<?php

namespace App\Http\Controllers;

use App\Models\ServiceFaq;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceFaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = ServiceFaq::with('service')->get();
        return view('service-faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();
        return view('service-faqs.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'question' => 'required|string',
            'answer' => 'nullable|string',
        ]);

        ServiceFaq::create($validated);

        return redirect()->route('service-faqs.index')->with('success', 'FAQ created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceFaq $serviceFaq)
    {
        return view('service-faqs.show', compact('serviceFaq'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceFaq $serviceFaq)
    {
        $services = Service::all();
        return view('service-faqs.edit', compact('serviceFaq', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceFaq $serviceFaq)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'question' => 'required|string',
            'answer' => 'nullable|string',
        ]);

        $serviceFaq->update($validated);

        return redirect()->route('service-faqs.index')->with('success', 'FAQ updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceFaq $serviceFaq)
    {
        $serviceFaq->delete();

        return redirect()->route('service-faqs.index')->with('success', 'FAQ deleted successfully.');
    }
}

