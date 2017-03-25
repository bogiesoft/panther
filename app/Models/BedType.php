<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BedType extends Model
{
    protected $fillable = [
        'hotel_id',
        'type'
    ];

    public function beds()
    {
        return $this->hasMany('App\Models\Bed');
    }
}
