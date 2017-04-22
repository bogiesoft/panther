<?php

namespace App\Models;

use Validator;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Hotel extends Model
{
    use Searchable;

    protected $fillable = [
        'name',
        'email',
        'type_id',
        'country',
        'city',
        'address',
        'postal',
        'phone',
        'fax',
        'longitude',
        'latitude',
    ];
    
    protected $rules = array(
        'name'      => 'required|unique:hotels,name',
        'email'     => 'required|email|unique:hotels,email',
        'type_id'   => 'required|integer',
        'country'   => 'required', 
        'city'      => 'required',
        'address'   => 'required',
        'postal'    => 'required',
        'longitude' => 'required',
        'latitude'  => 'required',
    );

    public $errors;

    public function isValid()
    {
        $validation = Validator::make($this->attributes, $this->rules);

        if ($validation->passes())
        {
            return true;
        }
        else
        {
            $this->errors = $validation->messages(); 
            return false;
        }
    }

    public function owner()
    {
        return $this->belongsToMany('App\User');
    }

    public function employees()
    {
        return $this->belongsToMany('App\User', 'employee_hotel');
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

    public function facilities()
    {
        return $this->belongsToMany('App\Models\Facility');
    }

    public function type()
    {
        return $this->belongsTo("App\Models\HotelType");
    }
}
