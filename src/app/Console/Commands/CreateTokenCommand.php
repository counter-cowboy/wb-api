<?php

namespace App\Console\Commands;

use App\Models\Account;
use App\Models\Apiservice;
use App\Models\Token;
use App\Models\Tokentype;
use Illuminate\Console\Command;

class CreateTokenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:token {apiservice_name} {tokentype_name} {token}';

    protected $description = 'Create token {apiservice_name} {tokentype_name} {token}';

    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $apiServiceId = Apiservice::where('name', $this->argument('apiservice_name'))->first()->id;
        $tokenTypeId = Tokentype::where('name', $this->argument('tokentype_name'))->first()->id;
        $token = $this->argument('token');

        if (!$apiServiceId || !$tokenTypeId) {
            $this->error('Account or token not found');
            return 1;
        }
        Token::firstOrCreate([
            'token'=> $token,
            'tokentype_id' => $tokenTypeId,
            'apiservice_id'=>$apiServiceId
        ]);
        $this->info("Token {$this->argument('tokentype_name')} created successfully");
        return 0;
    }
}
