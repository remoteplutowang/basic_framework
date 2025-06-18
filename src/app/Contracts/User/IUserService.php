<?php
namespace App\Contracts\User;

use Illuminate\Http\Request;

interface IUserService
{
    public function login($cellphone,$password);
    public function logout(Request $request);
    public function create($params);
    public function info($userID);
    public function update($userID,$params);
    public function delete($userID);
    public function search($params,$sort= array(),$columns = array('*'),$page = 0,$page_size = 0);
}
