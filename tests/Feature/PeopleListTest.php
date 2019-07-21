<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Enums\DataFormat;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PeopleListTest extends TestCase
{

    /** @test */
    public function an_authenticated_user_can_search_people_list()
    {
        $user = factory('App\Models\User')->create();

        $data = [
            'count' => 10,
            'data_format' => "JSON"
        ];

        $this->actingAs($user, 'api');

        $response = $this->json('POST', '/api/people/list', $data);

        $response->assertStatus(200);
    }
}
