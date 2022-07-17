<?php

namespace App\Http\Repositories;

use App\Helper;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserRepository extends BaseRepository
{
    protected $_relationships = [
        'roles:id,name'
    ];

    public function getModel(): string
    {
        return User::class;
    }

    public function doAccept($id): JsonResponse
    {
        $model = $this->_model->query()->find($id);
        $model['status'] = User::ACTIVE;

        if($model->save()){
            $model->assignRole('editor');
            return Helper::successResponse($model);
        }

        return Helper::errorResponse();
    }

    public function doAssign($request): JsonResponse
    {
        $arr = $request->all();

        $model = new $this->_model;
        $model->fill($arr);
        $model['password'] = bcrypt($model['password']); // crypt password
        $model['status'] = User::ACTIVE; // status active

        if($model->save()){
            $model->assignRole(ROLE_MEMBER);
            return Helper::successResponse($model);
        }

        return Helper::errorResponse();
    }

    /**
     * @throws ValidationException
     */
    public function doChangePassword($user, $password, $newPassword): JsonResponse
    {
        if($user != null){
            if(!Hash::check($password, $user->password)){
                throw ValidationException::withMessages([
                    'password' => "Mật khẩu hiện tại không đúng"
                ]);
            }

            if(Hash::check($newPassword, $user->password)){
                throw ValidationException::withMessages([
                    'new_password' => "Mật khẩu mới không được trùng với mật khẩu cũ"
                ]);
            }

            $user->password = bcrypt($newPassword);
            if($user->save()){
                return Helper::successResponse("Change password success!");
            }
        }

        return Helper::errorResponse("fail!");
    }

    /**
     * @throws ValidationException
     */
    public function doLock($id): JsonResponse
    {
        if($id === auth()->id()){
            throw ValidationException::withMessages([
                'message' => 'Không thể tự khóa tài khoản của mình'
            ]);
        }

        $user = User::query()->find($id);

        if($user){
            // only lock user active, don't lock user penning
            if($user->status == User::ACTIVE){
                $user->status = User::LOCKED;
            }

            if($user->save()){
                return Helper::successResponse("Lock success!");
            } else {
                return Helper::errorResponse("error");
            }
        }

        return Helper::errorResponse("User doesn't exists!");
    }

    public function doUnlock($id): JsonResponse
    {
        $user = User::query()->find($id);

        if($user){
            if($user->status == User::LOCKED){
                $user->status = User::ACTIVE;
            }

            if($user->save()){
                return Helper::successResponse("Unlock success!");
            } else {
                return Helper::errorResponse("error");
            }
        }

        return Helper::errorResponse("User doesn't exists!");
    }

    public function doUpdate($arr): JsonResponse
    {
        $model = User::query()->find($arr['id']);

        if($model != null){
            $model->fill($arr);
            if($model->save()){
                return Helper::successResponse($model);
            }
        }

        return Helper::errorResponse("update fail!");
    }
}
