<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 06/03/16
 * Time: 1:11 PM
 */

namespace App\Transformers;

class HotelTransformer extends Transformer {

    protected $hotelTypeTransformer;
    protected $facilityTransformer;

    public function __construct(HotelTypeTransformer $hotelTypeTransformer, FacilityTransformer $facilityTransformer)
    {
        $this->hotelTypeTransformer = $hotelTypeTransformer;
        $this->facilityTransformer = $facilityTransformer;
    }

    public function transform($hotel)
    {
        return [
            'id' => $hotel['id'],
            'name' => $hotel['name'],
            'country' => $hotel['country'],
            'city' => $hotel['city'],
            'address' => $hotel['address'],
            'postal' => $hotel['postal'],
            'phone' => $hotel['phone'],
            'type' => $this->hotelTypeTransformer->transform($hotel['type']),
            'facilities' => $this->facilityTransformer->transformCollection($hotel['facilities']->all()),
            'fax' => $hotel['fax'],
            'email' => $hotel['email'],
            'longitude' => $hotel['longitude'],
            'latitude' => $hotel['latitude'],
        ];
    }
}