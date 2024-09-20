<?php namespace App\Classes\Dto;


/**
 * Class OffsetDto
 * @package App\Classes\Dto
 *
 */
class OffsetDto extends DataTransferObject
{
    /**
     * @var int
     */
    public int $offset = 0;

    /**
     * @var int|null
     */
    public ?int $limit  = 10;
}
