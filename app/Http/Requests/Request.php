<?php

namespace App\Http\Requests;

use Symfony\Component\HttpFoundation\Response as IlluminateResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class Request extends FormRequest
{
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json([
            'error' => 'Validation failed',
            'fields' => $validator->errors()
        ], IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
