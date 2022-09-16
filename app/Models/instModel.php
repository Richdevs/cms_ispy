<?php

namespace app\Models;

use CodeIgniter\Model;

class instModel extends Model
{
    protected $table = 'inst_details';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'idinstallation', 'regno', 'device_type', 'device_serial', 'simcard', 'make', 'color',
        'clientname', 'subscription', 'username', 'warranty', 'image', 'createdat'
    ];
}
