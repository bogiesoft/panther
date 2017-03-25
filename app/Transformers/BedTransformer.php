<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 06/03/16
 * Time: 1:11 PM
 */

namespace App\Transformers;

class BedTransformer extends Transformer {

    protected $bedTypeTransformer;

    public function __construct(BedTypeTransformer $bedTypeTransformer)
    {
        $this->bedTypeTransformer = $bedTypeTransformer;
    }

    public function transform($bed)
    {
        return [
            'id' => $bed['id'],
            'name' => $bed['name'],
            'type' => $this->bedTypeTransformer->transform($bed['bed_type']),
        ];
    }
}