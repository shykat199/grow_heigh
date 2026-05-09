@extends('layout.app')
@section('title', 'Project')
@push('style')
@endpush

@section('content')
    <!-- Start Page Title Area -->
    <section class="page-title-area uk-page-title">
        <div class="uk-container">
            <h1>Project</h1>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Project</li>
            </ul>
        </div>
    </section>
    <!-- End Page Title Area -->

    <!-- Start Project Area -->
    <section id="project" class="project-area uk-project uk-section">
        <div class="uk-container">
            <div class="uk-grid uk-grid-match uk-grid-medium uk-child-width-1-3@m uk-child-width-1-2@s">
                @foreach ($projects as $project)
                    <div class="single-project">
                        <a href="{{ route('project.show', $project->slug) }}" class="project-img">
                            <img src="{{ asset($project->image) }}" alt="image" />
                        </a>

                        <div class="project-content">
                            <h3><a href="{{ route('project.show', $project->slug) }}">{{ $project->title }}</a></h3>
                            <ul>
                                <li><a href="#">{{ $project->category->name }}</a></li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Project Area -->
@endsection
@push('scripts')
@endpush
