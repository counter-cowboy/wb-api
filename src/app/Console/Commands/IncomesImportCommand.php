<?php
namespace App\Console\Commands;
use App\Models\Account;
use App\Models\Income;
use App\Models\Token;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use phpDocumentor\Reflection\Types\Integer;

class IncomesImportCommand extends Command
{
    protected $signature = 'import:incomes {account_name}';
    protected $description = 'Imports INCOMES database';

    public function __construct()
    {
        parent::__construct();
    }
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
        $dateFrom = '2024-05-01';
        $dateTo = $today;
        $page = 1;
        $limit = 5;

        $response = Http::get("89.108.115.241:6969/api/incomes",
            [
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
                'key' => $token,
                'page' => $page,
                'limit' => $limit
            ]);

        $status=$response->status();

        if ($status==429)
            $this->info('Error 429. Try again later');

        $result[] = json_decode($response->getBody()->getContents(), true);
//        dd($result);

        try
        {
            DB::beginTransaction();

            foreach ($result as $datum)
                foreach ($datum['data'] as $arrData)
                {
                    $arrData['account_id'] = $accountId;
                    Income::firstOrCreate($arrData);
                }

            $this->info('Database Incomes uploaded');

            DB::commit();
        }
        catch (\Exception $exception)
        {
            $this->info('Something gone wrong, retry later');
            return $exception->getMessage();
        }
    }
}
