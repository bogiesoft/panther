<?php
/**
 * Created by PhpStorm.
 * User: Philip
 * Date: 11/27/2016
 * Time: 12:17 PM
 */

namespace App\Transformers;

class BedTypeTransformer extends Transformer {

    public function transform($bed_type)
    {
        return $bed_type['type'];
    }
}