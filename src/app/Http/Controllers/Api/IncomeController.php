<?php

namespace App\Http\Controllers\Api;

use App\Filters\IncomeFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\IncomeRequest;
use App\Http\Resources\IncomesCollection;
use App\Models\Income;
use App\Models\Sale;
use Illuminate\Support\Facades\Http;

class IncomeController extends Controller
{
    public function list(IncomeRequest $request): IncomesCollection
    {
        ini_set('max_execution_time', 240);
        $key = 'E6kUTYrYwZq2tN4QEtyzsbEBk3ie';

        $data = $request->validated();
        $dateFrom = $data['dateFrom'];
        $dateTo = $data['dateTo'];
        $page = $data['page'];
        $limit = $data['limit'];

        $response = Http::get("89.108.115.241:6969/api/incomes",
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
                Income::firstOrCreate($arrData);
            }

        return new IncomesCollection(IncomeFilter::searchByRequest($request)
            ->paginate($limit ?? 500));
    }
}
