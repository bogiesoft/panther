<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\Input;

use App\Models\Hotel;
use App\Transformers\HotelTransformer;

class HotelsController extends ApiController
{
    protected $hotelTransformer;
    protected $hotel;

    public function __construct(Hotel $hotel, HotelTransformer $hotelTransformer)
    {
        $this->hotel = $hotel;
        $this->hotelTransformer = $hotelTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels = Hotel::where('user_id', $this->getAuthenticatedUser()->id)
            ->with("facilities")
            ->with("type")
            ->get();

        return $this->respond($this->hotelTransformer->transformCollection($hotels->all()));
    }

    public function search($query)
    {
        $hotels = Hotel::search($query)->paginate(10);

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
        $input = Input::all();

        if(!$this->hotel->fill($input)->isValid())
        {
            return $this->hotel->errors;
        }
        else
        {
            $this->hotel->user_id = $this->getAuthenticatedUser()->id;
            $this->hotel->save();
            return $this->respondWithCreated($this->hotelTransformer->transform($this->hotel));
        }
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
