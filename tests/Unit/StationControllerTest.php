<?php

namespace Tests\Unit;

use App\Models\Station;
use App\Models\User;
use Tests\TestCase;

class StationControllerTest extends TestCase
{

    public function testShow(): void
    {
        $station = factory(Station::class)->create();

        $headers = [
            'Authorization' => 'Basic ' . base64_encode("{$station['user']['email']}:{$station['user']['api_token']}"),
        ];

        $response = $this->json('GET',
            route('stations.show', 5),
            [],
            $headers
        );
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'address',
                'description',
                'name',
                'schedules' => [
                    'special',
                    'monday',
                    'tuesday',
                    'wednesday',
                    'thursday',
                    'friday',
                    'saturday',
                    'sunday',
                ]
            ]
        ]);
    }

    public function testUpdate(): void
    {
        $station = factory(Station::class)->create();
        $headers = [
            'Authorization' => 'Basic ' . base64_encode("{$station['user']['email']}:{$station['user']['api_token']}"),
        ];

        $response = $this->json('PUT',
            route('stations.update', $station['id']),
            ['name' => 'test'],
            $headers
        );
        $response->assertStatus(200);
    }

    public function testDestroy(): void
    {
        $station = factory(Station::class)->create();
        $headers = [
            'Authorization' => 'Basic ' . base64_encode("{$station['user']['email']}:{$station['user']['api_token']}"),
        ];

        $response = $this->json('DELETE',
            route('stations.destroy', $station['id']),
            [],
            $headers
        );

        $response->assertStatus(204);
    }

    public function testStore(): void
    {
        $user = factory(User::class)->create();
        $data = [
            'name' => 'test name',
            'address' => 'test address',
            'description' => 'test description',
            'user_id' => $user['id']
        ];
        $headers = [
            'Authorization' => 'Basic ' . base64_encode("{$user['email']}:{$user['api_token']}"),
        ];
        $response = $this->json('POST',
            route('stations.store'),
            $data,
            $headers
        );
        $response->assertStatus(201);
    }

    public function testStoreFailed(): void
    {
        $user = factory(User::class)->create();
        $data = [
            'name' => '',
            'address' => 'test address',
            'description' => 'test description',
            'user_id' => $user['id']
        ];
        $headers = [
            'Authorization' => 'Basic ' . base64_encode("{$user['email']}:{$user['api_token']}"),
        ];
        $response = $this->json('POST',
            route('stations.store'),
            $data,
            $headers
        );
        $response->assertStatus(422);
    }

    public function testIndex(): void
    {
        $user = factory(User::class)->create();
        $headers = [
            'Authorization' => 'Basic ' . base64_encode("{$user['email']}:{$user['api_token']}"),
        ];
        $response = $this->json('GET', route('stations.index'), [], $headers);
        $response->assertStatus(200);
    }
}
