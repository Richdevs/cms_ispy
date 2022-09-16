<?php

namespace app\Models;

use CodeIgniter\Model;

class accessoryModel extends Model
{
    protected $table='newAccessories';
    protected $primaryKey='refno';
    protected $useAutoIncrement=true;
    protected $insertID=0;
    protected $returnType='array';
   // protected $beforeInsert=['beforeInsert'];

    protected $allowedFields =['idInstallation','avl','converter','probe','ecan','immobilizer','extra','installer','created_at'];
    protected $validationRules=[];
    protected $validationMessages=[];
    protected $skipValidation=false;
    protected $cleanValidationRules=true;

    // protected function beforeInsert(array $data){
    //     $data['data']['created_at'] = date('Y-m-d H:i:s');

    //     return $data;
    // }
}