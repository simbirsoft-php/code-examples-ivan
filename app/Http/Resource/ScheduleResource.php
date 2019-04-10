<?php

namespace App\Http\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    private $dayMap = [
        1 => 'monday',
        2 => 'tuesday',
        3 => 'wednesday',
        4 => 'thursday',
        5 => 'friday',
        6 => 'saturday',
        7 => 'sunday',
    ];

    public function toArray($request)
    {

        $result = [
            'special' => [],
        ];

        foreach ($this->all() as $item) {
            if ($item['day'] === null && $item['date'] !== null) {
                $result['special'][$item['date']] = [
                    'open_from' => $item['open_from'],
                    'open_till' => $item['open_till'],
                    'lunch_start' => $item['lunch_start'],
                    'lunch_end' => $item['lunch_end'],
                    'is_closed' => (bool)$item['is_closed'],
                ];

                continue;
            }

            $result[$this->dayMap[$item['day']]] = [
                'open_from' => $item['open_from'],
                'open_till' => $item['open_till'],
                'lunch_start' => $item['lunch_start'],
                'lunch_end' => $item['lunch_end'],
                'is_closed' => (bool)$item['is_closed'],
            ];
        }

        return $result;
    }
}
