<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Http\Requests\CreateCarRequest;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // zadatak 4 i 5:

        $perPage = $request->per_page ?? 10;
        $brandTerm = $request->query('brand');
        $model = $request->query('model');
        return Car::searchByBrand($brandTerm)->searchByModel($model)->paginate($perPage);
        // $query = Car::query();

        // if ($request->brand) {
        //     $brand = $request->brand;
        //     Car::searchByBrand($query, $brand);
        // }
        // if ($request->model) {
        //     $model = $request->model;
        //     Car::searchByModel($query, $model);
        // }

        // return $query->paginate($perPage);

        // zadatak 2:
        // $cars = Car::all();
        // return $cars;

        // zadatak 4:
        // $perPage = $request->query('per_age', 99999);
        // return Car::paginate($perPage);
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
    public function store(CreateCarRequest $request)
    {
        $validated = $request->validated();
        return Car::create([
            'brand' => $validated['brand'],
            'model' => $validated['model'],
            'year' => $validated['year'],
            'max_speed' => $validated['max_speed'],
            'is_automatic' => $validated['is_automatic'],
            'engine' => $validated['engine'],
            'number_of_doors' => $validated['number_of_doors'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Car::find($id);
        return $car;
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
    public function update(CreateCarRequest $request, $id)
    {
        $validated = $request->validated();

        $car = Car::find($id);
        $car->brand = $validated['brand'];
        $car->model = $validated['model'];
        $car->year = $validated['year'];
        $car->max_speed = $validated['max_speed'];
        $car->is_automatic = $validated['is_automatic'];
        $car->engine = $validated['engine'];
        $car->number_of_doors = $validated['number_of_doors'];
        $car->save();
        return $car;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = Car::find($id);
        $car->delete();
        return $car;
    }
}