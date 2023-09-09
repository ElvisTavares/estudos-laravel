<?php

namespace App\Console\Commands;

use App\Models\Planet;
use Illuminate\Console\Command;

class InsertDataPlanet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:insert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'insert data into the database';

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->ask('Insira o nome do planeta: ');

        $planet = new Planet();
        $planet->name = $name;
        
        $planet->save();

        $this->info("Nome salvo");
    }
}
