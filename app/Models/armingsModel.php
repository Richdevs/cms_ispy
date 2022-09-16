<?php

namespace App\Models;

use CodeIgniter\Model;

class armingsModel extends Model

    {
        protected $table='armings';
      
        // protected $beforeInsert=['beforeInsert'];

        protected $allowedFields =['truckno','sealno','ownership','cargo','clamped','company','loadingzone','destination'];
    

        // protected function beforeInsert(array $data){
        //     $data['data']['created_at'] = date('Y-m-d H:i:s');

        //     return $data;
        // }


    }


