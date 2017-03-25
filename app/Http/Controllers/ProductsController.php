<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;
use App\Transformers\ProductTransformer;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Product;
use Illuminate\Support\Facades\Input;

class ProductsController extends ApiController
{
    protected $productTransformer;

    public function __construct(ProductTransformer $productTransformer)
    {
        $this->productTransformer = $productTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Hotel::find($this->hotel_id())
            ->products;

        return $this->respond([
            'data' => $this->productTransformer->transformCollection($products->all())
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
            ! Input::get('image_name') or
            ! Input::get('image_path') or
            ! Input::get('image_extension') or
            ! Input::get('image_name_small') or
            ! Input::get('image_path_small') or
            ! Input::get('image_extension_small') or
            ! Input::get('inventory') or
            ! Input::get('price') or
            ! Input::get('available') )
        {
            return $this->respondFailedValidation();
        }

        $product = Product::create(Input::all());

        return $this->respondWithCreated([
            'data' => $this->productTransformer->transform($product)],
            "Product created successfully"
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
        $product = Hotel::find($this->hotel_id())
            ->products
            ->where('id', $id)
            ->first();

        if(!$product)
        {
            return $this->respondNotFound('Product does not exist');
        }

        return $this->respond([
            'data' => $this->productTransformer->transform($product)
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
        $product = Hotel::find($this->hotel_id())
            ->products
            ->where('id', $id)
            ->first();

        if(is_null($product))
        {
            return $this->respondNotFound();
        }

        $product->update(Input::all());

        return $this->respondWithCreated([
            'data' => $this->productTransformer->transform($product)],
            "Product updated successfully"
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
