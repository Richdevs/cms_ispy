<?php
namespace app\Models;

use CodeIgniter\Model;

class instReportModel extends Model
{
    protected $table='inst_report';
    protected $allowedFields=['regno','device_type','device_serial','make','color',
        'clientname','created_at'
    ];
}