<?php
declare(strict_types=1);

namespace App\Classes\Contracts\Services;

use App\Classes\Dto\FilterDto;
use App\Classes\Dto\OffsetDto;
use App\Classes\Dto\UserDto;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface UserService
 * @package App\Classes\Contracts\Services
 *
 */
interface UserService
{
    /**
     * @param OffsetDto $obOffsetDto
     * @param FilterDto $obFilterDto
     * @return LengthAwarePaginator|null
     */
    public function getAllUsers(OffsetDto $obOffsetDto, FilterDto $obFilterDto): ?LengthAwarePaginator;

    /**
     * @param int $userId
     * @return User|null
     */
    public function getUser(int $userId): ?User;

    /**
     * @param UserDto $userDto
     * @return User|null
     */
    public function storeUser(UserDto $userDto): ?User;

    /**
     * @param UserDto $userDto
     * @param User $user
     * @return User|null
     */
    public function updateUser(UserDto $userDto, User $user): ?User;

}
