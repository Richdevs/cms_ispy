<?php

namespace app\Models;

use CodeIgniter\Model;

class accviewModel extends Model
{
    protected $table='viewAccessories';
    protected $allowedFields=['idaccess','regno','type',
    'unitserial','rfreader','immobilizer','con12v',
    'con24v','probe','ecan','created_at'
    ];
}