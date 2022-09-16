<?php

namespace App\Models;
use CodeIgniter\Model;

class returnsModel extends Model
{
    protected $table = 'returns';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $beforeInsert=['beforeInsert'];
    protected $allowedFields = ['device_serial','fault_type','diagnosis','status','image','userid'];
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;
    protected function beforeInsert(array $data){
        $data['data']['created_at'] = date('Y-m-d H:i:s');
        return $data;
    }

}