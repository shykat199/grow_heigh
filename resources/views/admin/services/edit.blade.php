@extends('admin.layout.master')

@section('title','Edit Service')
@push('style')
    <style>
        .dynamic-block { border: 1px solid #eef2f7; padding: 15px; border-radius: 8px; margin-bottom: 15px; background: #fbfbfc; position: relative; }
        .btn-remove-block { position: absolute; top: 15px; right: 15px; }
        .existing-image-box { position: relative; display: inline-block; margin-right: 15px; margin-bottom: 15px; }
        .existing-image-box img { width: 100px; height: 100px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd; }
        .btn-delete-image { position: absolute; top: -10px; right: -10px; border-radius: 50%; padding: 0.25rem 0.5rem; }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="page-title-head d-flex align-items-center">
            <div class="flex-grow-1">
                <h4 class="page-main-title m-0">Edit Service</h4>
            </div>
            <div>
                <a href="{{ route('admin.services.index') }}" class="btn btn-light">
                    <i class="ti ti-arrow-left me-2"></i>Back
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Basic Info -->
                    <div class="card mb-3">
                        <div class="card-header border-bottom-0"><h4 class="card-title mb-0">Basic Information</h4></div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $service->name) }}" required />
                                    @error('name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Slug <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $service->slug) }}" required />
                                    @error('slug')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Category <span class="text-danger">*</span></label>
                                    <select name="cat_id" class="form-select @error('cat_id') is-invalid @enderror" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('cat_id', $service->cat_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('cat_id')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Service Icon</label>
                                    <input type="file" class="form-control @error('icon') is-invalid @enderror" name="icon" accept="image/*" />
                                    @error('icon')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                    @if($service->icon)
                                        <div class="mt-2">
                                            <img src="{{ asset($service->icon) }}" class="img-thumbnail" style="height: 60px;">
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Short Description</label>
                                    <textarea name="short_description" class="form-control @error('short_description') is-invalid @enderror" rows="3">{{ old('short_description', $service->short_description) }}</textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Description</label>
                                    <textarea id="description" name="description" class="form-control ckeditor">{{ old('description', $service->description) }}</textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Work Benefits</label>
                                    <textarea id="work_benefit" name="work_benefit" class="form-control ckeditor">{{ old('work_benefit', $service->work_benefit) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FAQs -->
                    <div class="card mb-3">
                        <div class="card-header border-bottom-0 d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">FAQs</h4>
                            <button type="button" class="btn btn-sm btn-primary" id="addFaqBtn"><i class="ti ti-plus me-1"></i> Add FAQ</button>
                        </div>
                        <div class="card-body" id="faqContainer">
                            @foreach($service->faqs as $index => $faq)
                            <div class="dynamic-block" id="faq_block_{{ $index }}">
                                <button type="button" class="btn btn-sm btn-danger btn-icon btn-remove-block" onclick="document.getElementById('faq_block_{{ $index }}').remove()"><i class="ti ti-x"></i></button>
                                <input type="hidden" name="faqs[{{ $index }}][id]" value="{{ $faq->id }}">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label">Question</label>
                                        <input type="text" name="faqs[{{ $index }}][question]" class="form-control" value="{{ $faq->question }}" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Answer</label>
                                        <textarea name="faqs[{{ $index }}][answer]" class="form-control" rows="2" required>{{ $faq->answer }}</textarea>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Prices -->
                    <div class="card mb-3">
                        <div class="card-header border-bottom-0 d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Pricing Packages</h4>
                            <button type="button" class="btn btn-sm btn-primary" id="addPriceBtn"><i class="ti ti-plus me-1"></i> Add Package</button>
                        </div>
                        <div class="card-body" id="priceContainer">
                            @foreach($service->prices as $index => $price)
                            <div class="dynamic-block" id="price_block_{{ $index }}">
                                <button type="button" class="btn btn-sm btn-danger btn-icon btn-remove-block" onclick="document.getElementById('price_block_{{ $index }}').remove()"><i class="ti ti-x"></i></button>
                                <input type="hidden" name="prices[{{ $index }}][id]" value="{{ $price->id }}">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Package Title</label>
                                        <input type="text" name="prices[{{ $index }}][title]" class="form-control" value="{{ $price->title }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Price</label>
                                        <input type="number" step="0.01" name="prices[{{ $index }}][price]" class="form-control" value="{{ $price->price }}" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Items (comma separated)</label>
                                        <textarea name="prices[{{ $index }}][item]" class="form-control" rows="2" required>{{ $price->item }}</textarea>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Images Gallery -->
                    <div class="card mb-3">
                        <div class="card-header border-bottom-0 d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Gallery Images</h4>
                            <button type="button" class="btn btn-sm btn-primary" id="addImageBtn"><i class="ti ti-plus me-1"></i> Add New Images</button>
                        </div>
                        <div class="card-body">
                            <div class="mb-4" id="existingImagesContainer">
                                @foreach($service->images as $img)
                                <div class="existing-image-box" id="existing_img_{{ $img->id }}">
                                    <img src="{{ asset($img->images) }}">
                                    <button type="button" class="btn btn-danger btn-sm btn-delete-image" onclick="deleteExistingImage({{ $img->id }})"><i class="ti ti-x"></i></button>
                                </div>
                                @endforeach
                            </div>
                            
                            <div id="imageContainer">
                                <!-- Dynamic New Images injected here -->
                            </div>
                        </div>
                    </div>

                    <!-- Hidden inputs for deleted images will be injected here -->
                    <div id="deletedImagesInputs"></div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <button type="submit" class="btn btn-success"><i class="ti ti-device-floppy me-2"></i> Update Service</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
<script>
    // CKEditor init
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('textarea.ckeditor').forEach(function (textarea) {
            if (!CKEDITOR.instances[textarea.id]) CKEDITOR.replace(textarea.id);
        });
    });

    // Slug generation
    document.getElementById('name').addEventListener('input', function () {
        document.getElementById('slug').value = this.value.toLowerCase().trim()
            .replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');
    });

    // Dynamic blocks logic
    let faqCount = {{ $service->faqs->count() }};
    document.getElementById('addFaqBtn').addEventListener('click', function() {
        let html = `
        <div class="dynamic-block" id="faq_block_${faqCount}">
            <button type="button" class="btn btn-sm btn-danger btn-icon btn-remove-block" onclick="document.getElementById('faq_block_${faqCount}').remove()"><i class="ti ti-x"></i></button>
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label">Question</label>
                    <input type="text" name="faqs[${faqCount}][question]" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Answer</label>
                    <textarea name="faqs[${faqCount}][answer]" class="form-control" rows="2" required></textarea>
                </div>
            </div>
        </div>`;
        document.getElementById('faqContainer').insertAdjacentHTML('beforeend', html);
        faqCount++;
    });

    let priceCount = {{ $service->prices->count() }};
    document.getElementById('addPriceBtn').addEventListener('click', function() {
        let html = `
        <div class="dynamic-block" id="price_block_${priceCount}">
            <button type="button" class="btn btn-sm btn-danger btn-icon btn-remove-block" onclick="document.getElementById('price_block_${priceCount}').remove()"><i class="ti ti-x"></i></button>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Package Title</label>
                    <input type="text" name="prices[${priceCount}][title]" class="form-control" placeholder="e.g. Basic Plan" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Price</label>
                    <input type="number" step="0.01" name="prices[${priceCount}][price]" class="form-control" placeholder="e.g. 99.99" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Items (comma separated)</label>
                    <textarea name="prices[${priceCount}][item]" class="form-control" rows="2" placeholder="Item 1, Item 2, Item 3" required></textarea>
                </div>
            </div>
        </div>`;
        document.getElementById('priceContainer').insertAdjacentHTML('beforeend', html);
        priceCount++;
    });

    let imageCount = 0;
    document.getElementById('addImageBtn').addEventListener('click', function() {
        let html = `
        <div class="dynamic-block" id="image_block_${imageCount}" style="padding-right: 50px;">
            <button type="button" class="btn btn-sm btn-danger btn-icon btn-remove-block" onclick="document.getElementById('image_block_${imageCount}').remove()"><i class="ti ti-x"></i></button>
            <input type="file" name="service_images[]" class="form-control" accept="image/*" required>
        </div>`;
        document.getElementById('imageContainer').insertAdjacentHTML('beforeend', html);
        imageCount++;
    });

    function deleteExistingImage(id) {
        if(confirm('Are you sure you want to remove this image? It will be deleted upon saving.')) {
            document.getElementById('existing_img_' + id).style.display = 'none';
            let input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'delete_images[]';
            input.value = id;
            document.getElementById('deletedImagesInputs').appendChild(input);
        }
    }
</script>
@endpush
