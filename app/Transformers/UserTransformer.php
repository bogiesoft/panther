<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 06/03/16
 * Time: 1:11 PM
 */

namespace App\Transformers;

class UserTransformer extends Transformer {

    public function transform($user)
    {
        return [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'token' => $user['token'],
        ];
    }
}