<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 01/04/16
 * Time: 8:31 PM
 */

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\Input;

trait UserSessionTrait
{
    public function hotel_id()
    {
        return Input::get('hotel_id');
    }
}