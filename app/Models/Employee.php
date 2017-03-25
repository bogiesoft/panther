<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['first_name',
        'last_name',
        'birth_date',
        'email',
        'phone',
        'country',
        'city',
        'address',
        'postal',
        'active'
    ];

    public function employees()
    {
        return $this->belongsTo('App\Models\Hotel');
    }
}