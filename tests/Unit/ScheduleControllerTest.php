<?php

namespace Tests\Unit;

use App\Models\Station;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ScheduleControllerTest extends TestCase
{

    public function testImport(): void
    {
        $station = factory(Station::class)->create();
        $headers = [
            'Authorization' => 'Basic ' . base64_encode("{$station['user']['email']}:{$station['user']['api_token']}"),
        ];
        $uploadedFile = base_path('tests/data/test.csv');

        $response = $this->postJson(route('schedules.import'), [
            'file' => new UploadedFile($uploadedFile, 'test.csv', null, null, null, true),
        ], $headers);

        $response->assertStatus(201);

        $this->get(route('stations.show', $station['id']), $headers)
            ->assertStatus(200)
            ->assertJsonStructure([
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

    public function testImportFailed(): void
    {
        $station = factory(Station::class)->create();
        $headers = [
            'Authorization' => 'Basic ' . base64_encode("{$station['user']['email']}:{$station['user']['api_token']}"),
        ];
        $uploadedFile = base_path('tests/data/test.txt');

        $response = $this->postJson(route('schedules.import'), [
            'file' => new UploadedFile($uploadedFile, 'test.txt', null, null, null, true),
        ], $headers);

        $response->assertStatus(400);
    }
}
