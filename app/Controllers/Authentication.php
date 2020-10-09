<?php namespace App\Controllers;

use App\Models\Authentication_model;

class Authentication extends BaseController
{
    function __construct()
    {
    }

    public function index()
    {
        $name = 'Arkkaracht.S';
        $token = $this->encodeToken($name);
        $data = [
            'name' => $name,
            'token' =>  $token ,
            'decodeToken' => $this->decodeToken($token)
        ];
//        return $this->success($data);
    }


}