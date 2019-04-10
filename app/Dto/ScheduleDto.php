<?php


namespace App\Dto;


class ScheduleDto
{
    private $day;
    private $date;
    private $open_from;
    private $open_till;
    private $lunch_start;
    private $lunch_end;
    private $is_closed;

    public function __construct($day, $date, $open_from, $open_till, $lunch_start, $lunch_end, $is_closed)
    {
        $this->day = $day;
        $this->date = $date;
        $this->open_from = $open_from;
        $this->open_till = $open_till;
        $this->lunch_start = $lunch_start;
        $this->lunch_end = $lunch_end;
        $this->is_closed = $is_closed;
    }

    /**
     * @return mixed
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getOpenFrom()
    {
        return $this->open_from;
    }

    /**
     * @return mixed
     */
    public function getOpenTill()
    {
        return $this->open_till;
    }

    /**
     * @return mixed
     */
    public function getLunchStart()
    {
        return $this->lunch_start;
    }

    /**
     * @return mixed
     */
    public function getLunchEnd()
    {
        return $this->lunch_end;
    }

    /**
     * @return mixed
     */
    public function getIsClosed()
    {
        return $this->is_closed;
    }

    public function toArray(): array
    {
        return [
            'day' => $this->day,
            'date' => $this->date,
            'open_from' => $this->open_from,
            'open_till' => $this->open_till,
            'lunch_start' => $this->lunch_start,
            'lunch_end' => $this->lunch_end,
            'is_closed' => $this->is_closed === true,
        ];
    }
}
