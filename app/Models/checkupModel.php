<?php

namespace App\Models;
use CodeIgniter\Model;


class checkupModel extends Model
{
    protected $table = 'newCheckup';
    protected $primaryKey = 'refno';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';

        protected $allowedFields = ['refno','idinstallation','issue','findings','solution',
        'converter','unitid','avl','image','remarks','Installer','created_at'];
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;
  
}