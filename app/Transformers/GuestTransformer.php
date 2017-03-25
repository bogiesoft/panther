<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 10/01/16
 * Time: 1:15 PM
 */

namespace App\Transformers;


class GuestTransformer extends Transformer {

    public function transform($guest)
    {
        return [
            'id' => $guest['id'],
            'first_name' => $guest['first_name'],
            'last_name' => $guest['last_name'],
            'country' => $guest['country'],
        ];
    }
}
