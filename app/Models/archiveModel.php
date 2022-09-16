<?php

namespace app\Models;

use CodeIgniter\Model;

class archiveModel extends Model
{
    protected $table = 'archiveView';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'idinstallation', 'regno', 'device_type', 'device_serial', 'simcard', 'make', 'color',
        'clientname', 'subscription', 'username', 'warranty', 'image', 'createdat'
    ];
}
