@extends('admin.layout.master')

@section('title','Create Service')
@push('style')
    <style>
        .dynamic-block { border: 1px solid #eef2f7; padding: 15px; border-radius: 8px; margin-bottom: 15px; background: #fbfbfc; position: relative; }
        .btn-remove-block { position: absolute; top: 15px; right: 15px; }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="page-title-head d-flex align-items-center">
            <div class="flex-grow-1">
                <h4 class="page-main-title m-0">Create Service</h4>
            </div>
            <div>
                <a href="{{ route('admin.services.index') }}" class="btn btn-light">
                    <i class="ti ti-arrow-left me-2"></i>Back
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Basic Info -->
                    <div class="card mb-3">
                        <div class="card-header border-bottom-0"><h4 class="card-title mb-0">Basic Information</h4></div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required />
                                    @error('name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Slug <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}" required />
                                    @error('slug')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Category <span class="text-danger">*</span></label>
                                    <select name="cat_id" class="form-select @error('cat_id') is-invalid @enderror" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('cat_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('cat_id')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Service Icon</label>
                                    <input type="file" class="form-control @error('icon') is-invalid @enderror" name="icon" accept="image/*" />
                                    @error('icon')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Short Description</label>
                                    <textarea name="short_description" class="form-control @error('short_description') is-invalid @enderror" rows="3">{{ old('short_description') }}</textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Description</label>
                                    <textarea id="description" name="description" class="form-control ckeditor">{{ old('description') }}</textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Work Benefits</label>
                                    <textarea id="work_benefit" name="work_benefit" class="form-control ckeditor">{{ old('work_benefit') }}</textarea>
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
                            <!-- Dynamic FAQs injected here -->
                        </div>
                    </div>

                    <!-- Prices -->
                    <div class="card mb-3">
                        <div class="card-header border-bottom-0 d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Pricing Packages</h4>
                            <button type="button" class="btn btn-sm btn-primary" id="addPriceBtn"><i class="ti ti-plus me-1"></i> Add Package</button>
                        </div>
                        <div class="card-body" id="priceContainer">
                            <!-- Dynamic Prices injected here -->
                        </div>
                    </div>

                    <!-- Images Gallery -->
                    <div class="card mb-3">
                        <div class="card-header border-bottom-0 d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Gallery Images</h4>
                            <button type="button" class="btn btn-sm btn-primary" id="addImageBtn"><i class="ti ti-plus me-1"></i> Add Image</button>
                        </div>
                        <div class="card-body" id="imageContainer">
                            <!-- Dynamic Images injected here -->
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <button type="submit" class="btn btn-success"><i class="ti ti-device-floppy me-2"></i> Save Service</button>
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
    let faqCount = 0;
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

    let priceCount = 0;
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
</script>
@endpush
