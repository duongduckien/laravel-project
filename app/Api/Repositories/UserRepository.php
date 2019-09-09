<?php

namespace Api\Repositories;

use Api\Models\User;
use Api\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface {

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function credentials($data)
    {
        return [
            'email' => $data['email'],
            'password' => $data['password'],
            'block' => 0
        ];
    }

    public function create($fields)
    {
        $data = [
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => \Hash::make($fields['password']),
            'reset_token' => (string) \Uuid::generate(),
            'block' => 0
        ];

        return $this->user->create($data);
    }

}