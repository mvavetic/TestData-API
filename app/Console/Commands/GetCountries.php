<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\Country;

class GetCountries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:countries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all countries from an API and save the response to database.';

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

        $request = $client->request('GET', 'https://restcountries.eu/rest/v2/all');

        $country = new Country();

        $countriesData = json_decode($request->getBody(), true);

        foreach ($countriesData as $key => $countryData) {
            $data = [
                'name' => $countryData['name'],
                'code' => $countryData['alpha2Code']
            ];

            $country->create($data);
        }
    }
}
