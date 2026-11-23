<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'company_name',
        'logo',
        'favicon',
        'address',
        'phone',
        'email',
        'whatsapp',
        'social_media',
        'maps_embed',
        'meta_title',
        'meta_description',
    ];

    protected function casts(): array
    {
        return [
            'social_media' => 'array',
        ];
    }
}