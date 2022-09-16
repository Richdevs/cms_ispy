<?php
namespace App\Models;

use CodeIgniter\Model;

class faultModel extends Model{
    protected $table='faults';
    protected $primaryKey='id';
    protected $useAutoIncrement=true;
    protected $insertID=0;
    protected $returnType='array';
    protected $allowedFields=['fault_type','description'
    ];
    // protected $validationRules=[];
    // protected $validationMessages=[];
    // protected $skipValidation=false;
    // protected $cleanValidationRules=true;
}