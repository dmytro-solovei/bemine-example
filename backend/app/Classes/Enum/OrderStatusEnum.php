<?php
declare(strict_types=1);

namespace App\Classes\Enum;

use LeMaX10\Enums\Enum;

/**
 * Class OrderStatusEnum
 * @package App\Classes\Enum
 *
 *
 * @method static $this NEW()
 * @method static $this ON_WAY()
 * @method static $this DONE()
 * @method static $this OTHER()
 */
final class OrderStatusEnum extends Enum
{
    private const NEW = 'new';
    private const ON_WAY = 'on_way';
    private const DONE = 'done';
    private const OTHER = 'other';

}
