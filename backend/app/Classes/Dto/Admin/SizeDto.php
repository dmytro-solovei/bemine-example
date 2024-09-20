<?php

namespace App\Classes\Dto\Admin;

use App\Classes\Dto\DataTransferObject;

/**
 * Class SizeDto
 * @package App\Classes\Dto
 *
 */
class SizeDto extends DataTransferObject
{
    /**
     * @var string
     */
    public string $name;

    /**
     * @var string
     */
    public string $description;

    /**
     * @var array
     */
    public array $categories;

}
