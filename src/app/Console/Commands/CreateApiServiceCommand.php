<?php

namespace App\Console\Commands;

use App\Models\Apiservice;
use App\Models\Tokentype;
use Illuminate\Console\Command;

class CreateApiServiceCommand extends Command
{
    protected $signature = 'create:apiservice {name} {tokentype_name}';
    protected $description = 'Creates new apiservice {name} {tokentype_name}';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $serviceName = $this->argument('name');
        $tokenType = $this->argument('tokentype_name');
        $tokenTypeId = Tokentype::where('name', $tokenType)->first()->id;

        Apiservice::firstOrCreate([
           'name' => $serviceName,
           'tokentype_id'=> $tokenTypeId
        ]);
        $this->info("Created new token type {$tokenType}");
        return 0;
    }
}
