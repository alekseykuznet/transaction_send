<?php

namespace App\Traits;

use Illuminate\Support\Facades\Response;

trait ApiResponse
{
    /**
     * @param $result
     * @param $message
     * @param $code
     * @return mixed
     */
    public function sendResponse($data, $message = '', $code = 200)
    {
        return Response::json(self::makeResponse($data, $message), $code);
    }

    /**
     * @param $error
     * @param int $code
     * @param array $data
     * @return mixed
     */
    public function sendError($error, $code = 400, $data = [])
    {
        return Response::json(self::makeError($data, $error), $code);
    }

    /**
     * @param mixed $data
     * @param string  $message
     *
     * @return array
     */
    private static function makeResponse($data, $message = '')
    {
        return [
            'success' => true,
            'data'    => $data,
            'message' => $message,
        ];
    }

    /**
     * @param array  $data
     * @param string $message
     *
     * @return array
     */
    private static function makeError(array $data = [], $message = '')
    {
        $result = [
            'success' => false,
            'message' => $message,
        ];

        if (!empty($data)) {
            $result['data'] = $data;
        }

        return $result;
    }
}
