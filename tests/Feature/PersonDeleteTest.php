<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PersonDeleteTest extends TestCase
{
    /** @test */
    public function a_person_can_be_deleted()
    {
        $user = factory('App\Models\User')->create();

        $this->actingAs($user, 'api');

        $person = factory('App\Models\People')->create();

        $response = $this->json('DELETE', 'api/person.delete', ['id' => $person->id]);

        $this->assertDatabaseMissing('people',['id' => $person->id]);

        $response->assertStatus(200);
    }
}
