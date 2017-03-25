<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 03/04/16
 * Time: 3:35 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseProduct extends Model
{
    protected $fillable = [
        'price',
        'quantity'
    ];

    public function purchase()
    {
        return $this->belongsTo('App\Models\Purchase');
    }
}