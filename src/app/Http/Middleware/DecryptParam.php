<?php

namespace App\Http\Middleware;

use App\Utils\AESCBCEncrypt;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DecryptParam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
//      Decrypt the parameters here
        if(app()->environment("release")){
            $encryptor = new AESCBCEncrypt();
            $decryptedData =  $encryptor->decrypt($request->data);
            $parameters = json_decode($decryptedData,true);
//            Reassign the decrypted parameter to the request
            $request->merge($parameters);
        }

        return $next($request);
    }
}
