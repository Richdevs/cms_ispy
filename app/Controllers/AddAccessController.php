<?php

namespace App\Controllers;

use App\Models\accessoryModel;
use App\Models\instModel;

use Config\Database;
use App\Models\userModel;

class AddAccessController extends BaseController
{
    public function __Construct()
    {
        require_once APPPATH . 'ThirdParty/ssp.class.php';
        $this->db = Database::connect();
    }
    public function index()
    {
        $model = new instModel();
        $data['unit'] = $model->orderBy('regno', 'ASC')->findAll();
        $data['units'] = $model->orderBy('regno', 'ASC')->findAll();
        $user = new userModel();
        $data['installer'] = $user->orderBy('userName', 'ASC')->where('designation', 'Installer')->findAll();
        $data['installers'] = $user->orderBy('userName', 'ASC')->where('designation', 'Installer')->findAll();
        return view('admin_template/newAccessory', $data);
    }
    public function insert()
    {
        helper(['url']);
        if ($this->request->getMethod() === 'post') {
            $model = new accessoryModel();
            $session = session(); //load session service
            $data = [
                "idInstallation" => $this->request->getVar("regno"),
                "avl" => $this->request->getVar("avl"),
                "converter" => $this->request->getVar("converter"),
                "probe" => $this->request->getVar("probe"),
                "ecan" => $this->request->getVar("ecan"),
                "immobilizer" => $this->request->getVar("immobilizer"),
                "converter" => $this->request->getVar("converter"),
                "extra" => $this->request->getVar("extra"),

                "installer" => $this->request->getVar("installer"),
                "created_at" => $this->request->getVar("insdate")
            ];
            $rules = [
                'idInstallation' => 'required',
                'installer' => 'required'
            ];
            $model->setValidationRules($rules);
            $errors = [
                'idInstallation' => [
                    'required' => 'Registration number can\'t be empty'
                ],
                'installer' => [
                    'required' => 'Installer is not selected'
                ],

            ];

            $model->setValidationMessages($errors);

            $dta = $this->index();

            if ($model->save($data) === false) {
                return view('admin_template/newAccessory', [
                    $dta,
                    'errors' => $model->errors()
                ]);
            } else {
                $session->setFlashdata("success", "Accessory added to Unit successfully");
                return redirect()->to(base_url('accss'));
            }
        }

        return view('admin_template/newAccessory');
    }
    public function delete()
    {
        $id = $this->request->getVar("regno");
        $session = session(); //load session

        $model = new accessoryModel();
        $model->delete($id);
        $session->setFlashdata("success", "Checkup Deleted");

        return redirect()->to(base_url('checkups'));
    }
    public function update()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('newAccessories');
        $session = session(); //load session
        $id = $this->request->getVar("refno");
        $data = [
            "idInstallation" => $this->request->getVar("regno"),
            "avl" => $this->request->getVar("avl"),
            "converter" => $this->request->getVar("converter"),
            "probe" => $this->request->getVar("probe"),
            "ecan" => $this->request->getVar("ecan"),
            "immobilizer" => $this->request->getVar("immobilizer"),
            "converter" => $this->request->getVar("converter"),
            "extra" => $this->request->getVar("extra"),
            "installer" => $this->request->getVar("installer"),
            "created_at" => $this->request->getVar("insdate")
        ];
        // $model = new accessoryModel();
        // $model->update($id, $data);
        $builder->where('refno', $id);
        $builder->update($data);
        $session->setFlashdata("success", "Accessory updated successfully");
        return redirect()->to(base_url('accss'));
    }
    public function edit($refno)
    {
        $model = new accessoryModel();
        $data['unit'] = $model->where('refno', $refno)->find();


        return $this->response->setJSON($data['unit']);
    }
    public function accviewTbl()
    {
        $dbDetails = array(
            "host" => $this->db->hostname,
            "user" => $this->db->username,
            "pass" => $this->db->password,
            "db" => $this->db->database,
        );

        $table = "accview";
        $primaryKey = "refno";
        $columns = array(
            array(
                "db" => "refno",
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
                "db" => "avl",
                "dt" => 4,
            ),
            array(
                "db" => "converter",
                "dt" => 5,
            ),
            array(
                "db" => "probe",
                "dt" => 6,
            ),

            array(
                "db" => "ecan",
                "dt" => 7,
            ),
            array(
                "db" => "immobilizer",
                "dt" => 8,
            ),
            array(
                "db" => "installer",
                "dt" => 9,
            ),
            array(
                "db" => "created_at",
                "dt" => 10,
            ),
            array(
                "db" => "refno",
                "dt" => 11,
                "formatter" => function ($refno, $row) {
                    return "<div class='btn-group'>
                   <button class='btn btn-sm btn-success editAccessory' data-toggle='modal' 
                   data-target='#editaccessory'>Edit</button>  
                  </div>";
                }
            ),
        );
        echo json_encode(
            \SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }
}
