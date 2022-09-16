<?php

namespace app\Models;

use CodeIgniter\Model;

class accModel extends Model
{
    protected $table='accessories';
    protected $primaryKey='idaccess';
    protected $useAutoIncrement=true;
    protected $insertID=0;
    protected $returnType='array';
    protected $beforeInsert=['beforeInsert'];

    protected $allowedFields =['accserial','accname','description','device_serial','Installer'];
    protected $validationRules=[];
    protected $validationMessages=[];
    protected $skipValidation=false;
    protected $cleanValidationRules=true;

    protected function beforeInsert(array $data){
        $data['data']['created_at'] = date('Y-m-d H:i:s');

        return $data;
    }
}