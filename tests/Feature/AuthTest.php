<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function testAuthTest()
    {
        $user = User::factory()->create();
        $this->assertGuest();

        $this->actingAs($user)->postJson(route("login"));
        $this->assertAuthenticated();

        $this->get(route("user"))->assertOk();

        $this->graphQL('
        {
          user(id: 1) {
            id
            name
            age
          }
        }')->assertOk();
    }
}
