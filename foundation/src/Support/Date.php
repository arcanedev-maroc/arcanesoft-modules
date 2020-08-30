<?php

namespace Arcanesoft\Foundation\Support;

/**
 * Class     Date
 *
 * @package  Arcanesoft\Foundation\Support
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Date
{
    /**
     * @param  string|int  $year
     *
     * @return string
     */
    public static function since($year): string
    {
        $current = now();

        return $current->year > (int) $year
            ? $year.' - '.$current->year
            : $year;
    }
}
