<?php
namespace App\Repositories\Admin;

use App\Contracts\Admin\IAdminRepository;
use App\DataTransferObjects\AdminDTO;
use App\Repositories\Repository;


class AdminRepository extends Repository implements IAdminRepository
{
    public function __construct()
    {
        $this->mModel  = "\App\Models\Admin\Admin";
        $this->mFilterNameSpace  = "App\Filter\Admin\\";
    }
}
