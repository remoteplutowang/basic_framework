<?php
namespace App\Services\User;


use App\Contracts\User\IUserRepository;
use App\Contracts\User\IUserService;
use App\Exceptions\CHException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserService implements IUserService
{
    protected IUserRepository $mUserRepo;


    public function __construct(IUserRepository $repository)
    {
        $this->mUserRepo = $repository;
    }

    public function login($cellphone,$password)
    {
        // TODO: Implement login() method.
        $user = $this->mUserRepo->findByCond(["cellphone"=>$cellphone]);
        if(empty($user) || !Hash::check($password, $user->password)){
            throw new CHException("",CHException::CONST_ERROR_USER_PASSWORD_NOT_MATCH);
        }
        $token = $user->createToken('API')->plainTextToken;
        return ["user"=>$user,'token' => $token];
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
            return $this->mUserRepo->create($params);
        } catch (\Exception $exp){
            Log::channel("exception")->info($exp->getMessage());
            if($exp->getCode() == 23000){
                throw new CHException("",CHException::CONST_ERROR_USER_CREATE_WITH_SAME_CELLPHONE);
            } else {
                // 处理未找到记录的情况
                throw new CHException("",CHException::CONST_ERROR_USER_CREATE);
            }
        }
    }

    public function update($userID,$updateData)
    {
        // TODO: Implement find() method.
        try{
            return $this->mUserRepo->update($userID,$updateData);
        } catch (\Exception $exp){
            Log::channel("exception")->info($exp->getMessage());
            // 处理未找到记录的情况
            throw new CHException("",CHException::CONST_ERROR_USER_UPDATE);
        }
    }

    public function info($userID)
    {
        // TODO: Implement find() method.
        try{
            return $this->mUserRepo->info($userID);
        } catch (\Exception $exp){
            Log::channel("exception")->info($exp->getMessage());
            // 处理未找到记录的情况
            throw new CHException("",CHException::CONST_ERROR_USER_FIND);
        }
    }


    public function delete($userID)
    {
        // TODO: Implement delete() method.
        try{
            return $this->mUserRepo->delete($userID);
        } catch (\Exception $exp){
            Log::channel("exception")->info($exp->getMessage());
            // 处理未找到记录的情况
            throw new CHException("",CHException::CONST_ERROR_USER_DELETE);
        }
    }

    public function search($params, $sort = array(), $columns = array('*'), $page = 0, $page_size = 0)
    {
        // TODO: Implement search() method.
        return $this->mUserRepo->search($params,$sort,  $columns , $page, $page_size);
    }

}
