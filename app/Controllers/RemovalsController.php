<?php

namespace App\Controllers;

use App\Models\clientModel;
use App\Models\removalsModel;
use App\Models\rem;
use App\Models\unitModel;
use App\Models\userModel;
use CodeIgniter\CLI\Console;
use Config\Database;

class RemovalsController extends BaseController
{
    public function __Construct()
    {
        require_once APPPATH . 'ThirdParty/ssp.class.php';
        $this->db = Database::connect();
    }
    public function index()
    {

     
        return view('admin_template/installations/removals');
    }

    public function viewUnit($idinstallation)
    {
        $model = new removalsModel();
        $data['unit'] = $model->where('idinstallation', $idinstallation)->find();
        
        return $this->response->setJSON($data['unit']);
    }
    public function restore($idinstallation)
    {
        // $id = $this->request->getVar("refno");
        $session = session(); //load session

        $model = new rem();
        $model->delete($idinstallation);
        $session->setFlashdata("success", "Unit Restored");

        return redirect()->to(base_url('removals'));
    }
    public function removalsTbl()
    {
        $dbDetails = array(
            "host" => $this->db->hostname,
            "user" => $this->db->username,
            "pass" => $this->db->password,
            "db" => $this->db->database,
        );

        $table = "removalsView";
        $primaryKey = "idinstallation";
        $columns = array(
            array(
                "db" => "idinstallation",
                "dt" => 0,
            ),
            array(
                "db" => "regno",
                "dt" => 1,
            ),
            array(
                "db" => "device_type",
                "dt" => 2,
            ),
            array(
                "db" => "device_serial",
                "dt" => 3,
            ),
            array(
                "db" => "clientname",
                "dt" => 4,
            ),
            array(
                "db" => "subscription",
                "dt" => 5,
            ),
            array(
                "db" => "installer",
                "dt" => 6,
            ),


            array(
                "db" => "idinstallation",
                "dt" => 7,
                "formatter" => function ($idinstallation, $row) {
                    return "<div class='btn-group'>
                    <button class='btn btn-sm btn-info view_Unit'
                    data-toggle='modal' data-target='#viewUnit'>View</button> &nbsp;
                   
        <button class='btn btn-sm btn-success restoreUnit'>Restore</button>
                         </div>";
                }
            ),
        );
        echo json_encode(
            \SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }
}