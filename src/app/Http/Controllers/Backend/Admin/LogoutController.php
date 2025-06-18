<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Contracts\Admin\IAdminService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class LogoutController extends Controller
{
    protected IAdminService $mAdminService;

    public function __construct(IAdminService $service)
    {
        $this->mAdminService = $service;
    }

    public function logout(Request $request)
    {
        $this->mAdminService->logout($request);
        return response()->api([]);
    }

}
