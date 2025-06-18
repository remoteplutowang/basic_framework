<?php
namespace App\Utils;

use Illuminate\Encryption\Encrypter;

class AESCBCEncrypt
{
    protected $mKey;
    protected $mIv;
    protected $mEncryptor;

    public function __construct()
    {
        $this->mKey = env("ENCRYPT_KEY");
        $this->mIv = env("ENCRYPT_IV");
        //$this->mEncryptor = new Encrypter($this->mKey, 'AES-256-CBC');
    }

    public function encrypt($data)
    {
        return openssl_encrypt($data, 'aes-256-cbc', $this->mKey, 0, $this->mIv);
        //return $this->mEncryptor->encrypt($data, false, $this->mIv);
    }

    public function decrypt($encryptData)
    {
        return openssl_decrypt($encryptData, 'aes-256-cbc', $this->mKey, 0, $this->mIv);
        //return $this->mEncryptor->decrypt($encryptData, false, $this->mIv);
    }

}
