<?php

namespace App\Classes\Dto;

/**
 * Class OrderDto
 * @package App\Classes\Dto
 *
 */
class OrderDto extends DataTransferObject
{
    /**
     * @var string
     */
    public string $name;

    /**
     * @var string
     */
    public string $phone;

    /**
     * @var string
     */
    public string $address;

    /**
     * @var array
     */
    public array $orders;

}
