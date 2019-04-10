<?php

use App\Models\Station;
use Illuminate\Database\Seeder;

class StationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            (new Station)->create([
                'id' => $i,
                'user_id' => $i,
                'name' => 'station_' . $i,
                'address' => 'address of stoa ' . $i,
                'description' => 'Description of stoa ' . $i,
            ]);
        }
    }
}
