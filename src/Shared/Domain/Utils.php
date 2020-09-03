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

    public static function jsonEncode(array $data): string
    {
        return json_encode($data);
    }

    public static function jsonDecode(string $data): array
    {
        return json_decode($data, true);
    }

    public static function dateToString(DateTimeInterface $date): string
    {
        return $date->format(DateTimeInterface::ATOM);
    }

    public static function dateToDatabaseString(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

    public static function stringToDate(string $date): Carbon
    {
        return Carbon::createFromFormat(DateTimeInterface::ATOM, $date);
    }
}
