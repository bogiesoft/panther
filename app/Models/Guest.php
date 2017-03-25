<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = ['first_name', 'last_name', 'country'];

    public function purchases()
    {
        return $this->hasMany('App\Models\Purchase');
    }

    public function stays()
    {
        return $this->hasMany('App\Models\Stay');
    }
}
