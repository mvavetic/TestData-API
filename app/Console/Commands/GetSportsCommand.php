<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Sport;

class GetSportsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:sports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get list of sports and save to database.';

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
        $sport = new Sport();

        $sportsNames =
            ['Football', 'Basketball', 'Handball', 'Volleyball',
            'Cricket', 'Baseball', 'American football', 'Bowling', 'Gymnastics',
            'Softball', 'Rugby', 'Golf', 'Table tennis', 'Tennis', 'Ice hockey',
            'Field hockey', 'Boxing', 'Kickboxing', 'Karate', 'Bodybuilding', 'Swimming',
            'Wrestling'
        ];


        foreach ($sportsNames as $key => $data) {
            $sportData = [
                'name' => $data,
            ];

            $sport->create($sportData);
        }
    }
}
