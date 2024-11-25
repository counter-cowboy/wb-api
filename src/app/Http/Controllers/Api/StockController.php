<?php

namespace App\Http\Controllers\Api;
;

use App\Http\Controllers\Controller;
use App\Http\Requests\StockRequest;
use App\Http\Resources\StocksCollection;
use App\Filters\StockFilter;
use App\Models\Stock;
use Illuminate\Support\Facades\Http;

class StockController extends Controller
{
    public function list(StockRequest $request): StocksCollection
    {
        ini_set('max_execution_time', 240);
        $key = 'key';

        $data = $request->validated();
        $dateFrom = $data['dateFrom'];
        $page = $data['page'];
        $limit = $data['limit'];

        $response = Http::get("0.0.0.0:6969/api/stocks",
            [
                'dateFrom' => $dateFrom, // !!only today-date !!
                'page' => $page,
                'key' => $key,
                'limit' => $limit
            ]);
        $result[] = json_decode($response->getBody()->getContents(), true);

        foreach ($result as $datum)
            foreach ($datum['data'] as $arrData)
            {
                $arrData[]=['account_id'=>1];
                Stock::firstOrCreate($arrData);
            }

        return new StocksCollection(StockFilter::searchByRequest($request)
            ->paginate($limit ?? 500));
    }
}
