<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RSAController extends Controller
{
    
    public function RSA(){

        dd(openssl_pkey_new(array(
            "private_key_bits" => 2048,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        )));
    }

}
