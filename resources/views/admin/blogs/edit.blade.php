@extends('admin.layout.master')

@section('title', 'Edit Blog')
@push('style')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="page-title-head d-flex align-items-center">
            <div class="flex-grow-1">
                <h4 class="page-main-title m-0">Edit Blog</h4>
            </div>
            <div>
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-light">
                    <i class="ti ti-arrow-left me-2"></i>Back to Blogs
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row g-3">
                                <!-- Title -->
                                <div class="col-md-6">
                                    <label for="title" class="form-label">Title <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" placeholder="e.g. My Awesome Blog Post"
                                        value="{{ old('title', $blog->title) }}" required />
                                    @error('title')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Slug -->
                                <div class="col-md-6">
                                    <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                        id="slug" name="slug" placeholder="e.g. my-awesome-blog-post"
                                        value="{{ old('slug', $blog->slug) }}" required />
                                    @error('slug')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Category -->
                                <div class="col-md-6">
                                    <label for="category_id" class="form-label">Category <span
                                            class="text-danger">*</span></label>
                                    <select id="category_id" name="category_id"
                                        class="form-select @error('category_id') is-invalid @enderror" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Image -->
                                <div class="col-md-6">
                                    <label for="image" class="form-label">
                                        Image
                                    </label>

                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        id="image" name="image" accept="image/*" />

                                    @error('image')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror

                                    <!-- Preview Box -->
                                    <div class="mt-3">
                                        <img id="imagePreview"
                                            src="{{ $blog->image ? asset($blog->image) : 'https://placehold.co/150x150?text=Preview' }}"
                                            alt="Preview" class="img-thumbnail shadow-sm"
                                            style="width: 150px; height: 150px; object-fit: cover; border-radius: 12px;">
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="col-md-12">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea id="description" name="description"
                                        class="form-control ckeditor @error('description') is-invalid @enderror" rows="4"
                                        placeholder="Blog description...">{{ old('description', $blog->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row g-3 mt-4">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-check me-2"></i>Update Blog
                                    </button>
                                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-light">
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
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('textarea.ckeditor').forEach(function(textarea) {
                // Prevent double initialization
                if (!CKEDITOR.instances[textarea.id]) {
                    CKEDITOR.replace(textarea.id);
                }
            });
        });
    </script>
    <script>
        document.getElementById('title').addEventListener('input', function() {
            let slug = this.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');

            document.getElementById('slug').value = slug;
        });

        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(event) {
                    document.getElementById('imagePreview').src = event.target.result;
                };

                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
