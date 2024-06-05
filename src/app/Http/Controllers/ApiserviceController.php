<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiserviceRequest;
use App\Models\Apiservice;

class ApiserviceController extends Controller
{
    public function index()
    {
        return Apiservice::all();
    }

    public function store(ApiserviceRequest $request)
    {
        return Apiservice::create($request->validated());
    }

    public function show(Apiservice $apiservice)
    {
        return $apiservice;
    }

    public function update(ApiserviceRequest $request, Apiservice $apiservice)
    {
        $apiservice->update($request->validated());

        return $apiservice;
    }

    public function destroy(Apiservice $apiservice)
    {
        $apiservice->delete();

        return response()->json();
    }
}
