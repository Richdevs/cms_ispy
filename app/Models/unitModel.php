<?php

namespace App\Models;
use CodeIgniter\Model;


class unitModel extends Model
{
    protected $table = 'active_installation';
    protected $primaryKey = 'idinstallation';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    // protected $beforeInsert=['beforeInsert'];
    protected $beforeUpdate=['beforeUpdate'];

    protected $allowedFields = ['regno', 'device_type', 'device_serial',
        'simcard', 'make', 'color','client','subscription','userid','created_at','warranty','image','installer'];
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;
    // protected function beforeInsert(array $data){
    //     $data['data']['created_at'] = date('Y-m-d H:i:s');
    //     return $data;
    // }
    protected function beforeUpdate(array $data){
        $data['data']['updated_at'] = date('Y-m-d H:i:s');
        return $data;
    }
}
