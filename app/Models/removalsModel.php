<?php

namespace app\Models;

use CodeIgniter\Model;

class removalsModel extends Model
{
    protected $table = 'removalsView';
    protected $primaryKey = 'idinstallation';
    protected $allowedFields = [
        'idinstallation', 'regno', 'device_type', 'device_serial', 'simcard', 'make', 'color',
        'clientname', 'subscription', 'username','installer', 'warranty', 'image', 'createdat','deletedon'
    ];
}
 class rem extends Model{
    protected $table = 'removals';
    protected $primaryKey = 'idinstallation';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    

    protected $allowedFields = ['regno', 'device_type', 'device_serial',
        'simcard', 'make', 'color','client','subscription','userid','created_at','warranty','image','installer','deletedon'];
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;
   
 }