<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Portfolio extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'client',
        'project_date',
        'cover_image',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'project_date' => 'date',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
