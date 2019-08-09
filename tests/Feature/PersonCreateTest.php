<?php

namespace Tests\Feature;

use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PersonCreateTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_person_can_be_created()
    {
        $user = factory('App\Models\User')->create();

        $this->actingAs($user, 'api');

        $array = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'nickname' => $this->faker->name,
            'birth_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
        ];

        $response = $this->json('POST', 'api/person.create', $array);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment(['first_name' => $array['first_name'],
            ]);
    }

    /** @test */
    public function expect_bad_request_if_empty_data_provided()
    {
        $user = factory('App\Models\User')->create();

        $this->actingAs($user, 'api');

        $array = [
            'nickname' => $this->faker->name,
            'birth_date' => $this->faker->date($format = 'Y-m-d'),
        ];

        $response = $this->json('POST', 'api/person.create', $array);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
