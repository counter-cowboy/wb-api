<?php

namespace App\Console\Commands;

use App\Models\Company;
use Illuminate\Console\Command;

class CreateCompanyCommand extends Command
{

    protected $signature = 'create:company {name}';

    protected $description = 'Creates new company {name}';


    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
       Company::firstOrCreate(['name'=> $this->argument('name')]);
       $this->info("Company {$this->argument('name')} created");
       return 0;
    }
}
