<?php

namespace App\Http\Controllers;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\Models\Employee;
use App\Models\Hotel;
use App\Transformers\EmployeeTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EmployeesController extends ApiController
{
    protected $employeeTransformer;

    public function __construct(EmployeeTransformer $employeeTransformer)
    {
        $this->employeeTransformer = $employeeTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotel_id = Input::get('hotel_id');

        $employees = JWTAuth::parseToken()
            ->authenticate()
            ->company
            ->employees;

        if(!is_null($hotel_id))
        {
            $employees = $employees
                ->where("pivot.hotel_id", $hotel_id);
        }

        if(is_null($employees))
        {
            return $this->respondNotFound();
        }

        return $this->respond([
            'data' => $this->employeeTransformer->transformCollection($employees->all())
        ]);
    }
    
    /**
     * Store a newly created resource in storage
     *
     * first_name
     * last_name
     * birth_date
     * email
     * phone
     * country
     * city
     * address
     * postal
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Input::has('first_name') or
            !Input::has('last_name') or
            !Input::has('birth_date') or
            !Input::has('email') or
            !Input::has('phone') or
            !Input::has('country') or
            !Input::has('city') or
            !Input::has('address') or
            !Input::has('postal'))
        {
            return $this->respondFailedValidation();
        }

        $employee = Employee::create(Input::all());

        return $this->respondWithCreated([
            'data' => $this->employeeTransformer->transform($employee)],
            'Employee created successfully'
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
        $employee = Hotel::find($this->hotel_id())
            ->employees
            ->where('id', $id)
            ->first();

        if(!$employee)
        {
            return $this->respondNotFound('Employee does not exist');
        }

        return $this->respond([
            'data' => $this->employeeTransformer->transform($employee)
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
        $employee = Hotel::find($this->hotel_id())
            ->employees
            ->where('id', $id)
            ->first();

        if(is_null($employee))
        {
            return $this->respondNotFound();
        }

        $employee->update(Input::all());

        return $this->respondWithCreated([
            'data' => $this->employeeTransformer->transform($employee)],
            "Employee updated successfully"
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
