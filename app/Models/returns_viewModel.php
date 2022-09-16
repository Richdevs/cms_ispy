<?php
namespace App\Models;
use CodeIgniter\Model;

class returns_viewModel extends Model{
    protected $table = 'returns_details';
    protected $allowedFields = ['regno','device_type','device_serial','clientname','fault_type','diagnosis','status','userid'];


}