@extends('admin.layout.master')

@section('title', $category->name)
@push('style')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="page-title-head d-flex align-items-center">
            <div class="flex-grow-1">
                <h4 class="page-main-title m-0">{{ $category->name }}</h4>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary">
                    <i class="ti ti-edit me-2"></i>Edit
                </a>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-light">
                    <i class="ti ti-arrow-left me-2"></i>Back
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-4">
                            <!-- Basic Information -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-muted">Category Name</label>
                                    <p class="fs-5 fw-semibold">{{ $category->name }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-muted">Slug</label>
                                    <p class="fs-5 fw-semibold">{{ $category->slug }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-muted">Category Type</label>
                                    @if ($category->type)
                                        <p class="fs-5 fw-semibold">
                                            <span
                                                class="badge badge-soft-info">{{ CATEGORY_TYPES[$category->type] ?? $category->type }}</span>
                                        </p>
                                    @else
                                        <p class="fs-5 fw-semibold text-muted">Not set</p>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="col-md-4">
                                    @if ($category->icon)
                                        <div class="mb-3">
                                            <img src="{{ asset($category->icon) }}" alt="{{ $category->name }}"
                                                class="img-fluid rounded" />
                                        </div>
                                    @else
                                        <div class="mb-3 bg-light rounded p-5 text-center">
                                            <i class="ti ti-photo-off fs-40 text-muted"></i>
                                            <p class="text-muted mt-2">No image</p>
                                        </div>
                                    @endif
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-muted">Status</label>
                                    <p>
                                        @if ($category->status)
                                            <span class="badge badge-soft-success">Active</span>
                                        @else
                                            <span class="badge badge-soft-danger">Inactive</span>
                                        @endif
                                    </p>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label text-muted">Description</label>
                                    <div class="p-3 bg-light rounded">
                                        {!! $category->short_description !!}
                                    </div>
                                </div>
                            </div>

                            <!-- Meta Information -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-muted">Created</label>
                                    <p class="fs-5 fw-semibold">{{ $category->created_at->format('d M, Y h:i A') }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-muted">Last Updated</label>
                                    <p class="fs-5 fw-semibold">{{ $category->updated_at->format('d M, Y h:i A') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete Section -->
                <div class="card border-danger">
                    <div class="card-body">
                        <h5 class="card-title text-danger">Danger Zone</h5>
                        <p class="text-muted mb-3">Once you delete this category, there is no going back. Please be certain.
                        </p>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this category? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="ti ti-trash me-2"></i>Delete Category
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
