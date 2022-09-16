<?php
namespace App\Models;
use CodeIgniter\Model;


class userModel extends Model {
protected $table='users';
protected $primaryKey='userid';
protected $useAutoIncrement=true;
protected $insertID=0;
protected $returnType='array';
protected $beforeInsert = ['beforeInsert'];

protected $allowedFields = ['userName','email','slocation','designation','pwd'];
protected $validationRules=[];
protected $validationMessages=[];
protected $skipValidation=false;
protected $cleanValidationRules=true;

protected function beforeInsert(array $data){
        $data = $this->passwordHash($data);
        $data['data']['created_at'] = date('Y-m-d H:i:s');

        return $data;
    }
    protected function passwordHash(array $data){
        if(isset($data['data']['pwd']))
            $data['data']['pwd'] = password_hash($data['data']['pwd'], PASSWORD_DEFAULT);

        return $data;
    }

}

