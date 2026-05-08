<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['service_id', 'title', 'price', 'item'])]
class ServicePrice extends Model
{

    /**
     * Get the service that owns the price.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    /**
     * Get items as an array by splitting comma-separated values.
     */
    public function getItemsAttribute(): array
    {
        if (!$this->item) {
            return [];
        }
        return array_filter(array_map('trim', explode(',', $this->item)));
    }

    /**
     * Set items by joining array with comma.
     */
    public function setItemsAttribute(array $items): void
    {
        $this->attributes['item'] = implode(', ', array_filter($items));
    }
}

