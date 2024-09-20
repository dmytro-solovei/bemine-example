<?php
declare(strict_types=1);

namespace App\Classes\Helper;


/**
 * Class PhoneNumberHelper
 * @package App\Classes\Helper
 *
 *
 */
class PhoneNumberHelper
{

    private const ARMENIAN_CODE = '+374';

    /**
     * @param $number
     * @return string
     */
    public static function normalizeArmenianNumber($number): string
    {
        if (substr($number, 0, 1) == '0') {
            $number = substr($number, 1);
        }

        if (substr($number, 0, 3) == '374') {
            $number = substr($number, 3);
        }

        if (substr($number, 0, 4) == '+374') {
            $number = substr($number, 4);
        }

        return self::ARMENIAN_CODE . $number;
    }

}
