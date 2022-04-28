<?php

declare(strict_types=1);

namespace Sts\Suss\Service;

use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;

class Infer
{
    public static function isValid(string $dateTime): bool
    {
        if ($dateTime === '') {
            return false;
        }
        try {
            Carbon::parse($dateTime);
        } catch (InvalidFormatException $e) {
            return false;
        }
        return true;
    }

    public static function suss(string $dateTime): string
    {
        $format = '';
        if (self::isValid($dateTime)) {
        }
        return $format;
    }
}
