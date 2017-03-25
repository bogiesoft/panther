<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 09/01/16
 * Time: 4:26 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomAmenity extends Model
{
    protected $table = 'room_amenities';
    protected $fillable = ['name, hotel_id'];

    public function rooms()
    {
        return $this->hasMany('App\Models\Room');
    }
}