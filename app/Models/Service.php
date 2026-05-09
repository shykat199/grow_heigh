<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['cat_id', 'name', 'slug', 'short_description', 'icon', 'description', 'work_benefit'])]
class Service extends Model
{

    /**
     * Get the category that owns the service.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    /**
     * Get the FAQs for the service.
     */
    public function faqs()
    {
        return $this->hasMany(ServiceFaq::class, 'service_id');
    }

    /**
     * Get the images for the service.
     */
    public function images()
    {
        return $this->hasMany(ServiceImage::class, 'service_id');
    }

    /**
     * Get the prices for the service.
     */
    public function prices()
    {
        return $this->hasMany(ServicePrice::class, 'service_id');
    }
}

