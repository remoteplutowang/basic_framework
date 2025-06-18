<?php
namespace App\Repositories\User;

use App\Contracts\User\IUserRepository;
use App\Repositories\Repository;


class UserRepository extends Repository implements IUserRepository
{
    public function __construct()
    {
        $this->mModel  = "\App\Models\User\User";
        $this->mFilterNameSpace  = "App\Filter\User\\";
    }
}
