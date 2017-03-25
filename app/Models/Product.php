<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'hotel_id',
        'name',
        'image_name',
        'image_path',
        'image_extension',
        'image_name_small',
        'image_path_small',
        'image_extension_small',
        'inventory',
        'price',
        'available',
    ];

    public function hotel()
    {
        return $this->belongsTo('App\Models\Hotel');
    }
}
