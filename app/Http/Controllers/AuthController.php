<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;

class AuthController extends ApiController {

    public function __construct()
    {
        parent::__construct();
    }

    public function create(CreateUserRequest $request)
    {

    }

}