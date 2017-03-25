<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'room_id',
        'name',
        'bed_type_id',
    ];

    public function room()
    {
        return $this->belongsTo('App\Models\Room');
    }

    public function bed_type()
    {
        return $this->belongsTo('App\Models\BedType');
    }
}