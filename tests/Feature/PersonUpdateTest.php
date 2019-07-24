<?php

namespace Tests\Feature;

use App\Repositories\PeopleRepository;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\WithFaker;

class PersonUpdateTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function a_person_can_be_updated()
    {

        $user = factory('App\Models\User')->create();

        $this->actingAs($user, 'api');

        $array = [
            'id' => 15,
            'first_name' => $this->faker->firstName,
            'nickname' => $this->faker->name,
        ];

        $response = $this->json('PATCH', 'api/person.update', $array);

        $peopleRepository = new PeopleRepository();

        $update = $peopleRepository->update($array);


        $this->assertEquals($array['first_name'], $update->first_name);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment(['first_name' => $array['first_name'],
            ]);
    }
}
