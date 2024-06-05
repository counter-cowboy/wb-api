<?php

namespace App\Http\Controllers\Api;

use App\Filters\OrderFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrdersCollection;
use App\Models\Order;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function list(OrderRequest $request) : OrdersCollection
    {
        ini_set('max_execution_time', 240);
        $key = 'E6kUTYrYwZq2tN4QEtyzsbEBk3ie';

        $data = $request->validated();
        $dateFrom = $data['dateFrom'];
        $dateTo = $data['dateTo'];
        $page = $data['page'];
        $limit = $data['limit'];

        $response = Http::get("89.108.115.241:6969/api/orders",
            [
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
                'key' => $key,
                'page' => $page,
                'limit' => $limit
            ]);

        $result[] = json_decode($response->getBody()->getContents(), true);
//        dd($result);

        foreach ($result as $datum)
            foreach ($datum['data'] as $arrData)
            {
                $arrData[]=['account_id'=>1];
                Order::firstOrCreate($arrData);
            }


        return new OrdersCollection(OrderFilter::searchByRequest($request)
            ->paginate($limit ?? 500)
        );
    }
}
