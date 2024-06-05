<?php

namespace App\Http\Controllers;

use App\Http\Requests\TokentypeRequest;
use App\Models\Tokentype;

class TokentypeController extends Controller
{
    public function index()
    {
        return Tokentype::all();
    }

    public function store(TokentypeRequest $request)
    {
        return Tokentype::create($request->validated());
    }

    public function show(Tokentype $tokentype)
    {
        return $tokentype;
    }

    public function update(TokentypeRequest $request, Tokentype $tokentype)
    {
        $tokentype->update($request->validated());

        return $tokentype;
    }

    public function destroy(Tokentype $tokentype)
    {
        $tokentype->delete();

        return response()->json();
    }
}
