<?php

namespace App\Console\Commands;

use App\Models\Account;
use App\Models\Stock;
use App\Models\Token;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class StocksImportCommand extends Command
{
    protected $signature = 'import:stocks {account_name}';
    protected $description = 'Import STOCKS database';

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

        $dateFrom = $today;
        $page = 1;
        $limit = 100;

        $response = Http::get("89.108.115.241:6969/api/stocks",
            [
                'dateFrom' => $dateFrom,
                'key' => $token,
                'page' => $page,
                'limit' => $limit
            ]);
        $result[] = json_decode($response->getBody()->getContents(), true);


        foreach ($result as $datum)
            foreach ($datum['data'] as $arrData)
            {
                $arrData['account_id'] = $accountId;
                Stock::firstOrCreate($arrData);
            }

        $this->info('Database Sales uploaded');

    }
}
