<?php

namespace App\Http\Controllers;

use Api\Repositories\Interfaces\UserRepositoryInterface;
use App\Http\Requests\CreateUserRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends ApiController {

    protected $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;

        parent::__construct();
    }

    public function create(CreateUserRequest $request)
    {
        $fields = $request->only('name', 'email', 'password');

        $result = $this->user->create($fields);

        if ($result) {

            $credentials = $this->user->credentials($fields);

            \Auth::attempt($credentials);

            $user = \Auth::user();

            try {

                $token = JWTAuth::customClaims([])->fromUser($user);

            } catch (JWTException $e) {
                return $this->respondInternalError('Could not create token.');
            }

            return $this->respondCreated(compact('token'), 'New user account was successfully registered.');

        }

        return $this->respondInternalError('It was not possible to create the account.');
    }

}