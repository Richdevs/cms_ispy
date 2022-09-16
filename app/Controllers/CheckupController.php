<?php

namespace App\Controllers;

use App\Models\instModel;
use App\Models\checkupModel;
use App\Models\userModel;

use CodeIgniter\HTTP\Request;
use Config\Database;

class CheckupController extends BaseController
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
        return view('admin_template/quality/checkups', $data);
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


            $avatar->move(ROOTPATH . 'public/uploads', $newfile);
        }
        return $newfile;
    }
    public function update()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('newCheckup');
        $session = session(); //load session
        $id = $this->request->getVar("refno"); 
        $image= new checkupModel();
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
            "idinstallation" => $this->request->getVar("regno"),
            "issue" => $this->request->getVar("issue"),
            "findings" => $this->request->getVar("findings"),
            // "userid" => $this->request->getVar('userid'),
            "solution" => $this->request->getVar("solution"),
            "Installer" => $this->request->getVar("installer"),
            "converter" => $this->request->getVar("converter"),
            "created_at" => $this->request->getVar('chkdate'),
            "unitid" => $this->request->getVar('uid'),
            "avl"=> $this->request->getVar('avl'),
            "remarks" => $this->request->getVar('remarks'),
            "image"=>$imageName
        ];
        // $model = new accessoryModel();
        // $model->update($id, $data);
        $builder->where('refno', $id);
        $builder->update($data);
        $session->setFlashdata("success", "Checkup updated successfully");
        return redirect()->to(base_url('checkups'));
    }
    public function addCheckup()
    {
        helper(['form', 'url']);
        if ($this->request->getMethod() === 'post') {
            $model = new checkupModel();
            $session = session(); //load session service
            $data = [
                "idinstallation" => $this->request->getVar("regno"),
                "issue" => $this->request->getVar("issue"),
                "findings" => $this->request->getVar("findings"),
                // "userid" => $this->request->getVar('userid'),
                "solution" => $this->request->getVar("solution"),
                "Installer" => $this->request->getVar("installer"),
                "converter" => $this->request->getVar("converter"),
                "created_at" => $this->request->getVar('chkdate'),
                "unitid" => $this->request->getVar('uid'),
                "avl"=> $this->request->getVar('avl'),
                "remarks" => $this->request->getVar('remarks'),
                "image"=> $this->upload()
            ];
            $rules = [
                'idinstallation' => 'required',
                'issue' => 'required'
             


            ];
            $model->setValidationRules($rules);
            $errors = [
                'idinstallation' => [
                    'required' => 'Registration can\'t be empty'
                ],
                'issue' => [
                    'required' => 'Issue can\'t be empty'
                ],
               

            ];

            $model->setValidationMessages($errors);
            $dta[] = $this->index();
            if ($model->save($data) === false) {
                return view('admin_template/quality/checkups', [
                    $dta,
                    'errors' => $model->errors()
                ]);
            } else {
                $session->setFlashdata("success", "checkup added successfully");
                return redirect()->to(base_url('checkups'));
            }
        }

        return view('admin_template/quality/checkups');
    }

    
    public function edit($refno)
    {
        $model = new checkupModel();
        $data['unit'] = $model->where('refno', $refno)->find();
        $this->index();
        //$data['unit'] = $model->first($idinstallation);

        return $this->response->setJSON($data['unit']);
    }
    public function delete($refno)
    {
       // $id = $this->request->getVar("refno");
        $session = session(); //load session

        $model = new checkupModel();
        $model->delete($refno);
        $session->setFlashdata("success", "Checkup Deleted");

        return redirect()->to(base_url('checkups'));
    }
   
    public function checkupsTbl()
    {
        $dbDetails = array(
            "host" => $this->db->hostname,
            "user" => $this->db->username,
            "pass" => $this->db->password,
            "db" => $this->db->database,
        );

        $table = "checkupView";
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
                "db" => "client",
                "dt" => 2,
            ),
            array(
                "db" => "issue",
                "dt" => 3,
            ),
            array(
                "db" => "findings",
                "dt" => 4,
            ),
            array(
                "db" => "solution",
                "dt" => 5,
            ),
            array(
                "db" => "converter",
                "dt" => 6,
            ),
            array(
                "db" => "unitid",
                "dt" => 7,
            ),
            array(
                "db" => "avl",
                "dt" => 8,
            ),
            array(
                "db" => "created_at",
                "dt" => 9,
            ),
            array(
                "db" => "refno",
                "dt" => 10,
                "formatter" => function ($refno, $row) {
                    return "<div class='btn-group'>
                    <button class='btn btn-sm btn-info viewChk'
                    data-toggle='modal' data-target='#editCheckup'>Edit</button>&nbsp;&nbsp;
                   <button class='btn btn-sm btn-danger delCheckup'>Delete</button>  
                  </div>";
                }
            ),
        );
        echo json_encode(
            \SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }
}
