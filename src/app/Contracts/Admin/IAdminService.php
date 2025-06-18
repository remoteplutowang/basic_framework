<?php
namespace App\Contracts\Admin;

use Illuminate\Http\Request;

interface IAdminService
{
    public function login($adminAccount,$password);
    public function logout(Request $request);
    public function create($params);
    public function info($adminID);
    public function update($adminID,$params);
    public function delete($adminID);
    public function search($params,$sort= array(),$columns = array('*'),$page = 0,$page_size = 0);
}
