<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 03/04/16
 * Time: 1:27 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['purchased'];

    public function products()
    {
        return $this->hasMany('App\Models\PurchaseProduct');
    }
}