<?php

namespace App\Services;

use App\Classes\Contracts\Services\UserService as UserServiceContract;
use App\Classes\Dto\FilterDto;
use App\Classes\Dto\OffsetDto;
use App\Classes\Dto\UserDto;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Filesystem\Filesystem;

/**
 * Class UserService
 * @package UserFeed\Services
 *
 */
class UserService implements UserServiceContract
{

    /**
     * @inheritDoc
     */
    public function getAllUsers(OffsetDto $obOffsetDto, FilterDto $obFilterDto): ?LengthAwarePaginator
    {
        return User::active()->paginate($obOffsetDto->limit);
    }

    /**
     * @param int $userId
     * @return User|null
     */
    public function getUser(int $userId): ?User
    {
        return User::active()->findOrFail($userId);
    }

    /**
     * @inheritDoc
     */
    public function storeUser(UserDto $userDto): ?User
    {
        DB::beginTransaction();

        $avatar = '';

        try {

            $avatar = $this->storeUserAvatar($userDto);

            $user = new User();
            $user->name = $userDto->name;
            $user->username = $userDto->username;
            $user->verified = $userDto->verified;
            $user->active = $userDto->active;
            if($avatar){
                $user->avatar = $avatar;
            }
            $user->phone = $userDto->phone;
            $user->email = $userDto->email;
            $user->address = $userDto->address;
            $user->city = $userDto->city;
            $user->password = bcrypt('123456789');
            $user->save();

            DB::commit();

            return $user;

        } catch (\Exception $e) {
            DB::rollback();
            unlink(storage_path('app/' . $avatar));
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function updateUser(UserDto $userDto, User $user): ?User
    {
        DB::beginTransaction();

        $avatar = '';

        try {
            $avatar = $this->storeUserAvatar($userDto, true);

            $user->name = $userDto->name;
            $user->username = $userDto->username;
            $user->verified = $userDto->verified;
            $user->active = $userDto->active;
            if($avatar){
                $user->avatar = $avatar;
            }
            $user->phone = $userDto->phone;
            $user->email = $userDto->email;
            $user->address = $userDto->address;
            $user->city = $userDto->city;
            $user->password = bcrypt('123456789');
            $user->save();

            DB::commit();

            return $user;

        } catch (\Exception $e) {
            DB::rollback();
            unlink(storage_path('app/' . $avatar));
        }

        return null;
    }

    /**
     * @param UserDto $userDto
     * @param bool $update
     * @return string|null
     */
    private function storeUserAvatar(UserDto $userDto, bool $update = false): ?string
    {
        if (!$userDto->avatar) {
            return null;
        }

        //todo: delete old image
        if ($update) {
            $this->deleteOldAvatar($userDto->username);
        }

        $file = $userDto->avatar;

        $image = Image::make($file);

        $image->resize(570, 326, function ($constraint) {
            $constraint->aspectRatio();
        });

        $thumbnail_image_name = $userDto->username . '_' . time() . '.' . $file->getClientOriginalExtension();

        $image->save(storage_path('app/public/thumbnails/' . $thumbnail_image_name));

        $saved_image_uri = $image->dirname . '/' . $image->basename;

        $path = Storage::disk('public')->putFileAs('avatars/' . $userDto->username, new File($saved_image_uri), $thumbnail_image_name);

        $image->destroy();
        unlink($saved_image_uri);

        return $path;

    }

    /**
     * @param string $username
     * @return void
     */
    public function deleteOldAvatar(string $username): void
    {
        $file = new Filesystem;
        $file->cleanDirectory(storage_path('app/public/avatars/'.$username));
    }

}
