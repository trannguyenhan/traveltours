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

    /**
     * @param $request
     * @return array
     */
    public static function getFilterParams($request): array
    {
        return collect($request->all())->filter(function ($value, $key) {
            $filterType = substr($key, 0, strpos($key, "_"));
            return (in_array($filterType, array_values(FILTER_TYPE)));
        })->all();
    }

    public static function filterFromParams($params, $query, $ignoreField = [], $numberZeroOrNull = false, $acceptNullValue = false)
    {
        foreach ($params as $key => $value) {
            if ($value !== null || $acceptNullValue) {
                $pos = strpos($key, "_");
                $filterType = substr($key, 0, $pos);
                $field = substr($key, $pos + 1);
                if (!in_array($field, $ignoreField)) {
                    self::handlerEachFilter($filterType, $field, $ignoreField, $numberZeroOrNull, $value, $query);
                }
            }
        }
    }

    public static function handlerEachFilter($filterType, $field, $ignoreField, $numberZeroOrNull, $value, $query)
    {
        if(!Schema::hasColumn($query->getModel()->getTable(), $field)){
            return;
        }

        switch ($filterType) {
            case FILTER_TYPE['NUMBER']:
                self::filterHandlerNumberCase($field, $ignoreField, $numberZeroOrNull, $value, $query);
                break;
            case FILTER_TYPE['TEXT']:
                $query->where($field, 'LIKE', "%$value%");
                break;
            case FILTER_TYPE['SELECT']:
            case FILTER_TYPE['RESOURCE']:
                if (is_array($value)) {
                    $query->whereIn($field, $value);
                } else if ($value !== SELECT_ALL) {
                    $query->where($field, $value);
                }
                break;
            case FILTER_TYPE['DATE']:
                self::filterHandlerDateCase($field, $query, $value);
                break;
            case FILTER_TYPE['BOOLEAN']:
                $query->where($field, $value);
                break;
            default:
                break;
        }
    }

    public static function filterHandlerNumberCase($field, $ignoreField, $numberZeroOrNull, $value, $query)
    {
        $opPos = strpos($field, "_");
        $operation = substr($field, 0, $opPos);
        $fieldName = substr($field, $opPos + 1);

        if (!in_array($fieldName, $ignoreField)) {
            if ($operation == "min") {
                if ($numberZeroOrNull && $value == "0") {
                    $query->where(function ($q) use ($fieldName) {
                        $q->where($fieldName, ">=", 0)
                            ->orWhereNull($fieldName);
                    });
                } else {
                    $query->where($fieldName, ">=", $value);
                }
            } elseif ($operation == "max") {
                if ($numberZeroOrNull) {
                    $query->where(function ($q) use ($value, $fieldName) {
                        $q->where($fieldName, "<=", $value)
                            ->orWhereNull($fieldName);
                    });
                } else {
                    $query->where($fieldName, "<=", $value);
                }
            }
        }
    }

    public static function filterHandlerDateCase($field, $query, $value)
    {
        $opPos = strpos($field, "_");
        $operation = substr($field, 0, $opPos);
        $fieldName = substr($field, $opPos + 1);
        $isByOperation = collect(array_values(OPERATOR))
                ->filter(function ($item) use ($operation) {
                    return $item === $operation;
                })->count() > 0;
        if ($isByOperation === true) {
            if ($operation == OPERATOR['GREATER_THAN']) {
                $query->where($fieldName, '>', $value);
            } elseif ($operation == OPERATOR['GREATER_THAN_OR_EQUAL']) {
                $query->where($fieldName, '>=', $value);
            } elseif ($operation == OPERATOR['LESS_THAN']) {
                $query->where($fieldName, '<', Carbon::createFromFormat(DISPLAY_DATE_FORMAT, $value)->endOfDay());
            } elseif ($operation == OPERATOR['LESS_THAN_OR_EQUAL']) {
                $query->where($fieldName, '<=', Carbon::createFromFormat(DISPLAY_DATE_FORMAT, $value)->endOfDay());
            }
        } else {
            if (isset($value[0])) {
                $query->where($field, '>=', $value[0]);
            }
            if (isset($value[1])) {
                $endDate = Carbon::createFromFormat(DISPLAY_DATE_FORMAT, $value[1])->endOfDay();
                $query->where($field, '<=', $endDate);
            }
        }
    }
}
