@extends('admin.layout.master')

@section('title', $service->name)
@push('style')
    <style>
        .gallery-img { width: 100px; height: 100px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd; margin-right: 10px; margin-bottom: 10px; }
        .price-box { border: 1px solid #eef2f7; border-radius: 8px; padding: 20px; background: #fff; height: 100%; box-shadow: 0 2px 4px rgba(0,0,0,0.02); }
        .price-box h3 { font-size: 1.5rem; margin-bottom: 15px; color: #333; }
        .price-box .price { font-size: 2rem; font-weight: bold; color: #556ee6; margin-bottom: 20px; }
        .price-box ul { list-style: none; padding-left: 0; margin-bottom: 0; }
        .price-box ul li { padding: 8px 0; border-bottom: 1px solid #f1f5f7; display: flex; align-items: center; }
        .price-box ul li:last-child { border-bottom: none; }
        .price-box ul li i { color: #34c38f; margin-right: 10px; }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="page-title-head d-flex align-items-center">
            <div class="flex-grow-1">
                <h4 class="page-main-title m-0">{{ $service->name }}</h4>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-primary">
                    <i class="ti ti-edit me-2"></i>Edit
                </a>
                <a href="{{ route('admin.services.index') }}" class="btn btn-light">
                    <i class="ti ti-arrow-left me-2"></i>Back
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row g-4">
                            <!-- Icon -->
                            <div class="col-md-3">
                                @if($service->icon)
                                    <div class="mb-3 text-center bg-light rounded p-4">
                                        <img src="{{ asset( $service->icon) }}" alt="{{ $service->name }}" class="img-fluid" style="max-height: 150px;" />
                                    </div>
                                @else
                                    <div class="mb-3 bg-light rounded p-5 text-center">
                                        <i class="ti ti-photo-off fs-40 text-muted"></i>
                                        <p class="text-muted mt-2">No icon</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Details -->
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted">Name</label>
                                        <p class="fs-5 fw-semibold">{{ $service->name }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted">Slug</label>
                                        <p class="fs-5 fw-semibold">{{ $service->slug }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted">Category</label>
                                        @if($service->category)
                                            <p><span class="badge badge-soft-primary fs-sm">{{ $service->category->name }}</span></p>
                                        @else
                                            <p class="text-muted">Not assigned</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted">Short Description</label>
                                    <p class="fs-6">{{ $service->short_description ?: 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Descriptions -->
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header border-bottom-0"><h4 class="card-title m-0">Description</h4></div>
                            <div class="card-body bg-light rounded m-3 mt-0 p-3">
                                {!! $service->description ?? '<span class="text-muted">No description provided</span>' !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header border-bottom-0"><h4 class="card-title m-0">Work Benefits</h4></div>
                            <div class="card-body bg-light rounded m-3 mt-0 p-3">
                                {!! $service->work_benefit ?? '<span class="text-muted">No work benefits provided</span>' !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gallery -->
                <div class="card mb-4">
                    <div class="card-header border-bottom-0"><h4 class="card-title m-0">Gallery Images ({{ $service->images->count() }})</h4></div>
                    <div class="card-body">
                        @if($service->images->count() > 0)
                            <div class="d-flex flex-wrap">
                                @foreach($service->images as $img)
                                    <img src="{{ asset($img->images) }}" class="gallery-img shadow-sm">
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">No images available for this service.</p>
                        @endif
                    </div>
                </div>

                <!-- Prices -->
                <div class="card mb-4 bg-transparent border-0 shadow-none">
                    <h4 class="mb-3">Pricing Packages ({{ $service->prices->count() }})</h4>
                    @if($service->prices->count() > 0)
                        <div class="row g-4">
                            @foreach($service->prices as $price)
                            <div class="col-md-4">
                                <div class="price-box">
                                    <h3>{{ $price->title }}</h3>
                                    <div class="price">${{ number_format($price->price, 2) }}</div>
                                    <ul>
                                        @foreach($price->items as $item)
                                            <li><i class="ti ti-check"></i> {{ $item }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="card"><div class="card-body"><p class="text-muted mb-0">No pricing packages available.</p></div></div>
                    @endif
                </div>

                <!-- FAQs -->
                <div class="card mb-4">
                    <div class="card-header border-bottom-0"><h4 class="card-title m-0">Frequently Asked Questions ({{ $service->faqs->count() }})</h4></div>
                    <div class="card-body">
                        @if($service->faqs->count() > 0)
                            <div class="accordion" id="faqAccordion">
                                @foreach($service->faqs as $index => $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $index }}">
                                        <button class="accordion-button {{ $index == 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                            Q: {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            A: {{ $faq->answer }}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted mb-0">No FAQs available.</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
