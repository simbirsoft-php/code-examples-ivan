<?php

namespace App\Services;

use App\Contracts\ScheduleDataProvider;
use App\Dto\ScheduleDto;
use App\Exceptions\DataProviderException;
use App\Models\Station;
use App\Models\StationSchedule;
use Illuminate\Support\Facades\Auth;

class CsvScheduleDataProviderService implements ScheduleDataProvider
{
    /**
     * @inheritDoc
     */
    public function getData(string $path): array
    {
        $this->validateFile($path);

        $data = [];
        $h = fopen($path, 'r');
        while (($row = fgetcsv($h, 1000, ';')) !== false) {
            $data[] = $this->parseRow($row);
        }
        fclose($h);

        return $data;
    }

    /**
     * @param array $row
     *
     * @return ScheduleDto
     */
    private function parseRow(array $row): ScheduleDto
    {
        return new ScheduleDto(
            !empty($row[0]) ? $row[0] : null,
            !empty($row[1]) ? $row[1] : null,
            !empty($row[2]) ? $row[2] : null,
            !empty($row[3]) ? $row[2] : null,
            !empty($row[4]) ? $row[2] : null,
            !empty($row[5]) ? $row[2] : null,
            !empty($row[6]) ? $row[2] : false
        );
    }

    /**
     * Валидация файла
     *
     * @param string $fileName
     *
     * @return bool
     * @throws DataProviderException
     */
    protected function validateFile(string $fileName): void
    {
        if (!file_exists($fileName)) {
            throw new DataProviderException('Файл не существует', 400);
        }
        if (pathinfo ($fileName, PATHINFO_EXTENSION) !== 'csv') {
            throw new DataProviderException('Файл не поддерживается', 400);
        }
    }
}
