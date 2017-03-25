<?php

namespace App\Transformers;

class RoomTransformer extends Transformer
{
    protected $bedTransformer;
    protected $roomAmentityTransformer;

    public function __construct(BedTransformer $bedTransformer, RoomAmenityTransformer $roomAmentityTransformer)
    {
        $this->bedTransformer = $bedTransformer;
        $this->roomAmentityTransformer = $roomAmentityTransformer;
    }

    public function transform($room)
    {
        return [
            'id' => $room['id'],
            'name' => $room['name'],
            'number' => $room['number'],
            'floor' => $room['floor'],
            'size' => $room['size'],
            'capacity' => $room['capacity'],
            'price' => $room['price'],
            'private' => $room['private'],
            'suite' => $room['suite'],
            'beds' => $this->bedTransformer->transformCollection($room['beds']->all()),
            'amenities' => $this->roomAmentityTransformer->transformCollection($room['amenities']->all()),
        ];
    }
}
