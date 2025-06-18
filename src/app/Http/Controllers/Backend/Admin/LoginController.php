<?php

namespace App\Http\Controllers\Backend\Admin;


use App\Contracts\Admin\IAdminService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class LoginController extends Controller
{
    protected IAdminService $mAdminService;

    public function __construct(IAdminService $service)
    {
        $this->mAdminService = $service;
    }

    public function login(Request $request)
    {
        $request->validate([
            'admin_account' => 'required',
            'password' => 'required',
        ]);

        $token = $this->mAdminService->login($request->admin_account,$request->password);

        return response()->api($token);
    }

}
