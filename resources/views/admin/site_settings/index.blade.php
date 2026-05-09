@extends('admin.layout.master')

@section('title', 'Site Settings')

@section('content')
    <div class="container-fluid">
        <div class="page-title-head d-flex align-items-center">
            <div class="flex-grow-1">
                <h4 class="page-main-title m-0">Site Settings</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.site-settings.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <h5 class="mb-3">Home Page Settings</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="homepage_title" class="form-label">Homepage Title</label>
                                    <input type="text" class="form-control" id="homepage_title" name="homepage_title" value="{{ $settings['homepage_title'] ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="homepage_subtitle" class="form-label">Homepage Subtitle</label>
                                    <input type="text" class="form-control" id="homepage_subtitle" name="homepage_subtitle" value="{{ $settings['homepage_subtitle'] ?? '' }}">
                                </div>
                            </div>

                            <h5 class="mt-4 mb-3">About Us Settings</h5>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="about_us_title" class="form-label">About Us Title</label>
                                    <input type="text" class="form-control" id="about_us_title" name="about_us_title" value="{{ $settings['about_us_title'] ?? '' }}">
                                </div>
                                <div class="col-md-12">
                                    <label for="about_us_description" class="form-label">About Us Description</label>
                                    <textarea class="form-control ckeditor" id="about_us_description" name="about_us_description" rows="4">{{ $settings['about_us_description'] ?? '' }}</textarea>
                                </div>
                            </div>

                            <h5 class="mt-4 mb-3">Footer & Contact Settings</h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="contact_email" class="form-label">Contact Email</label>
                                    <input type="email" class="form-control" id="contact_email" name="contact_email" value="{{ $settings['contact_email'] ?? '' }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="contact_number" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" id="contact_number" name="contact_number" value="{{ $settings['contact_number'] ?? '' }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="contact_fax" class="form-label">Contact Fax</label>
                                    <input type="text" class="form-control" id="contact_fax" name="contact_fax" value="{{ $settings['contact_fax'] ?? '' }}">
                                </div>
                                <div class="col-md-12">
                                    <label for="social_media_link" class="form-label">Social Media Link</label>
                                    <input type="text" class="form-control" id="social_media_link" name="social_media_link" value="{{ $settings['social_media_link'] ?? '' }}" placeholder="e.g. https://facebook.com/yourpage">
                                </div>
                                <div class="col-md-6">
                                    <label for="location_address" class="form-label">Location Address</label>
                                    <textarea class="form-control" id="location_address" name="location_address" rows="3">{{ $settings['location_address'] ?? '' }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="footer_short_description" class="form-label">Footer Short Description</label>
                                    <textarea class="form-control" id="footer_short_description" name="footer_short_description" rows="3">{{ $settings['footer_short_description'] ?? '' }}</textarea>
                                </div>
                            </div>

                            <div class="row g-3 mt-4">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-device-floppy me-2"></i>Save Settings
                                    </button>
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
            if (!CKEDITOR.instances[textarea.id]) {
                CKEDITOR.replace(textarea.id);
            }
        });
    });
</script>
@endpush
