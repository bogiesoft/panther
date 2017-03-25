<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Transformers\RoomTransformer;

use App\Models\Room;
use App\Models\Hotel;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class RoomsController extends ApiController
{
    protected $roomTransformer;

    public function __construct(RoomTransformer $roomTransformer)
    {
        $this->roomTransformer = $roomTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Hotel::find($this->hotel_id())
            ->rooms;

        return $this->respond([
            'data' => $this->roomTransformer->transformCollection($rooms->all())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Input::get('name') or
            ! Input::get('number') or
            ! Input::get('floor') or
            ! Input::get('size') or
            ! Input::get('capacity') or
            ! Input::get('price') or
            ! Input::get('private') or
            ! Input::get('suite'))
        {
            return $this->respondFailedValidation();
        }

        $room = Room::create(Input::all());

        return $this->respondWithCreated([
            'data' => $this->roomTransformer->transform($room)],
            "Room created successfully"
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = Hotel::find($this->hotel_id())
            ->rooms
            ->where('id', $id)
            ->first();

        if(!$room)
        {
            return $this->respondNotFound('Room does not exist');
        }

        return $this->respond([
            'data' => $this->roomTransformer->transform($room)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $room = Hotel::find($this->hotel_id())
            ->rooms
            ->where('id', $id)
            ->first();

        if(is_null($room))
        {
            return $this->respondNotFound();
        }

        $room->update(Input::all());

        return $this->respondWithCreated([
            'data' => $this->roomTransformer->transform($room)],
            "Room updated successfully"
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
