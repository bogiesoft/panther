<?php

namespace App\Models;

use Validator;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Company extends Model
{
    use Searchable;

    protected $table = "companies";

    protected $fillable = [
        'name',
        'email',
        'country',
        'city',
        'address',
        'postal',
        'phone',
        'fax'
    ];
    
    protected $rules = array(
        'name'      => 'required|unique:companies,name',
        'email'     => 'required|email|unique:companies,email',
        'country'   => 'required', 
        'city'      => 'required',
        'address'   => 'required',
        'postal'    => 'required',
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
        return $this->belongsTo('App\User');
    }

    public function employees()
    {
        return $this->belongsToMany('App\User', 'company_employee')->withPivot('hotel_id');
    }

    public function hotels()
    {
        return $this->hasMany('App\Models\Hotel');
    }
}
