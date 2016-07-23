<?php namespace App\Library;

use Carbon\Carbon;


class AjaxResponse
{
    public static function sendResponse($message, $error = true, $code = 400)
    {
        $header = array(
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        return \Response::json(
            array(
                'error' => $error,
                'message' => $message,
                'code' => $code
            ),
            $code,
            $header,
            JSON_UNESCAPED_UNICODE
        );

    }

}


