<?php namespace App\Classes\Dto;


/**
 * Class FilterDto
 * @package App\Classes\Dto
 *
 */
class FilterDto extends DataTransferObject
{
    /**
     * @var array
     * @depreacted see FilterRequest and $this->filter
     */
    public array $arFilter = [];

    /**
     * @var array
     */
    public array $filter = [];

    /**
     * @var string|null
     */
    public ?string $search = null;
}
