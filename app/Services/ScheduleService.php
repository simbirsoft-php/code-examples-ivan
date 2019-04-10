<?php


namespace App\Services;


use App\Dto\ScheduleDto;
use App\Models\Station;
use App\Models\StationSchedule;
use Illuminate\Support\Facades\Auth;
use App\Contracts\ScheduleService as ScheduleServiceContracts;

class ScheduleService implements ScheduleServiceContracts
{
    /**
     * @param ScheduleDto[] $scheduleItems
     */
    public function import(array $scheduleItems): void
    {
        /** @var Station $authUserStation */
        $authUserStation = Auth::user()->station;
        $authUserStation->schedules()->delete();

        /** @var ScheduleDto $scheduleItem */
        foreach ($scheduleItems as $scheduleItem) {
            $itemData = $scheduleItem->toArray();
            $itemData['station_id'] = $authUserStation->id;
            $schedule = new StationSchedule();
            $schedule->create($itemData);
        }
    }
}
