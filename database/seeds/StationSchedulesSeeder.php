<?php

use App\Models\StationSchedule;
use Illuminate\Database\Seeder;

class StationSchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StationSchedule::truncate();

        for ($i = 1; $i <= 10; $i++) {
            for($j = 1; $j <=7; $j++) {
                (new StationSchedule())->create([
                    'station_id' => $i,
                    'day' => $j,
                    'date' => null,
                    'open_from' => '09:00:00',
                    'open_till' => '19:00:00',
                    'lunch_start' => '13:00:00',
                    'lunch_end' => '14:00:00',
                    'is_closed' => false,
                ]);

                (new StationSchedule())->create([
                    'station_id' => $i,
                    'day' => null,
                    'date' => '2019-01-01',
                    'open_from' => null,
                    'open_till' => null,
                    'lunch_start' => null,
                    'lunch_end' => null,
                    'is_closed' => true,
                ]);
            }
        }
    }
}
