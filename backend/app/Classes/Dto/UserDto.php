<?php

namespace App\Classes\Dto;

use Illuminate\Http\UploadedFile;

/**
 * Class UserDto
 * @package App\Classes\Dto
 *
 */
class UserDto extends DataTransferObject
{
    /**
     * @var string
     */
    public string $name;

    /**
     * @var string
     */
    public string $email;

    /**
     * @var string
     */
    public string $username;

    /**
     * @var string
     */
    public string $address;

    /**
     * @var string
     */
    public string $city;

    /**
     * @var string
     */
    public string $phone;

    /**
     * @var bool
     */
    public bool $active;

    /**
     * @var bool
     */
    public bool $verified;

//    /**
//     * @var UploadedFile|null
//     */
    public $avatar = null;

}
