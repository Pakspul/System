<?php

namespace System;

final class DateTimeEx
{
    const ISO8601_DATE = 'Y-m-d';
    const ISO8601_DATETIME = 'Y-m-d\TH:i:sO';

    public static function toUtc(\DateTime $dt, string $format): string
    {
        $dt->setTimezone(new \DateTimeZone("UTC"));
        return $dt->format($format);
    }

    public static function parse(string $string, string $format, DateTimeZoneEx $timezone = null): \DateTime
    {
        $result = \DateTime::createFromFormat($format, $string);
        if (!$result) {
            throw new FormatException("does not contain a valid string representation of a date and time.");
        }

        if ($timezone !== null) {
            $result->setTimezone(new \DateTimeZone($timezone->getValue()));
        }

        return $result;
    }
}
