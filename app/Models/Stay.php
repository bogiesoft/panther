<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 10/01/16
 * Time: 1:28 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stay extends Model
{
    protected $fillable = ['checkin', 'checkout'];

    public function bed()
    {
        return $this->belongsTo('App\Models\Bed');
    }

    public function guests()
    {
        return $this->belongsToMany('App\Models\Guest');
    }

    public function rooms()
    {
        return $this->belongsToMany('App\Models\Room');
    }
}