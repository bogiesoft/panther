<?php

namespace App\Transformers;

class FacilityTransformer extends Transformer 
{
    public function transform($facility)
    {
        return $facility['name'];
    }
}