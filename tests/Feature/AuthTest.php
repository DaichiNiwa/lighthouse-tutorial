<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class AuthTest extends TestCase
{
//    use RefreshDatabase;

    public function testAuthTest()
    {
        $user = User::factory()->create();
        $this->assertGuest();

        $this->getJson(route("user"))->assertStatus(Response::HTTP_UNAUTHORIZED);
        $this->graphQL('
        {
          user(id: 1) {
            id
            name
            age
          }
        }')->assertStatus(Response::HTTP_UNAUTHORIZED);

        // ここでログイン
        $this->actingAs($user)->postJson(route("login"));
        $this->assertAuthenticated();

        $this->getJson(route("user"))->assertOk();
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
