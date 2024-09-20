<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Classes\Contracts\Services\UserService;
use App\Classes\Dto\UserDto;
use App\Http\Requests\FilterRequest;
use App\Http\Requests\OffsetRequest;
use App\Http\Requests\Users\UserStoreRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;

/**
 * Class UserController
 * @package App\Controllers
 *
 */
class UserController extends Controller
{

    /**
     * @var UserService
     */
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param OffsetRequest $obOffsetRequest
     * @param FilterRequest $obFilterRequest
     * @return Application|Factory|View
     */
    public function index(OffsetRequest $obOffsetRequest, FilterRequest $obFilterRequest)
    {
        $obOffsetDto = $obOffsetRequest->getDto();

        $users = $this->userService->getAllUsers(
            $obOffsetDto,
            $obFilterRequest->getDto()
        );

        return view('admin.users.index', compact('users'));
    }

    /**
     * @param int $userId
     * @return UserResource
     */
    public function show(int $userId): UserResource
    {
        $user = $this->userService->getUser($userId);

        return new UserResource($user);
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
      return view('admin.users.create');
    }

    /**
     * @param UserStoreRequest $request
     * @return RedirectResponse
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $userDto = new UserDto([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
            'city' => $validated['city'],
            'active' => (bool)$validated['active'],
            'verified' => (bool)$validated['verified'],
            'avatar' => $validated['avatar'],
        ]);

        $user = $this->userService->storeUser($userDto);

        return redirect()->route('users.index');
    }

    /**
     * @param int $userId
     * @return Application|Factory|View
     */
    public function edit(int $userId): View
    {
        $user  = User::findOrFail($userId);

        return view('admin.users.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, int $userId)
    {
        $user = User::findOrFail($userId);

        $validated = $request->validated();

        $userDto = new UserDto([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
            'city' => $validated['city'],
            'active' => (bool)$validated['active'],
            'verified' => (bool)$validated['verified'],
            'avatar' => Arr::get($validated, 'avatar'),
        ]);

        $user = $this->userService->updateUser(
            $userDto,
            $user
        );

        return redirect()->route('users.index');
    }

}
