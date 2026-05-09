@extends('admin.layout.master')

@section('title', $blog->title)
@push('style')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="page-title-head d-flex align-items-center">
            <div class="flex-grow-1">
                <h4 class="page-main-title m-0">{{ $blog->title }}</h4>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-primary">
                    <i class="ti ti-edit me-2"></i>Edit
                </a>
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-light">
                    <i class="ti ti-arrow-left me-2"></i>Back
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-4">
                            <!-- Image -->
                            <div class="col-md-4">
                                @if($blog->image)
                                    <div class="mb-3">
                                        <img src="{{ asset( $blog->image) }}" alt="{{ $blog->title }}" class="img-fluid rounded" />
                                    </div>
                                @else
                                    <div class="mb-3 bg-light rounded p-5 text-center">
                                        <i class="ti ti-photo-off fs-40 text-muted"></i>
                                        <p class="text-muted mt-2">No image</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Details -->
                            <div class="col-md-8">
                                <!-- Title -->
                                <div class="mb-3">
                                    <label class="form-label text-muted">Title</label>
                                    <p class="fs-5 fw-semibold">{{ $blog->title }}</p>
                                </div>

                                <!-- Slug -->
                                <div class="mb-3">
                                    <label class="form-label text-muted">Slug</label>
                                    <p class="fs-5 fw-semibold">{{ $blog->slug }}</p>
                                </div>

                                <!-- Category -->
                                <div class="mb-3">
                                    <label class="form-label text-muted">Category</label>
                                    @if($blog->category)
                                        <p>
                                            <span class="badge badge-soft-primary fs-sm">{{ $blog->category->name }}</span>
                                        </p>
                                    @else
                                        <p class="text-muted">Not assigned</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label text-muted">Description</label>
                                    <div class="p-3 bg-light rounded">
                                        {!! $blog->description ?? 'No description provided' !!}
                                    </div>
                                </div>
                            </div>

                            <!-- Meta Information -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-muted">Created</label>
                                    <p class="fs-5 fw-semibold">{{ $blog->created_at->format('d M, Y h:i A') }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-muted">Last Updated</label>
                                    <p class="fs-5 fw-semibold">{{ $blog->updated_at->format('d M, Y h:i A') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete Section -->
                <div class="card border-danger">
                    <div class="card-body">
                        <h5 class="card-title text-danger">Danger Zone</h5>
                        <p class="text-muted mb-3">Once you delete this blog, there is no going back. Please be certain.</p>
                        <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="ti ti-trash me-2"></i>Delete Blog
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
