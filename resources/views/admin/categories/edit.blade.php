@extends('admin.layout.master')

@section('title','Edit Category')
@push('style')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="page-title-head d-flex align-items-center">
            <div class="flex-grow-1">
                <h4 class="page-main-title m-0">Edit Category</h4>
            </div>
            <div>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-light">
                    <i class="ti ti-arrow-left me-2"></i>Back to Categories
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row g-3">
                                <!-- Category Name -->
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           id="name"
                                           name="name"
                                           placeholder="e.g. Electronics"
                                           value="{{ old('name', $category->name) }}"
                                           required />
                                    @error('name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Slug -->
                                <div class="col-md-6">
                                    <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                                    <input type="text"
                                           class="form-control @error('slug') is-invalid @enderror"
                                           id="slug"
                                           name="slug"
                                           placeholder="e.g. electronics"
                                           value="{{ old('slug', $category->slug) }}"
                                           required />
                                    @error('slug')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Type -->
                                <div class="col-md-6">
                                    <label for="type" class="form-label">Category Type</label>
                                    <select id="type"
                                            name="type"
                                            class="form-select @error('type') is-invalid @enderror">
                                        <option value="">Select Type</option>
                                        @foreach(CATEGORY_TYPES as $key => $value)
                                            <option value="{{ $key }}" {{ old('type', $category->type) == $key ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select
                                            name="status"
                                            class="form-select @error('status') is-invalid @enderror"
                                            required>
                                        <option value="">Select Status</option>
                                        <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="image" class="form-label">
                                        Category Image
                                    </label>

                                    <input type="file"
                                           class="form-control @error('icon') is-invalid @enderror"
                                           id="image"
                                           name="icon"
                                           accept="image/*" />

                                    @error('icon')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror

                                    <!-- Preview Box -->
                                    <div class="mt-3">
                                        <img id="imagePreview"
                                             src="{{ isset($category) && $category->icon ? asset($category->icon) : 'https://placehold.co/150x150?text=Preview' }}"
                                             alt="Preview"
                                             class="img-thumbnail shadow-sm"
                                             style="width: 150px; height: 150px; object-fit: cover; border-radius: 12px;">
                                    </div>
                                </div>

                                <!-- Short Description -->
                                <div class="col-md-12">
                                    <label for="short_description" class="form-label">Short Description</label>
                                    <textarea id="short_description"
                                              name="short_description"
                                              class="form-control ckeditor @error('short_description') is-invalid @enderror"
                                              rows="3"
                                              placeholder="Brief description of the category...">{{ old('short_description', $category->short_description) }}</textarea>
                                    @error('short_description')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row g-3 mt-4">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-check me-2"></i>Update Category
                                    </button>
                                    <a href="{{ route('admin.categories.index') }}" class="btn btn-light">
                                        <i class="ti ti-x me-2"></i>Cancel
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
<script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll('textarea.ckeditor').forEach(function (textarea) {
                // Prevent double initialization
                if (!CKEDITOR.instances[textarea.id]) {
                    CKEDITOR.replace(textarea.id);
                }
            });
        });
    </script>

    <script>
        document.getElementById('name').addEventListener('input', function () {
            let slug = this.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');

            document.getElementById('slug').value = slug;
        });
    </script>

    <script>
        document.getElementById('image').addEventListener('change', function (e) {
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function (event) {
                    document.getElementById('imagePreview').src = event.target.result;
                };

                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush

