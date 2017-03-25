<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Transformers\BedTransformer;
use Illuminate\Http\Request;

use Requests;

use App\Models\Hotel;
use App\Models\Bed;
use App\Models\Guest;

class BedsController extends ApiController
{
    protected $bedTransformer;

    public function __construct(BedTransformer $bedTransformer)
    {
        $this->bedTransformer = $bedTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beds = Hotel::find($this->hotel_id())
            ->beds
            ->all();

        return $this->respond([
            'beds' => $this->bedTransformer->transformCollection($beds)
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
     * room_id
     * name
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Input::has('room_id') or
            !Input::has('bed_type_id') or
            !Input::has('name') )
        {
            return $this->respondFailedValidation();
        }

        $bed = Bed::create(Input::all());

        return $this->respondWithCreated([
            'data' => $this->bedTransformer->transform($bed)],
            'Bed created successfully'
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
        $bed = Hotel::find($this->hotel_id())
            ->beds
            ->where('id', $id)
            ->first();

        if(is_null($bed))
        {
            return $this->respondNotFound();
        }

        $bed->update(Input::all());

        return $this->respondWithCreated([
            'data' => $this->employeeTransformer->transform($bed)],
            "Bed updated successfully"
        );
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
