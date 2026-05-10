<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Service;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\Team;
use App\Models\Blog;
class HomeController extends Controller
{
    public function index()
    {
        $category = Category::where('type','service')->get();
        $service = Service::all();
        $projects = Project::with('category')->latest()->take(5)->get();
        $testimonial = Testimonial::all();
        $team = Team::all();
        $blog = Blog::all();
        return view('index', compact('category', 'service', 'projects', 'testimonial', 'team', 'blog'));
    }
}
