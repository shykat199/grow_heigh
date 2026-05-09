@extends('admin.layout.master')

@section('title','Create Team Member')
@push('style')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="page-title-head d-flex align-items-center">
            <div class="flex-grow-1">
                <h4 class="page-main-title m-0">Create Team Member</h4>
            </div>
            <div>
                <a href="{{ route('admin.teams.index') }}" class="btn btn-light">
                    <i class="ti ti-arrow-left me-2"></i>Back to Teams
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.teams.store') }}" method="POST" enctype="multipart/form-data">
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

                                <!-- Position -->
                                <div class="col-md-6">
                                    <label for="position" class="form-label">Position <span class="text-danger">*</span></label>
                                    <input type="text"
                                           class="form-control @error('position') is-invalid @enderror"
                                           id="position"
                                           name="position"
                                           placeholder="e.g. Lead Developer"
                                           value="{{ old('position') }}"
                                           required />
                                    @error('position')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           id="email"
                                           name="email"
                                           placeholder="e.g. john@example.com"
                                           value="{{ old('email') }}" />
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Image -->
                                <div class="col-md-6">
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

                                <!-- Social Links -->
                                <div class="col-md-6">
                                    <label for="fb_link" class="form-label">Facebook Link</label>
                                    <input type="url"
                                           class="form-control @error('fb_link') is-invalid @enderror"
                                           id="fb_link"
                                           name="fb_link"
                                           placeholder="https://facebook.com/..."
                                           value="{{ old('fb_link') }}" />
                                    @error('fb_link')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="twitter_link" class="form-label">Twitter/X Link</label>
                                    <input type="url"
                                           class="form-control @error('twitter_link') is-invalid @enderror"
                                           id="twitter_link"
                                           name="twitter_link"
                                           placeholder="https://twitter.com/..."
                                           value="{{ old('twitter_link') }}" />
                                    @error('twitter_link')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="linkedin_link" class="form-label">LinkedIn Link</label>
                                    <input type="url"
                                           class="form-control @error('linkedin_link') is-invalid @enderror"
                                           id="linkedin_link"
                                           name="linkedin_link"
                                           placeholder="https://linkedin.com/in/..."
                                           value="{{ old('linkedin_link') }}" />
                                    @error('linkedin_link')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="insta_link" class="form-label">Instagram Link</label>
                                    <input type="url"
                                           class="form-control @error('insta_link') is-invalid @enderror"
                                           id="insta_link"
                                           name="insta_link"
                                           placeholder="https://instagram.com/..."
                                           value="{{ old('insta_link') }}" />
                                    @error('insta_link')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Bio -->
                                <div class="col-md-12">
                                    <label for="bio" class="form-label">Bio</label>
                                    <textarea id="bio"
                                              name="bio"
                                              class="form-control ckeditor @error('bio') is-invalid @enderror"
                                              rows="4"
                                              placeholder="Member biography...">{{ old('bio') }}</textarea>
                                    @error('bio')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row g-3 mt-4">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-check me-2"></i>Create Team Member
                                    </button>
                                    <a href="{{ route('admin.teams.index') }}" class="btn btn-light">
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
