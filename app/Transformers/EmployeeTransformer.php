<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 02/04/16
 * Time: 1:33 PM
 */

namespace App\Transformers;

class EmployeeTransformer extends Transformer
{
    public function transform($employee)
    {
        return [
            'id' => $employee['id'],
            'first_name' => $employee['first_name'],
            'last_name' => $employee['last_name'],
            'birth_date' => $employee['birth_date'],
            'email' => $employee['email'],
            'phone' => $employee['phone'],
            'country' => $employee['country'],
            'city' => $employee['city'],
            'address' => $employee['address'],
            'postal' => $employee['postal'],
        ];
    }
}