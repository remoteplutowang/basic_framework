<?php
namespace App\Services\Admin;

use App\Contracts\Admin\IAdminRepository;
use App\Contracts\Admin\IAdminService;
use App\Exceptions\CHException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminService implements IAdminService
{
    protected IAdminRepository $mAdminRepo;


    public function __construct(IAdminRepository $repository)
    {
        $this->mAdminRepo = $repository;
    }

    public function login($adminAccount,$password)
    {
        // TODO: Implement login() method.
        $admin = $this->mAdminRepo->findByCond(["admin_account"=>$adminAccount]);
        if(empty($admin) || !Hash::check($password, $admin->password)){
            throw new CHException("",CHException::CONST_ERROR_ADMIN_PASSWORD_NOT_MATCH);
        }
        $token = $admin->createToken('Background')->plainTextToken;
        return ["admin"=>$admin,'token' => $token];
    }

    public function logout($request)
    {
        // TODO: Implement logout() method.
        $request->user()->tokens()->delete();
    }

    public function create($params)
    {
        // TODO: Implement create() method.
        try{
            return $this->mAdminRepo->create($params);
        } catch (\Exception $exp){
            Log::channel("exception")->info($exp->getMessage());
            if($exp->getCode() == 23000){
                throw new CHException("",CHException::CONST_ERROR_ADMIN_CREATE_WITH_SAME_ACCOUNT);
            } else {
                // 处理未找到记录的情况
                throw new CHException("",CHException::CONST_ERROR_ADMIN_CREATE);
            }
        }
    }

    public function update($adminID,$updateData)
    {
        // TODO: Implement find() method.
        try{
            return $this->mAdminRepo->update($adminID,$updateData);
        } catch (\Exception $exp){
            Log::channel("exception")->info($exp->getMessage());
            // 处理未找到记录的情况
            throw new CHException("",CHException::CONST_ERROR_ADMIN_UPDATE);
        }
    }

    public function info($adminID)
    {
        // TODO: Implement find() method.
        try{
            return $this->mAdminRepo->info($adminID);
        } catch (\Exception $exp){
            Log::channel("exception")->info($exp->getMessage());
            // 处理未找到记录的情况
            throw new CHException("",CHException::CONST_ERROR_ADMIN_FIND);
        }
    }


    public function delete($adminID)
    {
        // TODO: Implement delete() method.
        try{
            return $this->mAdminRepo->delete($adminID);
        } catch (\Exception $exp){
            Log::channel("exception")->info($exp->getMessage());
            // 处理未找到记录的情况
            throw new CHException("",CHException::CONST_ERROR_ADMIN_DELETE);
        }
    }

    public function search($params, $sort = array(), $columns = array('*'), $page = 0, $page_size = 0)
    {
        // TODO: Implement search() method.
        return $this->mAdminRepo->search($params,$sort,  $columns , $page, $page_size);
    }

}
