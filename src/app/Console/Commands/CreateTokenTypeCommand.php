<?php

namespace App\Console\Commands;

use App\Models\Tokentype;
use Illuminate\Console\Command;

class CreateTokenTypeCommand extends Command
{
    protected $signature = 'create:tokentype {name}';
    protected $description = 'Create new token type';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Tokentype::firstOrCreate(['name' => $this->argument('name')]);
        $this->info("Created new tokentype {$this->argument('name')}");
        return 0;
    }
}
