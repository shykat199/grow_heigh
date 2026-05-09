<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use App\Models\ServiceFaq;
use App\Models\ServiceImage;
use App\Models\ServicePrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiceController extends Controller
{

    public function frontIndex()
    {
        $services = Service::with('category')->latest()->get();
        return view('service', compact('services'));
    }

    public function frontShow($slug)
    {
        $service = Service::with('category', 'faqs', 'images', 'prices')->where('slug', $slug)->first();
        // return view('service-details', compact('service'));
    }

    public function index()
    {
        $services = Service::with('category')->latest()->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $categories = Category::where('type', 'service')->get();
        return view('admin.services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cat_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:services',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'work_benefit' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            
            // Faqs
            'faqs' => 'nullable|array',
            'faqs.*.question' => 'required_with:faqs|string|max:255',
            'faqs.*.answer' => 'required_with:faqs|string',
            
            // Images
            'service_images' => 'nullable|array',
            'service_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            
            // Prices
            'prices' => 'nullable|array',
            'prices.*.title' => 'required_with:prices|string|max:255',
            'prices.*.price' => 'required_with:prices|numeric',
            'prices.*.item' => 'required_with:prices|string',
        ]);

        DB::beginTransaction();
        try {
            // Process icon
            $iconPath = null;
            if ($request->hasFile('icon')) {
                $icon = $request->file('icon');
                $fileName = time().'_icon_'.uniqid().'.'.$icon->getClientOriginalExtension();
                $uploadPath = public_path('uploads/services');
                if (! file_exists($uploadPath)) mkdir($uploadPath, 0755, true);
                $icon->move($uploadPath, $fileName);
                $iconPath = 'uploads/services/'.$fileName;
            }

            // Create service
            $service = Service::create([
                'cat_id' => $validated['cat_id'],
                'name' => $validated['name'],
                'slug' => $validated['slug'] ?? Str::slug($validated['name']),
                'short_description' => $validated['short_description'],
                'description' => $validated['description'],
                'work_benefit' => $validated['work_benefit'],
                'icon' => $iconPath,
            ]);

            // Save FAQs
            if (!empty($validated['faqs'])) {
                foreach ($validated['faqs'] as $faq) {
                    if (!empty($faq['question']) && !empty($faq['answer'])) {
                        ServiceFaq::create([
                            'service_id' => $service->id,
                            'question' => $faq['question'],
                            'answer' => $faq['answer'],
                        ]);
                    }
                }
            }

            // Save Images
            if ($request->hasFile('service_images')) {
                foreach ($request->file('service_images') as $img) {
                    $fileName = time().'_gallery_'.uniqid().'.'.$img->getClientOriginalExtension();
                    $uploadPath = public_path('uploads/services/gallery');
                    if (! file_exists($uploadPath)) mkdir($uploadPath, 0755, true);
                    $img->move($uploadPath, $fileName);
                    
                    ServiceImage::create([
                        'service_id' => $service->id,
                        'images' => 'uploads/services/gallery/'.$fileName,
                    ]);
                }
            }

            // Save Prices
            if (!empty($validated['prices'])) {
                foreach ($validated['prices'] as $price) {
                    if (!empty($price['title']) && isset($price['price']) && !empty($price['item'])) {
                        ServicePrice::create([
                            'service_id' => $service->id,
                            'title' => $price['title'],
                            'price' => $price['price'],
                            'item' => $price['item'], // saved as comma separated string as input from textarea
                        ]);
                    }
                }
            }

            DB::commit();
            toast('Service created successfully.', 'success');
            return redirect()->route('admin.services.index');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Something went wrong: ' . $e->getMessage()]);
        }
    }

    public function show(Service $service)
    {
        $service->load(['category', 'faqs', 'images', 'prices']);
        return view('admin.services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        $service->load(['faqs', 'images', 'prices']);
        $categories = Category::where('type', 'service')->get();
        return view('admin.services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'cat_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:services,slug,'.$service->id,
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'work_benefit' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            
            // Faqs
            'faqs' => 'nullable|array',
            'faqs.*.id' => 'nullable|exists:service_faqs,id',
            'faqs.*.question' => 'required_with:faqs|string|max:255',
            'faqs.*.answer' => 'required_with:faqs|string',
            
            // Images (new ones)
            'service_images' => 'nullable|array',
            'service_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            
            // Delete existing images
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'exists:service_images,id',
            
            // Prices
            'prices' => 'nullable|array',
            'prices.*.id' => 'nullable|exists:service_prices,id',
            'prices.*.title' => 'required_with:prices|string|max:255',
            'prices.*.price' => 'required_with:prices|numeric',
            'prices.*.item' => 'required_with:prices|string',
        ]);

        DB::beginTransaction();
        try {
            // Process icon
            if ($request->hasFile('icon')) {
                // Delete old icon
                if ($service->icon && file_exists(public_path($service->icon))) {
                    unlink(public_path($service->icon));
                }
                
                $icon = $request->file('icon');
                $fileName = time().'_icon_'.uniqid().'.'.$icon->getClientOriginalExtension();
                $uploadPath = public_path('uploads/services');
                if (! file_exists($uploadPath)) mkdir($uploadPath, 0755, true);
                $icon->move($uploadPath, $fileName);
                $service->icon = 'uploads/services/'.$fileName;
            }

            $service->update([
                'cat_id' => $validated['cat_id'],
                'name' => $validated['name'],
                'slug' => $validated['slug'] ?? Str::slug($validated['name']),
                'short_description' => $validated['short_description'],
                'description' => $validated['description'],
                'work_benefit' => $validated['work_benefit'],
            ]);

            // Sync FAQs
            $keptFaqIds = [];
            if (!empty($validated['faqs'])) {
                foreach ($validated['faqs'] as $faqData) {
                    if (!empty($faqData['question']) && !empty($faqData['answer'])) {
                        if (isset($faqData['id'])) {
                            // Update existing
                            $faq = ServiceFaq::find($faqData['id']);
                            if ($faq && $faq->service_id == $service->id) {
                                $faq->update([
                                    'question' => $faqData['question'],
                                    'answer' => $faqData['answer']
                                ]);
                                $keptFaqIds[] = $faq->id;
                            }
                        } else {
                            // Create new
                            $newFaq = ServiceFaq::create([
                                'service_id' => $service->id,
                                'question' => $faqData['question'],
                                'answer' => $faqData['answer']
                            ]);
                            $keptFaqIds[] = $newFaq->id;
                        }
                    }
                }
            }
            // Delete removed FAQs
            ServiceFaq::where('service_id', $service->id)->whereNotIn('id', $keptFaqIds)->delete();

            // Sync Prices
            $keptPriceIds = [];
            if (!empty($validated['prices'])) {
                foreach ($validated['prices'] as $priceData) {
                    if (!empty($priceData['title']) && isset($priceData['price']) && !empty($priceData['item'])) {
                        if (isset($priceData['id'])) {
                            // Update existing
                            $price = ServicePrice::find($priceData['id']);
                            if ($price && $price->service_id == $service->id) {
                                $price->update([
                                    'title' => $priceData['title'],
                                    'price' => $priceData['price'],
                                    'item' => $priceData['item']
                                ]);
                                $keptPriceIds[] = $price->id;
                            }
                        } else {
                            // Create new
                            $newPrice = ServicePrice::create([
                                'service_id' => $service->id,
                                'title' => $priceData['title'],
                                'price' => $priceData['price'],
                                'item' => $priceData['item']
                            ]);
                            $keptPriceIds[] = $newPrice->id;
                        }
                    }
                }
            }
            // Delete removed Prices
            ServicePrice::where('service_id', $service->id)->whereNotIn('id', $keptPriceIds)->delete();

            // Handle Images deletion
            if (!empty($validated['delete_images'])) {
                $imagesToDelete = ServiceImage::whereIn('id', $validated['delete_images'])
                    ->where('service_id', $service->id)
                    ->get();
                
                foreach ($imagesToDelete as $img) {
                    if ($img->images && file_exists(public_path($img->images))) {
                        unlink(public_path($img->images));
                    }
                    $img->delete();
                }
            }

            // Handle New Images Upload
            if ($request->hasFile('service_images')) {
                foreach ($request->file('service_images') as $img) {
                    $fileName = time().'_gallery_'.uniqid().'.'.$img->getClientOriginalExtension();
                    $uploadPath = public_path('uploads/services/gallery');
                    if (! file_exists($uploadPath)) mkdir($uploadPath, 0755, true);
                    $img->move($uploadPath, $fileName);
                    
                    ServiceImage::create([
                        'service_id' => $service->id,
                        'images' => 'uploads/services/gallery/'.$fileName,
                    ]);
                }
            }

            DB::commit();
            toast('Service updated successfully.', 'success');
            return redirect()->route('admin.services.index');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Something went wrong: ' . $e->getMessage()]);
        }
    }

    public function destroy(Service $service)
    {
        DB::beginTransaction();
        try {
            // Delete Icon
            if ($service->icon && file_exists(public_path($service->icon))) {
                unlink(public_path($service->icon));
            }

            // Delete Gallery Images files
            foreach ($service->images as $img) {
                if ($img->images && file_exists(public_path($img->images))) {
                    unlink(public_path($img->images));
                }
            }

            // Relations will be deleted sequentially. 
            // Note: Since we haven't checked if onDelete('cascade') was defined in migration, 
            // we will explicitly delete relations to be safe.
            $service->images()->delete();
            $service->faqs()->delete();
            $service->prices()->delete();
            
            $service->delete();

            DB::commit();
            return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.services.index')->with('error', 'Error deleting service: ' . $e->getMessage());
        }
    }
}
