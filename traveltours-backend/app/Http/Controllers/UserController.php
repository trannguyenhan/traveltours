<?php

namespace App\Http\Controllers;

use App\Http\Repositories\UserRepository;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Base\IdRequest;
use App\Http\Requests\Base\IdsRequest;
use App\Http\Requests\User\AssignRequest;
use App\Http\Requests\User\UpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UserController extends BaseController
{
    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    /**
     * Assign new account for user
     * @param AssignRequest $request
     * @return JsonResponse
     */
    public function assignAccount(AssignRequest $request): JsonResponse
    {
        return $this->repository->doAssign($request);
    }

    /**
     * @param ChangePasswordRequest $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $user = \App\Models\User::query()->find($request->input('id'));
        $password = $request->input('password');
        $newPassword = $request->input('new_password');

        return $this->repository->doChangePassword($user, $password, $newPassword);
    }

    /**
     * Admin can lock account of anyone including other admin
     * @param IdRequest $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function lockUser(IdRequest $request): JsonResponse
    {
        $id = $request->input('id');
        return $this->repository->doLock($id);
    }

    /**
     * @param IdRequest $request
     * @return JsonResponse
     */
    public function unlockUser(IdRequest $request): JsonResponse
    {
        $id = $request->input('id');
        return $this->repository->doUnlock($id);
    }

    /**
     * Soft delete account
     * @param IdRequest $request
     * @return mixed
     */
    public function delete(IdRequest $request){
        return $this->deleteTemplate($request);
    }

    /**
     * @param IdsRequest $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function massDelete(IdsRequest $request){
        $ids = $request->input('ids');

        return $this->repository->doMultiDelete($ids);
    }

    /**
     * @param UpdateRequest $request
     * @return JsonResponse
     */
    public function update(UpdateRequest $request){
        $name = $request->input('name');
        $id = $request->input('id');
        $role = $request->input('roles');
        $password = $request->input('password');

        return $this->repository->doUpdate(['name' => $name, 'id' => $id, 'roles' => $role, 'password' => bcrypt($password)]);
    }

    /**
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        return \App\Helper::successResponse(auth()->user()->load('roles:id,name'));
    }
}
