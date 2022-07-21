<?php

namespace App;

use App\Jobs\ProcessLogJob;
use App\Models\Place;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

class Helper
{
    /**
     * @param null $data
     * @return JsonResponse
     */
    public static function successResponse($data = null): JsonResponse
    {
        $is = is_array($data); // check type of $data

        if ($is) {
            return response()->json([
                'code' => CODE_SUCCESS,
                'message' => 'successfully',
                'total' => count($data),
                'data' => $data
            ]);
        }

        // else $data is not array
        return response()->json([
            'code' => CODE_SUCCESS,
            'message' => 'successfully',
            'data' => $data
        ]);
    }

    /**
     * @param $data
     * @param $total
     * @return JsonResponse
     */
    public static function successResponseList($data, $total): JsonResponse
    {
        return response()->json([
            'code' => CODE_SUCCESS,
            'message' => 'successfully',
            'total' => $total,
            'data' => $data
        ]);
    }

    /**
     * @param $token
     * @return JsonResponse
     */
    public static function successResponseWithToken($token): JsonResponse
    {
        return response()->json([
            'code' => CODE_SUCCESS,
            'token' => $token,
            'type' => 'bearer',
            'user' => auth()->user()->load('roles:id,name')
        ]);
    }

    /**
     * @param null $message
     * @return JsonResponse
     */
    public static function errorResponse($message = null): JsonResponse
    {
        return response()->json([
            'code' => CODE_ERROR,
            'message' => $message ? $message : null,
        ]);
    }

    /**
     * Return response if validation not success
     * @param null $message
     * @return JsonResponse
     */
    public static function errorValidation($message = null): JsonResponse
    {
        return response()->json([
            'code' => CODE_ERROR,
            'message' => $message ? $message : null,
        ], 422);
    }

    /**
     * Update image to public folder and return this url
     *
     * @param $image
     * @param array $option
     * @return array
     */
    public static function updateImageUrl($image, $option = ["type" => null, "id" => null]): array
    {
        try {
            $name = uniqid() . "." . $image->extension();
            $path = $image->move('uploads/' . $option["type"], $name);
            $path = url($path);

            if ($option['id'] !== null) \App\Helper::unlinkOldImage($option);

            return [
                'code' => 0,
                'url' => $path
            ];
        } catch (\Exception $e) {
            return [
                'code' => 1,
                'url' => 'fail'
            ];
        }
    }

    public static function unLinkOldImage($option)
    {
        $type = $option['type'];
        $id = $option['id'];

        if ($type == 'user') {
            $avatar = User::query()->find($id)->avatar;
            if ($avatar != null) {
                $baseUrl = URL::to("/");
                $avatar = str_replace($baseUrl, '', $avatar);
                if (File::exists(public_path($avatar))) {
                    File::delete(public_path($avatar));
                }
            }
        }

        if ($type == 'place') {
            $listImage = Place::query()->find($id)->images;
            foreach ($listImage as $key => $oldImage) {
                $baseUrl = URL::to("/");
                $oldImage = str_replace($baseUrl, '', $oldImage);
                if (File::exists(public_path($oldImage))) {
                    File::delete(public_path($oldImage));
                }
            }
        }
    }

    public static function unlinkOldAvatarCurrentUser()
    {
        if (auth()->user() != null) {
            $avatar = User::query()->find(auth()->id())->avatar;
            if ($avatar != null) {
                $baseUrl = URL::to("/");
                $avatar = str_replace($baseUrl, '', $avatar);
                if (File::exists(public_path($avatar))) {
                    File::delete(public_path($avatar));
                }
            }
        }
    }
}
