<?php

namespace Api\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function credentials($data);

    public function create($fields);
}
