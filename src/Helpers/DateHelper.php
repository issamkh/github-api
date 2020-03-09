<?php

namespace App\Helpers;


/**
 * Class DateHelper
 * @package App\Helpers
 */
class DateHelper
{
    /**
     * get date of 30 last days from actual date
     * @return string
     */
    public static function getDate(): string{

        return  date('Y-m-d', strtotime("-30 days"));

    }
}