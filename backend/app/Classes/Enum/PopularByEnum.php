<?php
declare(strict_types=1);
namespace App\Classes\Enum;

use LeMaX10\Enums\Enum;

/**
 * Class PopularByEnum
 * @package App\Classes\Enum
 *
 *
 * @method static $this BEST_SELLER()
 * @method static $this NEW_ARRIVAL()
 * @method static $this TOP_RATED()
 */
final class PopularByEnum extends Enum
{
    private const BEST_SELLER = 'best_seller';
    private const NEW_ARRIVAL = 'new_arrival';
    private const TOP_RATED = 'top_rated';

}
