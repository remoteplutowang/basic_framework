<?php

namespace App\Http\Controllers\Backend\Admin;


use App\Contracts\Admin\IAdminService;
use App\Exceptions\CommonException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class AdminController extends Controller
{
    protected IAdminService $mAdminService;

    public function __construct(IAdminService $service)
    {
        $this->mAdminService = $service;
    }


    public function create(Request $request)
    {
        $request->validate([
            'admin_account' => 'required|string|min:6|max:16',
            'admin_name' => 'required|string|min:2|max:16',
            'cellphone' => 'required|regex:/^1[3456789]\d{9}$/',
            'password' => 'required|string|min:6|max:16',
        ]);
        $operator = $request->user();
        $params = $request->only(['admin_account','admin_name','cellphone','password']);
        $params["operator_id"] = $operator->id;
        $params["operator_name"] = $operator->admin_name;
        $admin = $this->mAdminService->create($params);
        return response()->api($admin);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'admin_id' => 'required|exists:App\Models\Admin\Admin,id'
        ]);
        $this->mAdminService->delete($request->admin_id);
        return response()->api([]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'admin_id' => 'required|exists:App\Models\Admin\Admin,id',
            'admin_name' => 'string|min:2|max:16',
            'cellphone' => 'regex:/^1[3456789]\d{9}$/',
            'password' => 'string|min:6|max:16',
        ]);
        $operator = $request->user();
        $params = $request->only(['admin_name','cellphone','password']);
        if(empty($params)){
            throw new CommonException("",CommonException::CONST_ERROR_UPDATE_NOTHING);
        }
        $params["operator_id"] = $operator->id;
        $params["operator_name"] = $operator->admin_name;
        $result = $this->mAdminService->update($request->admin_id,$params);
        return response()->api($result);
    }

    public function info(Request $request)
    {
        $request->validate([
            'admin_id' => 'required|integer',
        ]);
        $admin = $this->mAdminService->info($request->admin_id);
        return response()->api($admin);
    }

    public function search(Request $request)
    {
        $request->validate([
            'admin_name' => 'string',
            'page' => 'integer|min:1',
            'page_size' => 'integer|min:1|max:50',
            'sort' => 'json',
        ]);
        $params = $request->only(['admin_name']);
        $page = $request->input('page', 1);
        $pageSize = $request->input('page_size', 10);
        $sort = [];
        if($request->has("sort") && strlen($request->sort) > 0){
            $sort = json_decode($request->sort,true);
        }
        $data = $this->mAdminService->search($params,$sort,["*"],$page,$pageSize);
        return response()->api($data);
    }



}
