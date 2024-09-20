<?php

namespace App\Classes\Dto\Admin;

use App\Classes\Dto\DataTransferObject;

/**
 * Class ColorDto
 * @package App\Classes\Dto
 *
 */
class ColorDto extends DataTransferObject
{
    /**
     * @var string
     */
    public string $name;

    /**
     * @var string
     */
    public string $code;

    /**
     * @var string
     */
    public string $description;

}
