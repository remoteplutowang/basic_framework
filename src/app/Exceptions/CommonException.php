<?php

namespace App\Exceptions;
use Throwable;

class CommonException extends \Exception
{
    /**
     * error code
     * 1.服务标识 前三位
     * 2.模块标识 中间两位
     * 3.错误码   后三位
     * 比如 101|01|001 101标识RMS服务 01标识Module模块 001标识第一个错误
     */
 
    const CONST_ERROR_COMMON_BASE = 101;
    //For Admin
    const CONST_ERROR_ADMIN_BASE = 102;
    //For Role
    const CONST_ERROR_ROLE_BASE = 103;
   

    //For Common
    const CONST_ERROR_CERTIFICATE_NUMBER_INVALID = self::CONST_ERROR_COMMON_BASE * 100000 + 1 * 1000 + 1;
    const CONST_ERROR_SMS_TOKEN_NOT_EXIST = self::CONST_ERROR_COMMON_BASE * 100000 + 1 * 1000 + 2;
    const CONST_ERROR_SMS_TOKEN_NOT_MATCH = self::CONST_ERROR_COMMON_BASE * 100000 + 1 * 1000 + 3;
    const CONST_ERROR_AUTH_NO_PERMISSION = self::CONST_ERROR_COMMON_BASE * 100000 + 1 * 1000 + 4;
    const CONST_ERROR_AUTH_TOKEN_INVALID = self::CONST_ERROR_COMMON_BASE * 100000 + 1 * 1000 + 5;
    const CONST_ERROR_PARAMETER_INVALID = self::CONST_ERROR_COMMON_BASE * 100000 + 1 * 1000 + 8;
    const CONST_ERROR_SYSTEM = self::CONST_ERROR_COMMON_BASE * 100000 + 1 * 1000 + 9;
    const CONST_ERROR_SMS_TOKEN_EXIST = self::CONST_ERROR_COMMON_BASE * 100000 + 1 * 1000 + 10;
    const CONST_ERROR_UPDATE_NOTHING = self::CONST_ERROR_COMMON_BASE * 100000 + 1 * 1000 + 11;
    CONST CONST_ERROR_CALL_API_WITH_INVALID_TOKEN = self::CONST_ERROR_COMMON_BASE * 100000 + 1 * 1000 + 12;


    //For Admin
    const CONST_ERROR_ADMIN_CREATE = self::CONST_ERROR_ADMIN_BASE * 100000 + 1 * 1000 + 1;
    const CONST_ERROR_ADMIN_DELETE = self::CONST_ERROR_ADMIN_BASE * 100000 + 1 * 1000 + 2;
    const CONST_ERROR_ADMIN_FIND = self::CONST_ERROR_ADMIN_BASE * 100000 + 1 * 1000 + 3;
    const CONST_ERROR_ADMIN_UPDATE = self::CONST_ERROR_ADMIN_BASE * 100000 + 1 * 1000 + 4;
    const CONST_ERROR_ADMIN_PASSWORD_NOT_MATCH = self::CONST_ERROR_ADMIN_BASE * 100000 + 1 * 1000 + 5;
    const CONST_ERROR_ADMIN_CREATE_WITH_SAME_ACCOUNT = self::CONST_ERROR_ADMIN_BASE * 100000 + 1 * 1000 + 6;


    //For Role
    const CONST_ERROR_ROLE_FIND = self::CONST_ERROR_ROLE_BASE * 100000 + 1 * 1000 + 1;
    const CONST_ERROR_ROLE_DELETE_WITH_USERS = self::CONST_ERROR_ROLE_BASE * 100000 + 1 * 1000 + 2;
    const CONST_ERROR_ROLE_UPDATE = self::CONST_ERROR_ROLE_BASE * 100000 + 1 * 1000 + 3;
    const CONST_ERROR_ROLE_UPDATE_SUPER_ADMIN = self::CONST_ERROR_ROLE_BASE * 100000 + 1 * 1000 + 4;
    const CONST_ERROR_ROLE_EXIST = self::CONST_ERROR_ROLE_BASE * 100000 + 1 * 1000 + 5;

   


    private $mErrorMap = [
        self::CONST_ERROR_ADMIN_CREATE => "添加管理员失败,请重新尝试",
        self::CONST_ERROR_ADMIN_DELETE => "删除管理员失败,请重新尝试",
        self::CONST_ERROR_ADMIN_FIND => "未找到指定的管理员信息",
        self::CONST_ERROR_ADMIN_UPDATE => "更新管理员信息失败",
//        self::CONST_ERROR_ADMIN_UPDATE_ROOT => "初始项目管理员属性不可修改,如有需要请与管理员联系",
        self::CONST_ERROR_ADMIN_PASSWORD_NOT_MATCH => "管理员账号不存在或密码不匹配",
        self::CONST_ERROR_ADMIN_CREATE_WITH_SAME_ACCOUNT => "管理员账号已存在,创建失败",
        self::CONST_ERROR_CALL_API_WITH_INVALID_TOKEN => "无效的系统Token",

        self::CONST_ERROR_CERTIFICATE_NUMBER_INVALID => "无效的身份证号码",
        self::CONST_ERROR_SMS_TOKEN_NOT_EXIST => "未找到短信验证码信息,请重新获取",
        self::CONST_ERROR_SMS_TOKEN_NOT_MATCH => "短信验证码错误,请重新输入.",
        self::CONST_ERROR_AUTH_NO_PERMISSION => "没有此功能的访问权限,请跟管理员联系",
        self::CONST_ERROR_AUTH_TOKEN_INVALID => "无效的校验信息,请重新登录",
        self::CONST_ERROR_SMS_TOKEN_EXIST => "短信验证码已发送,5分钟内有效!",
        self::CONST_ERROR_UPDATE_NOTHING => "未更新任何信息！",


        self::CONST_ERROR_ROLE_FIND => "未找到指定的角色信息",
        self::CONST_ERROR_ROLE_DELETE_WITH_USERS => "该角色仍有用户使用,请解绑后再删除",
        self::CONST_ERROR_ROLE_UPDATE => "更新角色信息失败",
        self::CONST_ERROR_ROLE_UPDATE_SUPER_ADMIN => "超级管理员角色信息不可修改,如有需要请联系系统管理员",
        self::CONST_ERROR_ROLE_EXIST => "已有相同角色,请使用其他角色名称",

       
    ];

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $this->code = $code;
        $this->message = empty($message) ? ($this->mErrorMap[$code] ?? "") : $message;
    }

}
