<?php

namespace App\Models;
use CodeIgniter\Model;

class transModel extends Model
{
    protected $table ='transfers';
    protected $primaryKey = 'refno';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $beforeInsert=['beforeInsert'];

    protected $allowedFields = ['idinstallation','change_from','change_to','change_type','userid'];
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;


    protected function beforeInsert(array $data){
        $data['data']['created_at'] = date('Y-m-d H:i:s');

        return $data;
    }

}