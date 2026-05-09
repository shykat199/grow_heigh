@extends('admin.layout.master')

@section('title', $team->name)
@push('style')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="page-title-head d-flex align-items-center">
            <div class="flex-grow-1">
                <h4 class="page-main-title m-0">{{ $team->name }}</h4>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.teams.edit', $team->id) }}" class="btn btn-primary">
                    <i class="ti ti-edit me-2"></i>Edit
                </a>
                <a href="{{ route('admin.teams.index') }}" class="btn btn-light">
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
                                @if($team->image)
                                    <div class="mb-3">
                                        <img src="{{ asset( $team->image) }}" alt="{{ $team->name }}" class="img-fluid rounded" />
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
                                <!-- Name -->
                                <div class="mb-3">
                                    <label class="form-label text-muted">Name</label>
                                    <p class="fs-5 fw-semibold">{{ $team->name }}</p>
                                </div>

                                <!-- Position -->
                                <div class="mb-3">
                                    <label class="form-label text-muted">Position</label>
                                    <p class="fs-5 fw-semibold">{{ $team->position }}</p>
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label class="form-label text-muted">Email</label>
                                    <p class="fs-5 fw-semibold">
                                        @if($team->email)
                                            <a href="mailto:{{ $team->email }}">{{ $team->email }}</a>
                                        @else
                                            N/A
                                        @endif
                                    </p>
                                </div>

                                <!-- Social Links -->
                                <div class="mb-3">
                                    <label class="form-label text-muted">Social Links</label>
                                    <div class="d-flex gap-3 mt-1">
                                        @if($team->fb_link)
                                            <a href="{{ $team->fb_link }}" target="_blank" class="text-primary fs-4"><i class="ti ti-brand-facebook"></i></a>
                                        @endif
                                        @if($team->twitter_link)
                                            <a href="{{ $team->twitter_link }}" target="_blank" class="text-info fs-4"><i class="ti ti-brand-twitter"></i></a>
                                        @endif
                                        @if($team->linkedin_link)
                                            <a href="{{ $team->linkedin_link }}" target="_blank" class="text-primary fs-4"><i class="ti ti-brand-linkedin"></i></a>
                                        @endif
                                        @if($team->insta_link)
                                            <a href="{{ $team->insta_link }}" target="_blank" class="text-danger fs-4"><i class="ti ti-brand-instagram"></i></a>
                                        @endif
                                        @if(!$team->fb_link && !$team->twitter_link && !$team->linkedin_link && !$team->insta_link)
                                            <p class="text-muted mb-0">No social links provided.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Bio -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label text-muted">Bio</label>
                                    <div class="p-3 bg-light rounded">
                                        {!! $team->bio ?? 'No biography provided' !!}
                                    </div>
                                </div>
                            </div>

                            <!-- Meta Information -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-muted">Created</label>
                                    <p class="fs-5 fw-semibold">{{ $team->created_at->format('d M, Y h:i A') }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-muted">Last Updated</label>
                                    <p class="fs-5 fw-semibold">{{ $team->updated_at->format('d M, Y h:i A') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete Section -->
                <div class="card border-danger">
                    <div class="card-body">
                        <h5 class="card-title text-danger">Danger Zone</h5>
                        <p class="text-muted mb-3">Once you delete this team member, there is no going back. Please be certain.</p>
                        <form action="{{ route('admin.teams.destroy', $team->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this team member? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="ti ti-trash me-2"></i>Delete Team Member
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
