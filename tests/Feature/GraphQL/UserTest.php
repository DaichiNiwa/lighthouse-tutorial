<?php

namespace Tests\Feature\GraphQL;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Nuwave\Lighthouse\Testing\UsesTestSchema;
use Nuwave\Lighthouse\Exceptions\RendersErrorsExtensions;


class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testユーザーが取得できること(): void
    {
        $user = User::factory()->create();

        $this->graphQL('
        {
            user(id: 1){
                id
                name
                age
            }
        }
        ')->assertJson([
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'age' => $user->age,
                ]
            ]
        ]);
    }

    public function testユーザーが年齢の降順になっていること(): void
    {
        User::factory()->create(['age' => 100]);
        User::factory()->create(['age' => 0]);
        User::factory()->create(['age' => 50]);
        User::factory()->create(['age' => 26]);
        User::factory()->create(['age' => 18]);

        $response = $this->graphQL('
        {
            users {
                data {
                    id
                    name
                    age
                }
            }
        }
        ');

        $ages = $response->json("data.users.data.*.age");

        $this->assertSame(
            [
                100,
                50,
                26,
                18,
                0,
            ],
            $ages
        );
    }

    public function testユーザーが年齢の降順になっていること（別の方法）(): void
    {
        User::factory()->create(['age' => 4]);
        User::factory()->create(['age' => 2]);
        User::factory()->create(['age' => 3]);
        User::factory()->create(['age' => 1]);
        User::factory()->create(['age' => 0]);

        $this->graphQL('
        {
            users {
                data {
                    id
                    name
                    age
                }
            }
        }
        ')->assertJson([
            'data' => [
                'users' => [
                    'data' => [
                        0 => [
                            'age' => 4,
                        ],
                        1 => [
                            'age' => 3,
                        ],
                        2 => [
                            'age' => 2,
                        ],
                        3 => [
                            'age' => 1,
                        ],
                        4 => [
                            'age' => 0,
                        ],
                    ]
                ]
            ]
        ]);
    }
}
