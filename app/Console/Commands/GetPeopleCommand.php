<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\People;

class GetPeopleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:people';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get dummy data of people and save to database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws
     */
    public function handle()
    {
        return factory('App\Models\People', 100)->create();
    }
}
