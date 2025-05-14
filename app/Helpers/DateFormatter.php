<?php

namespace App\Helpers;

use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use DateTimeInterface;

class DateFormatter
{
    const FORMAT_DATABASE = 'Y-m-d';
    const FORMAT_INPUT = 'Y-m-d';
    const FORMAT_DISPLAY = 'D, j M Y';

    const FORMATS = [
        self::FORMAT_DATABASE,
        self::FORMAT_INPUT,
        self::FORMAT_DISPLAY,
    ];

    public static function format(DateTimeInterface|string $date, string $format = self::FORMAT_DATABASE): string
    {
        try {
            $carbonDate = $date instanceof DateTimeInterface ? Carbon::instance($date) : Carbon::parse($date);

            return $carbonDate->format($format);
        } catch (InvalidFormatException|\Exception $e) {
            return 'Invalid date';
        }
    }

    public static function toDatabase(string|DateTimeInterface $date): string
    {
        return self::format($date, self::FORMAT_DATABASE);
    }

    public static function toDisplay(string|DateTimeInterface $date): string
    {
        return self::format($date, self::FORMAT_DISPLAY);
    }

    public static function toInput(string|DateTimeInterface $date): string
    {
        return self::format($date, self::FORMAT_INPUT);
    }
}
