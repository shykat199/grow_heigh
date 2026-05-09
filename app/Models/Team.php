<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'position', 'image', 'email', 'bio', 'fb_link', 'twitter_link', 'linkedin_link', 'insta_link'])]
class Team extends Model
{
    use HasFactory;
}

