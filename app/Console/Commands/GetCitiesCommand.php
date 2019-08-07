<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\City;

class GetCitiesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:cities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get cities from an API and save the response to database.';

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
        $client = new Client();

        $request = $client->request
        ('GET', 'https://wft-geo-db.p.mashape.com/v1/geo/cities?minPopulation=250000');

        $city = new City();

        $citiesData = json_decode($request->getBody(), true);

        foreach ($citiesData as $key => $cityData) {
            $data = [
                'name' => $cityData['name'],
                'code' => $cityData['alpha2Code']
            ];

            $city->create($data);
        }
    }
}
