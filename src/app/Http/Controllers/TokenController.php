<?php

namespace App\Http\Controllers;

use App\Http\Requests\TokenRequest;
use App\Models\Token;

class TokenController extends Controller
{
    public function index()
    {
        return Token::all();
    }

    public function store(TokenRequest $request)
    {
        return Token::create($request->validated());
    }

    public function show(Token $token)
    {
        return $token;
    }

    public function update(TokenRequest $request, Token $token)
    {
        $token->update($request->validated());

        return $token;
    }

    public function destroy(Token $token)
    {
        $token->delete();

        return response()->json();
    }
}
