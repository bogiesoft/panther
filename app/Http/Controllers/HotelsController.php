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

        return $this->respond([
            'data' => $this->hotelTransformer->transformCollection($hotels->all())
        ]);
    }

    public function search($query)
    {
        $hotels = Hotel::search($query)->paginate(10);

        return $this->respond($this->hotelTransformer->transformPaginatedCollection($hotels));
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

            return $this->respondWithCreated([
                'data' => $this->hotelTransformer->transform($this->hotel)
            ]);
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
        $this->hotel = Hotel::where('id', $id)
            ->with("facilities")
            ->with("type")
            ->first();

        if(is_null($this->hotel))
        {
            return $this->respondNotFound();
        }

        return $this->respond([
            'data' => $this->hotelTransformer->transform($this->hotel)
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
        $this->hotel = Hotel::where('id', $id)
            ->with("facilities")
            ->with("type")
            ->first();

        if(is_null($this->hotel))
        {
            return $this->respondNotFound("Hotel not found");
        }
        
        $this->hotel->update(Input::all());
        $this->hotel->save();

        return $this->respondWithCreated([
            'data' => $this->hotelTransformer->transform($this->hotel)
        ]);
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
