<?php

namespace App\Controllers;

use App\Models\clientModel;
use App\Models\instModel;
use App\Models\transModel;
use App\Models\unitModel;
use CodeIgniter\CLI\Console;

class UnitsController extends BaseController
{
    public function index()
    {

        $model = new instModel();
        $data['installation'] = $model->findAll();
        $model = new clientModel();
        $data['client'] = $model->orderBy('clientname', 'ASC')->findAll();
        return view('admin_template/installations/units', $data);
    }

    public function getUnits()
    {
        $request = service('request');
        $postData = $request->getPost();
        $dtpostData = $postData['data'];
        $response = array();

        // Read Value
        $draw = $dtpostData['draw'];
        $start = $dtpostData['start'];
        $rowperpage = $dtpostData['length']; // Rows display per page
        $columnIndex = $dtpostData['order'][0]['column']; // Column index
        $columnName = $dtpostData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $dtpostData['order'][0]['dir']; // asc or desc
        $searchValue = $dtpostData['search']['value']; // Search value

        //Total Number of records without filtering

        $units = new instModel();
        $totalRecords = $units->select('idinstallation')->countAllResults();

        //Total Number of records with filtering
        $totalRecordwithFilter = $units->select('idinstallation')
            ->orLike('regno', $searchValue)
            ->orLike('clientname', $searchValue)
            ->countAllResults();
        //fetch Records
        $response=array();
        $records = $units->select('*')
            ->orLike('clientname', $searchValue)
            ->orLike('regno', $searchValue)
            ->orderBy($columnName,$columnSortOrder)
            ->findAll($rowperpage,$start);
        $data = array();
        
      



        foreach ($records as $record) {
            $data[] = array(
               
                "idinstallation"=>$record['idinstallation'],
                "regno" => $record['regno'],
                "clientname" => $record['clientname'],
                
               
                
            );
        }
        //response
        $response=array(
            "draw" => intval($draw),
          "iTotalRecords" => $totalRecords,
          "iTotalDisplayRecords" => $totalRecordwithFilter,
          "aaData" => $data,
          "token" => csrf_hash() // New token hash
       );
        return $this->response->setJSON($response);
    }
}
