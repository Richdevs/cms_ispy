<?php

namespace App\Validation;
use App\Models\userModel;

class userRules{
    public  function ValidateUser(string $Str,string $fields,array $data){
        $model=new userModel();
        $user=$model->where('email',$data['email'])
            ->first();
        if(!$user)
            return false;

        return password_verify($data['pwd'],$user['pwd']);
    }
}