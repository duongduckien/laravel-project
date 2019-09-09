<?php

namespace App\Http\Requests;

use Symfony\Component\HttpFoundation\Response as IlluminateResponse;

trait ApiResponse
{

    public static $CODE_WRONG_ARGS = 'GEN-FUBARGS';

    public static $CODE_NOT_FOUND = 'GEN-LIKETHEWIND';

    public static $CODE_INTERNAL_ERROR = 'GEN-AAAGGH';

    public static $CODE_UNAUTHORIZED = 'GEN-MAYBGTFO';

    public static $CODE_FORBIDDEN = 'GEN-GTFO';

    public static $CODE_INVALID_CREDENTIALS = 'GEN-NOTAUTHORIZED';

    protected $statusCode = IlluminateResponse::HTTP_OK;

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Generates a Response with a 201 HTTP header and a given message.
     */
    public function respondCreated(array $array, $message = 'Item successfully created')
    {
        $array['message'] = $message;

        return $this->setStatusCode(IlluminateResponse::HTTP_CREATED)->respondWithArray($array);
    }

    /**
     * Generates a Response with a 500 HTTP header and a given message.
     */
    public function respondInternalError($message = 'Internal Error')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message, self::$CODE_INTERNAL_ERROR);
    }

    protected function respondWithArray(array $array, array $headers = [])
    {
        $response = response()->json($array, $this->statusCode, $headers);

        return $response;
    }

    protected function respondWithError($message, $errorCode = '')
    {
        return $this->respondWithArray([
            'error' => [
                'http_code' => $this->statusCode,
                'message' => $message,
            ],
        ]);
    }

}
