<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\Country;
use App\Models\City;

class GetCountriesCommand extends Command
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

        $city = new City();

        $apiData = json_decode($request->getBody(), true);

        foreach ($apiData as $key => $data) {
            $countryArray = [
                'name' => $data['name'],
                'code' => $data['alpha2Code']
            ];

            $countries = $country->create($countryArray);

            $cityArray = [
                'name' => $data['capital'],
                'country_id' => $countries->id
            ];

            $city->create($cityArray);
        }
    }
}
