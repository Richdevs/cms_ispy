<?php

namespace App\Controllers;

use App\Models\unitModel;
use App\Models\clientModel;
use App\Models\userModel;
use CodeIgniter\Files\File;

class AddUnitController extends BaseController
{
    public function index()
    {
        $model = new clientModel();
        $user=new userModel();
        $data['client'] = $model->orderBy('clientname', 'ASC')->findAll();
        $data['installer']=$user->orderBy('userName','ASC')->where('designation','Installer')->findAll();
        return view('admin_template/installations/units.php', $data);
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
            
            $newfile=$avatar->getRandomName();
           

            $avatar->move( ROOTPATH .'public/uploads', $newfile);

        }
        return $newfile;
    }
    public function addUnit()

    {

        helper(['form', 'url']);
        if ($this->request->getMethod() === 'post') {
            $model = new unitModel();
            $session = session(); //Load session Service
            $data = [
                "regno" => $this->request->getVar("regno"),
                "make" => $this->request->getVar("make"),
                "color" => $this->request->getVar("color"),
                "image" => $this->upload(),
                "client" => $this->request->getVar("idclient"),
                "subscription" => $this->request->getVar("subscription"),
                "device_type" => $this->request->getVar("device_type"),
                "device_serial" => $this->request->getVar("serial"),
                "warranty"=>$this->request->getvar("warranty"),
                "userid" => $this->request->getVar("userid"),
                "simcard" => $this->request->getVar("simcard"),
                "created_at" => $this->request->getVar("insdate"),
                "installer"=>$this->request->getVar("installer")

            ];

            $rules = [
                'regno' => 'required',
                'make' => 'required',
                'device_type' => 'required',
                'device_serial' => 'required',
                'simcard' => 'required',
                'color' => 'required',
                'warranty'=>'required',
                'subscription' => 'required',
                'client' => 'required',
                'device_serial' => 'required',
                'installer'=>'required'

            ];
            $model->setValidationRules($rules);
            $dta = $this->index();
            $errors = [
                'regno' => [
                    'required' => 'Registration can\'t be empty'
                ],
                'make' => [
                    'required' => 'vehicle make can\'t be empty'
                ],
                'device_type' => [
                    'required' => 'Device type is not selected'
                ],
                'device_serial' => [
                    'required' => 'Serial number can\'t be empty'
                ],
                'simcard' => [
                    'required' => 'Simcard number can\'t be empty'
                ],
                'warranty' => [
                    'required' => 'Select Warranty'
                ],

                'color' => [
                    'required' => 'vehicle color can\'t be empty'
                ],
                'subscription' => [
                    'required' => 'Subscription is not selected'
                ],
                'client' => [
                    'required' => 'Company is not selected'
                ],
                'installer' => [
                    'required' => 'Select Installer'
                ],
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
    }
}
