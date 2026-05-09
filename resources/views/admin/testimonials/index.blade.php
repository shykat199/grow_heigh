@extends('admin.layout.master')

@section('title','Testimonials')
@push('style')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="page-title-head d-flex align-items-center">
            <div class="flex-grow-1">
                <h4 class="page-main-title m-0">Testimonials</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div data-table data-table-rows-per-page="8" class="card">
                    <div class="card-header border-light justify-content-between">
                        <div class="d-flex gap-2">
                            <div class="app-search">
                                <input data-table-search type="search" class="form-control" placeholder="Search testimonial..." />
                                <i class="ti ti-search app-search-icon text-muted"></i>
                            </div>

                            <button data-table-delete-selected class="btn btn-danger d-none">Delete</button>
                        </div>

                        <div class="d-flex align-items-center gap-1">
                            <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary ms-1"> <i class="ti ti-plus fs-sm me-2"></i> Add Testimonial </a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-custom table-centered table-select table-hover w-100 mb-0">
                            <thead class="bg-light align-middle bg-opacity-25 thead-sm">
                            <tr class="text-uppercase fs-xxs">
                                <th class="ps-3" style="width: 1%">
                                    <input data-table-select-all class="form-check-input form-check-input-light fs-14 mt-0" type="checkbox" value="option" />
                                </th>
                                <th data-table-sort="name">Name</th>
                                <th data-table-sort="title">Title</th>
                                <th class="text-center" style="width: 1%">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($testimonials as $testimonial)
                            <tr>
                                <td class="ps-3">
                                    <input class="form-check-input form-check-input-light fs-14 product-item-check mt-0" type="checkbox" value="{{ $testimonial->id }}" />
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($testimonial->image)
                                        <div class="avatar-md me-3">
                                            <img src="{{ asset($testimonial->image) }}" alt="Testimonial" class="img-fluid rounded" style="height: 50px; object-fit: cover;" />
                                        </div>
                                        @endif
                                        <div>
                                            <h5 class="mb-0">
                                                <a href="{{ route('admin.testimonials.show', $testimonial->id) }}" class="link-reset">{{ $testimonial->name }}</a>
                                            </h5>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $testimonial->title }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('admin.testimonials.show', $testimonial->id) }}" class="btn btn-default btn-icon btn-sm" title="View"><i class="ti ti-eye fs-lg"></i></a>
                                        <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="btn btn-default btn-icon btn-sm" title="Edit"><i class="ti ti-edit fs-lg"></i></a>
                                        <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-default btn-icon btn-sm" title="Delete"><i class="ti ti-trash fs-lg"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <p class="text-muted mb-0">No testimonials found. <a href="{{ route('admin.testimonials.create') }}" class="link-reset">Create one</a></p>
                                </td>
                            </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div data-table-pagination-info="testimonials"></div>
                            <div data-table-pagination></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
@endsection

@push('scripts')
@endpush
