<?php

namespace Tests\Feature;

use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class PeopleListTest extends TestCase
{
    /** @test */
    public function an_authenticated_user_can_search_people_list()
    {
        $user = factory('App\Models\User')->create();

        $this->actingAs($user, 'api');

        $data = [
            'count' => 10,
            'data_format' => "JSON"
        ];

        $response = $this->json('POST', '/api/people.list', $data);

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function expect_unprocessable_entity_if_data_format_is_not_xml_or_json()
    {
        $user = factory('App\Models\User')->create();

        $this->actingAs($user, 'api');

        $data = [
            'count' => 10,
            'data_format' => "DE"
        ];

        $response = $this->json('POST', '/api/people.list', $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function xml_view_is_returned_if_user_requested_xml_data()
    {
        $user = factory('App\Models\User')->create();

        $this->actingAs($user, 'api');

        $data = [
            'count' => 1,
            'data_format' => "XML"
        ];

        $response = $this->json('POST', '/api/people.list', $data);

        $response->assertViewIs('XML.people.list');

        $response->assertStatus(Response::HTTP_OK);
    }
}
