<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;

use App\Models\Guest;
use App\Models\Stay;
use App\Models\Hotel;
use App\Transformers\GuestTransformer;


class GuestsController extends ApiController
{
    protected $guestTransformer;

    /**
     * GuestsController constructor.
     * @param $guestTransformer
     */
    public function __construct(GuestTransformer $guestTransformer)
    {
        $this->guestTransformer = $guestTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guests = Stay::where('hotel_id', $this->hotel_id())
            ->where('checkout', null)
            ->with("guests")
            ->get()
            ->pluck("guests")
            ->flatten();

        return $this->respond([
            'data' => $this->guestTransformer->transformCollection($guests->all())
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
        if(!Input::get('first_name') or ! Input::get('last_name') or ! Input::get('country'))
        {
            return $this->respondFailedValidation();
        }

        Guest::create(Input::all());

        return $this->respondCreated('Guest created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
