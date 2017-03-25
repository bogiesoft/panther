<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 09/01/16
 * Time: 4:56 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    protected $fillable = [
        'hotel_id',
        'name'
    ];
}