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
                        <form action="{{ route('admin.site-settings.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <h5 class="mb-3">Branding Settings</h5>
                            <div class="row g-3">
                                <!-- Site Logo -->
                                <div class="col-md-6">
                                    <label for="site_logo" class="form-label">Site Logo</label>
                                    <input type="file" class="form-control" id="site_logo" name="site_logo" accept="image/*">
                                    <div class="mt-3">
                                        <img id="logoPreview" src="{{ isset($settings['site_logo']) ? asset($settings['site_logo']) : 'https://placehold.co/150x50?text=Logo' }}" alt="Logo Preview" class="img-thumbnail shadow-sm" style="max-width: 150px; max-height: 80px; object-fit: contain; border-radius: 8px;">
                                    </div>
                                </div>
                                <!-- Favicon -->
                                <div class="col-md-6">
                                    <label for="site_favicon" class="form-label">Favicon</label>
                                    <input type="file" class="form-control" id="site_favicon" name="site_favicon" accept="image/*">
                                    <div class="mt-3">
                                        <img id="faviconPreview" src="{{ isset($settings['site_favicon']) ? asset($settings['site_favicon']) : 'https://placehold.co/50x50?text=Fav' }}" alt="Favicon Preview" class="img-thumbnail shadow-sm" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                    </div>
                                </div>
                            </div>

                            <h5 class="mt-4 mb-3">Home Page Settings</h5>
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
                                <h5 class="mt-4 mb-3 col-12">Social Media Links</h5>
                                <div class="col-md-4">
                                    <label for="facebook_link" class="form-label">Facebook Link</label>
                                    <input type="text" class="form-control" id="facebook_link" name="facebook_link" value="{{ $settings['facebook_link'] ?? '' }}" placeholder="https://facebook.com/yourpage">
                                </div>
                                <div class="col-md-4">
                                    <label for="youtube_link" class="form-label">YouTube Link</label>
                                    <input type="text" class="form-control" id="youtube_link" name="youtube_link" value="{{ $settings['youtube_link'] ?? '' }}" placeholder="https://youtube.com/@yourchannel">
                                </div>
                                <div class="col-md-4">
                                    <label for="twitter_link" class="form-label">Twitter / X Link</label>
                                    <input type="text" class="form-control" id="twitter_link" name="twitter_link" value="{{ $settings['twitter_link'] ?? '' }}" placeholder="https://twitter.com/yourhandle">
                                </div>
                                <div class="col-md-6">
                                    <label for="instagram_link" class="form-label">Instagram Link</label>
                                    <input type="text" class="form-control" id="instagram_link" name="instagram_link" value="{{ $settings['instagram_link'] ?? '' }}" placeholder="https://instagram.com/yourprofile">
                                </div>
                                <div class="col-md-6">
                                    <label for="linkedin_link" class="form-label">LinkedIn Link</label>
                                    <input type="text" class="form-control" id="linkedin_link" name="linkedin_link" value="{{ $settings['linkedin_link'] ?? '' }}" placeholder="https://linkedin.com/company/yourcompany">
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

    // Image preview logic
    function setupImagePreview(inputId, previewId) {
        document.getElementById(inputId).addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    document.getElementById(previewId).src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }

    setupImagePreview('site_logo', 'logoPreview');
    setupImagePreview('site_favicon', 'faviconPreview');
</script>
@endpush
