<?php

namespace App\Models;
use CodeIgniter\Model;

class clientModel extends Model
{
    protected $table='clients';
    protected $primaryKey='idclient';
    protected $useAutoIncrement=true;
    protected $insertID=0;
    protected $returnType='array';
    protected $beforeInsert=['beforeInsert'];

    protected $allowedFields =['idclient','clientname','contactperson','phone','email','created_at'];
    protected $validationRules=[];
    protected $validationMessages=[];
    protected $skipValidation=false;
    protected $cleanValidationRules=true;

    protected function beforeInsert(array $data){
        $data['data']['created_at'] = date('Y-m-d H:i:s');

        return $data;
    }


}