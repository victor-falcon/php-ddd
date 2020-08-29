<?php

declare(strict_types=1);

namespace Cal\Shared\Domain;

use Carbon\Carbon;
use DateTimeInterface;

final class Utils
{
    public static function toSnakeCase(string $text): string
    {
        return ctype_lower($text) ?
            $text :
            strtolower(preg_replace('/([^A-Z\s])([A-Z])/', '$1_$2', $text));
    }

    public static function dateToString(DateTimeInterface $date): string
    {
        return $date->format(DateTimeInterface::ATOM);
    }

    public static function stringToDate(string $date): Carbon
    {
        return Carbon::createFromFormat(DateTimeInterface::ATOM, $date);
    }
}
