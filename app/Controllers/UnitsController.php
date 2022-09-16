<?php

namespace App\Controllers;

use App\Models\clientModel;
use App\Models\instModel;
use App\Models\transModel;
use App\Models\unitModel;
use App\Models\userModel;
use CodeIgniter\CLI\Console;
use Config\Database;

class UnitsController extends BaseController
{
    public function __Construct()
    {
        require_once APPPATH . 'ThirdParty/ssp.class.php';
        $this->db = Database::connect();
    }
    private function removeImage($id)
    {
        // $id=$this->request->getVar('idinstallation');
        $model = new instModel();
        $data = $model->find($id);
        $imagefile = $data['image'];

        unlink('public/images/' . $imagefile);
        $response = ['status' => 'Image Removed Successfully'];



        return $this->response->setJSON($response);
    }
    private function upload()
    {
        helper(['form', 'url']);
        $session = session(); //Load session Service


        $validated = $this->validate([
            'file' => [
                'uploaded[imagePath]',
                'mime_in[imagePath,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[imagePath,4096]',
            ],
        ]);

        $msg = 'Please select a valid file';
        //$session->setFlashdata("fail", $msg);

        if ($validated) {
            $avatar = $this->request->getFile('imagePath');

            $newfile = $avatar->getRandomName();


            $avatar->move(WRITEPATH . 'public/images', $newfile);
        }
        return $newfile;
    }
    public function index()
    {

        $model = new instModel();
        $user = new userModel();
        $data['installation'] = $model->findAll();
        $model = new clientModel();
        $data['installer'] = $user->orderBy('userName', 'ASC')->where('designation', 'Installer')->findAll();
        $data['client'] = $model->orderBy('clientname', 'ASC')->findAll();
        return view('admin_template/installations/units', $data);
    }

    public function insert()
    {
        helper(['form', 'url']);
        if ($this->request->getMethod() === 'post') {
            $model = new unitModel();
            $session = session(); //load session service
            $data = [
                "regno" => $this->request->getVar("regno"),
                "device_type" => $this->request->getVar("device_type"),
                "device_serial" => $this->request->getVar("device_serial"),
                "simcard" => $this->request->getVar("simcard"),
                "make" => $this->request->getVar("make"),
                "color" => $this->request->getVar("color"),
                "client" => $this->request->getVar("idclient"),
                "subscription" => $this->request->getVar('subscription'),
                "Installer" => $this->request->getVar("installer"),
                "userid" => $this->request->getVar('userid')
            ];
            $rules = [
                'regno' => 'required',
                'device_type' => 'required',
                'device_serial' => 'required',
                'simcard' => 'required',
                'make' => 'required',
                'color' => 'required',
                'subscription' => 'required',
                'Installer' => 'required',
                'idclient' => 'required'
            ];
            $model->setValidationRules($rules);
            $errors = [
                'regno' => [
                    'required' => 'Registration can\'t be empty'
                ],
                'device_type' => [
                    'required' => 'Device type is not selected'
                ],
                'device_serial' => [
                    'required' => 'Serial number can\'t be empty',
                ],
                'simcard' => [
                    'required' => 'Simcard number can\'t be empty'
                ],
                'make' => [
                    'required' => 'vehicle make can\'t *be* empty'
                ],
                'color' => [
                    'required' => 'vehicle color can\'t be empty'
                ],
                'subscription' => [
                    'required' => 'vehicle make can\'t be empty'
                ],
                'Installer' => [
                    'required' => 'Select Installer'
                ],
                'idclient' => [
                    'required' => 'Company is not selected'
                ]
            ];

            $model->setValidationMessages($errors);

            $dta = $this->index();

            if ($model->save($data) === false) {
                return view('admin_template/installations/units', [
                    $dta,
                    'errors' => $model->errors()
                ]);
            } else {
                $session->setFlashdata("success", "Unit added successfully");
                return redirect()->to(base_url('units'));
            }
        }

        return view('admin_template/installations/units');
    }
    public function viewUnit($idinstallation)
    {
        $model = new instModel();
        $data['unit'] = $model->where('idinstallation', $idinstallation)->find();
        $this->index();
        //$data['unit'] = $model->first($idinstallation);

        return $this->response->setJSON($data['unit']);
    }
    public function edit($idinstallation)
    {
        $model = new unitModel();
        $data['unit'] = $model->where('idinstallation', $idinstallation)->find();
        $data['units'] = $this->index();
        //$data['unit'] = $model->first($idinstallation);

        return $this->response->setJSON($data['unit']);
    }
    public function update()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('active_installation');
        $image = new unitModel();

        $session = session(); //load session
        $id = $this->request->getPost("unitid");
        $img_item = $image->find($id);
        $file = $this->request->getFile('imagePath');
        $path =  ROOTPATH . "public/uploads/";
        if ($file->isValid() && !$file->hasMoved()) {
            $old_image = $img_item['image'];
            if (file_exists($path . $old_image) && !is_dir($path . $old_image)) {

                unlink($path . $old_image);
            }
            $imageName = $file->getRandomName();
            $file->move($path, $imageName);
        } else {
            $imageName = $img_item['image'];
        }
        $data = [
            "regno" => $this->request->getVar("regno"),
            "device_type" => $this->request->getVar("device_type"),
            "device_serial" => $this->request->getVar("serial"),
            "image" => $imageName,
            "simcard" => $this->request->getVar("simcard"),
            "make" => $this->request->getVar("make"),
            "color" => $this->request->getVar("color"),
            "client" => $this->request->getVar("idclient"),
            "userid" => $this->request->getVar("userid"),
            "created_at" => $this->request->getvar("insdate"),
            "subscription" => $this->request->getVar("subscription"),
            "warranty" => $this->request->getVar("warranty"),
            "installer" => $this->request->getVar("installer")

        ];

        $builder->where('idinstallation', $id);


        if ($builder->update($data)) {
            $this->index();
            $session->setFlashdata("success", "Unit updated successfully");
        } else {
            $session->setFlashdata("fail", "Unit Not Updated");
        }
        // $this->index();
        // $session->setFlashdata("success", "Unit updated successfully");
        return redirect()->to(base_url('units'));
    }
    public function delete($idinstallation)
    {
        // $id = $this->request->getVar("refno");
        $session = session(); //load session

        $model = new unitModel();
        $model->delete($idinstallation);
        $session->setFlashdata("success", "Unit removed");

        return redirect()->to(base_url('units'));
    }
    public function rmImage($id)
    {
        $model = new unitModel();
        $unit = $model->find($id);
        $img = $unit['image'];
        if (file_exists('public/images/' . $img)) {
            unlink('public/images/' . $img);
        }
        $data = ["image" => ""];
        $model->update($id, $data);

        return redirect()->to(base_url('units'))->with('status', 'Image Removed');
    }

    public function unitsTbl()
    {
        $dbDetails = array(
            "host" => $this->db->hostname,
            "user" => $this->db->username,
            "pass" => $this->db->password,
            "db" => $this->db->database,
        );

        $table = "inst_details";
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
                   
        <button class='btn btn-sm btn-dark deleteUnit'>Remove</button>
                         </div>";
                }
            ),
        );
        echo json_encode(
            \SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }
}
