<?php

namespace App\Console\Commands;

use App\Models\Account;
use App\Models\Company;
use App\Models\Tokentype;
use Illuminate\Console\Command;

class CreateAccountCommand extends Command
{
    protected $signature = 'create:account {name} {company_name} {tokentype_name}';
    protected $description = 'Create account ';


    public function handle()
    {
        $tokentypeName=$this->argument('tokentype_name');
        $tokentypeId=Tokentype::where('name', $tokentypeName)->first()->id;
        $companyName = $this->argument('company_name');
        $compId = Company::where('name',  $companyName)->first()->id;

        Account::firstOrCreate([
            'name' => $this->argument('name'),
            'company_id' => $compId,
            'tokentype_id'=>$tokentypeId
        ]);
        $this->info("Account {$this->argument('name')} created");
        return 0;
    }
}
