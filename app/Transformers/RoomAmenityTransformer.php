<?php
/**
 * Created by PhpStorm.
 * User: Philip
 * Date: 1/29/2017
 * Time: 10:56 AM
 */

namespace App\Transformers;


class RoomAmenityTransformer extends Transformer {

    public function transform($roomAmenity)
    {
        return [
            'id' => $roomAmenity['id'],
            'name' => $roomAmenity['name'],
        ];
    }
}