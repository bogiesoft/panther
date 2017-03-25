<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 06/03/16
 * Time: 1:11 PM
 */

namespace App\Transformers;

class HotelTransformer extends Transformer {

    public function transform($hotel)
    {
        return [
            'id' => $hotel['id'],
            'name' => $hotel['name'],
            'country' => $hotel['country'],
            'city' => $hotel['city'],
            'address' => $hotel['address'],
            'postal' => $hotel['postal'],
            'phone' => $hotel['phone'],
            'fax' => $hotel['fax'],
            'email' => $hotel['email'],
            'longitude' => $hotel['longitude'],
            'latitude' => $hotel['latitude'],
        ];
    }
}