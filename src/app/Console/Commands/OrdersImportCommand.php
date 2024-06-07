<?php

namespace App\Console\Commands;

use App\Models\Account;
use App\Models\Order;
use App\Models\Token;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class OrdersImportCommand extends Command
{
    protected $signature = 'import:orders {account_name}';

    protected $description = 'Import ORDERS database';

    public function handle()
    {
        $today = date("Y-m-d");
        $accountName = $this->argument('account_name');
        $accountId = Account::where('name', $accountName)->first()->id;
        $tokentypeId = Account::where('name', $accountName)->first()->tokentype_id;

        $token = Token::where('tokentype_id', $tokentypeId)->first()->token;

        $this->list($today, $token, $accountId);

        return 0;
    }

    public function list($today, $token, $accountId)
    {
        ini_set('max_execution_time', 240);
        $this->info('Database upload begins');
        $dateFrom = '2023-12-01';
        $dateTo = $today;
        $page = 1;
        $limit = 500;

        $response = Http::get("89.108.115.241:6969/api/orders",
            [
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
                'key' => $token,
                'page' => $page,
                'limit' => $limit
            ]);
        $result[] = json_decode($response->getBody()->getContents(), true);
        $status=$response->status();

        if($status==429)
            $this->info('Error 429. Try again later.');

        try {
            DB::beginTransaction();

                foreach ($result as $datum)
                    foreach ($datum['data'] as $arrData)
                    {
                        $arrData['account_id'] = $accountId;
                        Order::firstOrCreate($arrData);
                    }

                $this->info('Database Orders uploaded');
            DB::commit();
        }
        catch (\Exception $exception)
        {
            $this->info('Something gone wrong, retry later');
            return $exception->getMessage();
        }
    }
}
