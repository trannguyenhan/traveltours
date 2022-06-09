<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (ThrottleRequestsException $e, $request) {
            $url = $request->url();
            if(strpos($url, 'login') !== false){
                return response()->json([
                    'message' => 'Đăng nhập quá nhiều lần, vui lòng chờ 1 phút để đăng nhập tiếp tục'
                ], 404);
            }

            return response()->json([
                'message' => 'Gọi API quá nhiều lần, vui lòng chờ 1 phút để tiếp tục'
            ]);
        });
    }
}
