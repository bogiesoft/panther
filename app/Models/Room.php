<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'number',
        'floor',
        'size',
        'capacity',
        'price',
        'private',
        'suite'
    ];

    public function beds()
    {
        return $this->hasMany('App\Models\Bed');
    }

    public function hotel()
    {
        return $this->belongsTo('App\Models\Hotel');
    }

    public function amenities()
    {
        return $this->belongsToMany('App\Models\RoomAmenity');
    }
}
