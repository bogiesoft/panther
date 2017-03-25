<?php

namespace App\Transformers;
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 09/01/16
 * Time: 2:40 PM
 */
abstract class Transformer
{

    public function transformCollection(array $items)
    {
        return array_map([$this, 'transform'], $items);
    }

    public abstract function transform($item);
}