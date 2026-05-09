<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Team;

class AboutUsController extends Controller
{
    public function frontIndex()
    {
        $testimonial = Testimonial::all();
        $team = Team::all();
        return view('about', compact('testimonial', 'team'));
    }
}
