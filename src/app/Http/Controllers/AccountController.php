<?php

namespace App\Http\Controllers;

use App\Http\Requests\accountRequest;
use App\Models\account;

class AccountController extends Controller
{
    public function index()
    {
        return account::all();
    }

    public function store(accountRequest $request)
    {
        return account::create($request->validated());
    }

    public function show(account $account)
    {
        return $account;
    }

    public function update(accountRequest $request, account $account)
    {
        $account->update($request->validated());

        return $account;
    }

    public function destroy(account $account)
    {
        $account->delete();

        return response()->json();
    }
}
