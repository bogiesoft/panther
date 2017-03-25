<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'name',
        'country',
        'city',
        'address',
        'postal',
        'phone',
        'fax',
        'email',
        'longitude',
        'latitude',
    ];

    public function owner()
    {
        return $this->belongsToMany('App\User');
    }

    public function employees()
    {
        return $this->hasMany('App\Models\Employee');
    }

    public function rooms()
    {
        return $this->hasMany('App\Models\Room');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function stays()
    {
        return $this->hasMany('App\Models\Stay');
    }

    public function bed_types()
    {
        return $this->hasMany('App\Models\BedType');
    }

    public function beds()
    {
        return $this->hasManyThrough('App\Models\Bed', 'App\Models\Room');
    }

    public function room_amenities()
    {
        return $this->hasMany('App\Models\RoomAmenity');
    }
}
