<?php


namespace App\Contracts;


use App\Dto\ScheduleDto;

interface ScheduleService
{
    /**
     * @param ScheduleDto[] $scheduleItems
     */
    public function import(array $scheduleItems): void;
}
