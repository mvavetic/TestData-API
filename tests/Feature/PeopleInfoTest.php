<?php

namespace Tests\Feature;

use App\Repositories\PeopleRepository;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class PeopleInfoTest extends TestCase
{
    /** @test */
    public function an_authenticated_user_can_search_for_a_person()
    {
        $user = factory('App\Models\User')->create();

        $this->actingAs($user, 'api');

        $data = [
            'id' => 1,
            'data_format' => "JSON"
        ];

        $response = $this->json('POST', '/api/people.info', $data);

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function expect_not_found_error_if_person_is_not_found()
    {
        $user = factory('App\Models\User')->create();

        $this->actingAs($user, 'api');

        $data = [
            'id' => 999,
            'data_format' => "JSON"
        ];

        $peopleRepository = new PeopleRepository();

        $person = $peopleRepository->findById($data['id']);

        $response = $this->json('POST', '/api/people.info', $data);

        $this->assertNull($person);

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /** @test */
    public function expect_bad_request_if_no_id_provided()
    {
        $user = factory('App\Models\User')->create();

        $this->actingAs($user, 'api');

        $data = [
            'data_format' => "JSON"
        ];

        $response = $this->json('POST', '/api/person.info', $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
