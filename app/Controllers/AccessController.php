<?php

namespace App\Controllers;

use App\Models\accModel;
use App\Models\accviewModel;
use App\Models\unitModel;
use Config\Database;
use App\Models\userModel;

class AccessController extends BaseController
{
    public function __Construct()
    {
        require_once APPPATH . 'ThirdParty/ssp.class.php';
        $this->db = Database::connect();
    }


    public function  index(){

        $model=new accviewModel();
        $user= new userModel();
        $data['accessory']=$model->findAll();
        $model=new unitModel();
        $data['unit']=$model->orderBy('device_serial','ASC')->findAll();
        $data['installer']=$user->orderBy('userName','ASC')->where('designation','Installer')->findAll();
        return view('admin_template/accessories',$data);
    }
    public function insert(){
        helper(['url']);
        if ($this->request->getMethod() === 'post') {
            $model = new accModel();
            $session = session(); //load session service
            $data = [
                "accserial" => $this->request->getVar("accserial"),
                "accname" => $this->request->getVar("accname"),
                "description" => $this->request->getVar("description"),
                "device_serial" => $this->request->getVar("idinstallation"),
                "Installer" => $this->request->getVar("installer")
            ];
            $rules = [
                'accserial' => 'required',
                'accname' => 'required',
                'description' => 'required',
                'device_serial' => 'required',
                'Installer' => 'required'
            ];
            $model->setValidationRules($rules);
            $errors = [
                'accserial' => [
                    'required' => 'Serial can\'t be empty'
                ],
                'accname' => [
                    'required' => 'Accessory is not selected'
                ],
                'device_serial'=>[
                    'required'=>'Select Registration Number'
                ],
                'Installer'=>[
                    'required'=>'Select Installer'
                ]
            ];

            $model->setValidationMessages($errors);

            $dta=$this->index();

            if ($model->save($data) === false) {
                return view('admin_template/accessories',[$dta,
                    'errors' => $model->errors()]);
            } else {
                $session->setFlashdata("success", "Accessory added to Unit successfully");
                return redirect()->to(base_url('accessories'));
            }
        }

        return view('admin_template/accessories');
    }
    public function delete($idaccess)
    {
       // $id = $this->request->getVar("refno");
        $session = session(); //load session

        $model = new accModel();
        $model->delete($idaccess);
        $session->setFlashdata("success", "Accessory removed");

        return redirect()->to(base_url('accessories'));
    }
    public function accessoryTbl()
    {
        $dbDetails = array(
            "host" => $this->db->hostname,
            "user" => $this->db->username,
            "pass" => $this->db->password,
            "db" => $this->db->database,
        );

        $table = "viewAccessories";
        $primaryKey = "idaccess";
        $columns = array(
            array(
                "db" => "idaccess",
                "dt" => 0,
            ),
            array(
                "db" => "regno",
                "dt" => 1,
            ),
            array(
                "db" => "type",
                "dt" => 2,
            ),
            array(
                "db" => "unitserial",
                "dt" => 3,
            ),
            array(
                "db" => "rfreader",
                "dt" => 4,
            ),
            array(
                "db" => "immobilizer",
                "dt" => 5,
            ),
            array(
                "db" => "conv",
                "dt" => 6,
            ),
        
            array(
                "db" => "probe",
                "dt" => 7,
            ),
            array(
                "db" => "ecan",
                "dt" => 8,
            ),
            array(
                "db" => "idaccess",
                "dt" => 9,
                "formatter" => function ($idaccess, $row) {
                    return "<div class='btn-group'>
                   <button class='btn btn-sm btn-info 'data-toggle='modal' 
                   data-target='#editAcc'>View</button>  
                  </div>";
                }
            ),
        );
        echo json_encode(
            \SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }
    public function viewAccTbl()
    {
        $dbDetails = array(
            "host" => $this->db->hostname,
            "user" => $this->db->username,
            "pass" => $this->db->password,
            "db" => $this->db->database,
        );

        $table = "inst_accessories";
        $primaryKey = "idaccess";
        $columns = array(
            array(
                "db" => "idaccess",
                "dt" => 0,
            ),
            array(
                "db" => "regno",
                "dt" => 1,
            ),
            array(
                "db" => "device_serial",
                "dt" => 2,
            ),
            array(
                "db" => "accname",
                "dt" => 3,
            ),
            array(
                "db" => "installer",
                "dt" => 4,
            ),
            array(
                "db" => "created_at",
                "dt" => 5,
            ),
          
            array(
                "db" => "idaccess",
                "dt" => 6,
                "formatter" => function ($idaccess, $row) {
                    return "<div class='btn-group'>
                   <button class='btn btn-sm btn-danger delacc'>Delete</button>  
                  </div>";
                }
            ),
        );
        echo json_encode(
            \SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }

}