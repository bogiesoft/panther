<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Stay;
use App\Models\Room;
use App\Http\Requests;
use App\Models\Hotel;
use App\Transformers\StaysTransformer;
use App\Http\Controllers\Controller;

/**
 * Class StaysController
 * @package App\Http\Controllers
 */
class StaysController extends ApiController
{
    /**
        * @var StaysTransformer
    */
    protected $staysTransformer;

    /**
     * StaysController constructor.
     * @param StaysTransformer $staysTransformer
     */
    public function __construct(StaysTransformer $staysTransformer)
    {
        $this->staysTransformer = $staysTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stays = Hotel::find($this->hotel_id())
            ->stays
            ->where('checkin', '<>', null)
            ->where('checkout', null);

        return $this->respond([
            'data' => $this
                ->staysTransformer
                ->transformCollection($stays->all())
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
        //
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
