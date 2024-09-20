<?php
declare(strict_types=1);
namespace App\Classes\Enum;

use LeMaX10\Enums\Enum;

/**
 * Class ProductGallerySizeEnum
 * @package App\Classes\Enum
 *
 *
 * @method static $this SMALL()
 * @method static $this MEDIUM()
 * @method static $this BIG()
 */
final class ProductGallerySizeEnum extends Enum
{
    private const SMALL = 'small';
    private const MEDIUM = 'medium';
    private const BIG = 'big';

}
