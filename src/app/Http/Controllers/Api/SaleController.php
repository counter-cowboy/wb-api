<?php

namespace App\Http\Controllers\Api;

use App\Filters\SaleFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaleRequest;
use App\Http\Resources\SalesCollection;
use App\Models\Sale;
use Illuminate\Support\Facades\Http;

class SaleController extends Controller
{
    public function list(SaleRequest $request): SalesCollection
    {
        ini_set('max_execution_time', 240);
        $key = 'E6kUTYrYwZq2tN4QEtyzsbEBk3ie';

        $data = $request->validated();
        $dateFrom = $data['dateFrom'];
        $dateTo = $data['dateTo'];
        $page = $data['page'];
        $limit = $data['limit'];

        $response = Http::get("89.108.115.241:6969/api/sales",
            [
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
                'key' => $key,
                'page' => $page,
                'limit' => $limit
            ]);
        $result[] = json_decode($response->getBody()->getContents(), true);

        foreach ($result as $datum)
            foreach ($datum['data'] as $arrData)
            {
                $arrData[]=['account_id'=>1];
                Sale::firstOrCreate($arrData);
            }


        return new SalesCollection(SaleFilter::searchByRequest($request)
            ->paginate($request->limit ?? 500));
    }
}
