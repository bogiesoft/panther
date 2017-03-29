<?php

namespace App\Transformers;

class HotelTypeTransformer extends Transformer 
{
    public function transform($hotel_type)
    {
        return $hotel_type['type'];
    }
}