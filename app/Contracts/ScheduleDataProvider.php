<?php

namespace App\Contracts;

use App\Dto\ScheduleDto;

interface ScheduleDataProvider
{
    /**
     * Метод получения данных из любого датапровайдера
     *
     * @param string $path
     *
     * @return ScheduleDto[]
     */
    public function getData(string $path): array;
}
