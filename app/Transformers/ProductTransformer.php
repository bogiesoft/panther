<?php
/**
 * Created by PhpStorm.
 * User: Philip
 * Date: 11/27/2016
 * Time: 3:35 PM
 */

namespace App\Transformers;


class ProductTransformer extends Transformer {

    public function transform($product)
    {
        return [
            'id' => $product['id'],
            'name' => $product['name'],
            'image' => $product['image_path'] . '\\' . $product['image_name'] . '.' . $product['image_extension'],
            'price' => $product['price'],
            'inventory' => $product['inventory'],
            'available' => $product['available'],
        ];
    }
}