<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 10/01/16
 * Time: 1:46 PM
 */

namespace App\Transformers;

class StaysTransformer extends Transformer {

    protected $userTransformer;
    protected $roomTransformer;
    protected $bedTransformer;

    public function __construct(
        UserTransformer $userTransformer,
        RoomTransformer $roomTransformer,
        BedTransformer $bedTransformer
        )
    {
        $this->userTransformer = $userTransformer;
        $this->roomTransformer = $roomTransformer;
        $this->bedTransformer = $bedTransformer;
    }

    public function transform($stay)
    {
        return [
            'start' => $stay['start'],
            'end' => $stay['end'],
            'checkin' => $stay['checkin'],
            'checkout' => $stay['checkout'],
            'guests' => $this->userTransformer->transformCollection($stay['guests']->all()),
            'rooms' => $this->roomTransformer->transformCollection($stay['rooms']->all()),
            'bed' => $this->bedTransformer->transform($stay['bed'])
        ];
    }
}