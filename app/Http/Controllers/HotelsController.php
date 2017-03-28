<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Hotel;
use App\Transformers\HotelTransformer;

class HotelsController extends ApiController
{
    protected $hotelTransformer;

    public function __construct(HotelTransformer $hotelTransformer)
    {
        $this->hotelTransformer = $hotelTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels = Hotel::simplePaginate(5);

        return $this->respond($this->hotelTransformer->transformPaginatedCollection($hotels));
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
        if(!Input::has('name') or
            !Input::has('country') or
            !Input::has('city') or
            !Input::has('address') or
            !Input::has('postal') or
            !Input::has('phone') or
            !Input::has('email'))
        {
            return $this->respondFailedValidation();
        }

        $hotel = Hotel::create(Input::all());

        return $this->respondWithCreated($this->hotelTransformer->transform($hotel));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hotel = Request::user()
            ->hotels
            ->where('id', $id)
            ->first();

        if(is_null($hotel))
        {
            return $this->respondNotFound();
        }

        return $this->respond($this->hotelTransformer->transform($hotel));
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
        $hotel = Request::user()
            ->hotels
            ->where('id', $id)
            ->get();

        if(is_null($hotel))
        {
            return $this->respondUnauthorizedWithErrors("Hotel doesn't belong to user");
        }

        $hotel->update(Input::all());

        return $this->respondWithCreated($this->hotelTransformer->transform($hotel));
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
