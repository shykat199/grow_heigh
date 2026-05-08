@extends('admin.layout.master')

@section('title','Edit Project')
@push('style')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="page-title-head d-flex align-items-center">
            <div class="flex-grow-1">
                <h4 class="page-main-title m-0">Edit Project</h4>
            </div>
            <div>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-light">
                    <i class="ti ti-arrow-left me-2"></i>Back to Projects
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row g-3">
                                <!-- Project Name -->
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Project Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           id="name"
                                           name="name"
                                           placeholder="e.g. E-commerce Platform"
                                           value="{{ old('name', $project->name) }}"
                                           required />
                                    @error('name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Project Title -->
                                <div class="col-md-6">
                                    <label for="title" class="form-label">Project Title <span class="text-danger">*</span></label>
                                    <input type="text"
                                           class="form-control @error('title') is-invalid @enderror"
                                           id="title"
                                           name="title"
                                           placeholder="e.g. Online Store Management"
                                           value="{{ old('title', $project->title) }}"
                                           required />
                                    @error('title')
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
                                           placeholder="e.g. ecommerce-platform"
                                           value="{{ old('slug', $project->slug) }}"
                                           required />
                                    @error('slug')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Category -->
                                <div class="col-md-6">
                                    <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                                    <select id="category_id"
                                            name="category_id"
                                            class="form-select @error('category_id') is-invalid @enderror"
                                            required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $project->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Project Image -->
                                <div class="col-md-6">
                                    <label for="image" class="form-label">Project Image</label>
                                    @if($project->image)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $project->image) }}" alt="Project" class="img-fluid rounded" style="height: 100px; object-fit: cover;" />
                                            <p class="text-muted fs-sm mt-1">Current image</p>
                                        </div>
                                    @endif
                                    <input type="file"
                                           class="form-control @error('image') is-invalid @enderror"
                                           id="image"
                                           name="image"
                                           accept="image/*" />
                                    <small class="text-muted">Supported: JPEG, PNG, JPG, GIF (Max 2MB)</small>
                                    @error('image')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Date -->
                                <div class="col-md-6">
                                    <label for="date" class="form-label">Project Date</label>
                                    <input type="date"
                                           class="form-control @error('date') is-invalid @enderror"
                                           id="date"
                                           name="date"
                                           value="{{ old('date', $project->date) }}" />
                                    @error('date')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select id="status"
                                            name="status"
                                            class="form-select @error('status') is-invalid @enderror"
                                            required>
                                        <option value="">Select Status</option>
                                        <option value="1" {{ old('status', $project->status) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $project->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Project Link -->
                                <div class="col-md-6">
                                    <label for="link" class="form-label">Project Link</label>
                                    <input type="url"
                                           class="form-control @error('link') is-invalid @enderror"
                                           id="link"
                                           name="link"
                                           placeholder="https://example.com"
                                           value="{{ old('link', $project->link) }}" />
                                    @error('link')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="col-md-12">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea id="description"
                                              name="description"
                                              class="form-control @error('description') is-invalid @enderror"
                                              rows="4"
                                              placeholder="Project description...">{{ old('description', $project->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row g-3 mt-4">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-check me-2"></i>Update Project
                                    </button>
                                    <a href="{{ route('admin.projects.index') }}" class="btn btn-light">
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
@endpush

