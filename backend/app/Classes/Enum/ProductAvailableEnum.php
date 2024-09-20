<?php
declare(strict_types=1);
namespace App\Classes\Enum;

use LeMaX10\Enums\Enum;

/**
 * Class ProductAvailableEnum
 * @package App\Classes\Enum
 *
 *
 * @method static $this IS_AVAILABLE()
 * @method static $this NOT_AVAILABLE()
 * @method static $this ORDER()
 */
final class ProductAvailableEnum extends Enum
{
    private const IS_AVAILABLE = 'is_available';
    private const NOT_AVAILABLE = 'not_available';
    private const ORDER = 'order';
}
