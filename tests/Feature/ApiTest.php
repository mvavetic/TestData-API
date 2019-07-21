<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authenticated_user_can_search_people_list()
    {
        $user = factory('App\Models\User')->create();

        $this->actingAs($user, 'api');

        $response = $this->json('POST', '/api/people/list', ['count' => 10, 'data_format' => "JSON"]);

        $response->assertStatus(200);
    }
}
