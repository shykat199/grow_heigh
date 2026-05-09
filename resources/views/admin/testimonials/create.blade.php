@extends('admin.layout.master')

@section('title','Create Testimonial')
@push('style')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="page-title-head d-flex align-items-center">
            <div class="flex-grow-1">
                <h4 class="page-main-title m-0">Create Testimonial</h4>
            </div>
            <div>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-light">
                    <i class="ti ti-arrow-left me-2"></i>Back to Testimonials
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <!-- Name -->
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           id="name"
                                           name="name"
                                           placeholder="e.g. John Doe"
                                           value="{{ old('name') }}"
                                           required />
                                    @error('name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Title -->
                                <div class="col-md-6">
                                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text"
                                           class="form-control @error('title') is-invalid @enderror"
                                           id="title"
                                           name="title"
                                           placeholder="e.g. CEO at Company"
                                           value="{{ old('title') }}"
                                           required />
                                    @error('title')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Image -->
                                <div class="col-md-12">
                                    <label for="image" class="form-label">
                                        Image
                                    </label>

                                    <input type="file"
                                           class="form-control @error('image') is-invalid @enderror"
                                           id="image"
                                           name="image"
                                           accept="image/*" />

                                    @error('image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror

                                    <!-- Preview Box -->
                                    <div class="mt-3">
                                        <img id="imagePreview"
                                             src="https://placehold.co/150x150?text=Preview"
                                             alt="Preview"
                                             class="img-thumbnail shadow-sm"
                                             style="width: 150px; height: 150px; object-fit: cover; border-radius: 12px;">
                                    </div>
                                </div>

                                <!-- Message -->
                                <div class="col-md-12">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea id="message"
                                              name="message"
                                              class="form-control ckeditor @error('message') is-invalid @enderror"
                                              rows="4"
                                              placeholder="Testimonial message...">{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row g-3 mt-4">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-check me-2"></i>Create Testimonial
                                    </button>
                                    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-light">
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
