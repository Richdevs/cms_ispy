<?php

namespace App\Controllers;

use App\Models\faultModel;
use App\Models\instModel;
use App\Models\returns_viewModel;
use App\Models\returnsModel;
use Config\Database;

class ReturnsController extends BaseController
{
    public function __Construct()
    {
        require_once APPPATH . 'ThirdParty/ssp.class.php';

        $this->db = Database::connect();
    }
    public function index()
    {

        $model = new faultModel();
        $return = new returns_viewModel();
        $data['fault'] = $model->orderBy('fault_type', 'ASC')->findAll();
        $data['return'] = $return->findAll();
        return view('admin_template/quality/returns', $data);
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
    public function savefault()
    {
        if ($this->request->getMethod() == "post") {
            $model = new faultModel();


            if ($model->save(
                [
                    "fault_type" => $this->request->getPost("fault"),
                    "description" => $this->request->getPost("desc")
                ]
            )) {

                $data = ['status' => 'Saved Successfully'];
            };


            return $this->response->setJSON($data);
        }
    }
    public function delete($id)
    {
        // $id = $this->request->getVar("refno");
        $session = session(); //load session

        $model = new returnsModel();
        $model->delete($id);
        $session->setFlashdata("success", "Remote removed");

        return redirect()->to(base_url('return'));
    }
    public function insertReturn()
    {
        helper(['url']);
        if ($this->request->getMethod() == 'post') {
            $model = new returnsModel();
            $session = session();
            $data = [
                "device_serial" => $this->request->getVar("serial"),
                "fault_type" => $this->request->getVar("fault_type"),
                "image" => $this->upload(),
                "diagnosis" => $this->request->getVar("diagnosis"),
                "status" => $this->request->getVar("status"),
                "userid" => $this->request->getVar("userid")

            ];
            $rules = [
                'device_serial' => 'required',
                'fault_type' => 'required',
                'diagnosis' => 'required',
                'status' => 'required'
            ];
            $model->setValidationRules($rules);
            $errors = [
                'device_serial' => [
                    'required' => 'Device Type can\'t be empty'
                ],

                'diagnosis' => [
                    'required' => 'Diagnosis can\'t be empty'
                ]
            ];
            $model->setValidationMessages($errors);
            $dta = $this->index();
            if ($model->save($data) === false) {
                return view('admin_template/quality/returns', [$dta, 'errors' => $model->errors()]);
            } else {
                $session->setFlashdata("success", "Return added Successfully");
                return redirect()->to(base_url('return'));
            }
        }
        return view('admin_template/quality/returns');
    }
    public function search()
    {
        helper(['form', 'url']);
        $data = [];
        $builder = $this->db->table('inst_details');
        $query = $builder->like('device_serial', $this->request->getVar('q'))
            ->select('device_serial AS text')
            ->limit(10)->get();
        $data = $query->getResult();

        echo json_encode($data);
        //return view('admin_template/quality/returns',$data);
    }
    public function get_unit($id)
    {
        helper(['form']);
        $model = new instModel();
        $data['unit'] = $model->find($id);
        return $this->response->setJSON($data);
    }


    public function editReturn($id)
    {
        $model = new returns_viewModel();
        $data['returns'] = $model->find($id);
        //$data['cdata'] = $this->index();
        //return view('admin_template/clients',$data);
        return $this->response->setJSON($data['returns']);
    }
    public function viewReturn($id)
    {
        $model = new returnsModel();
        $data['returns'] = $model->find($id);
        //$data['cdata'] = $this->index();
        //return view('admin_template/clients',$data);
        return $this->response->setJSON($data['returns']);
    }

    public function update()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('returns');
        $return = new returnsModel();

        $session = session(); //load session
        $id = $this->request->getPost("id");
        $img_item = $return->find($id);
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
            "diagnosis" => $this->request->getVar("diagnosis"),
            "fault_type" => $this->request->getVar("fault_type"),
            "device_serial" => $this->request->getVar("serial"),
            "image" => $imageName,
            "status" => $this->request->getVar("status"),
        ];

        $builder->where('id', $id);


        if ($builder->update($data)) {
            $this->index();
            $session->setFlashdata("success", "Unit updated successfully");
        } else {
            $session->setFlashdata("fail", "Unit Not Updated");
        }
        // $this->index();
        // $session->setFlashdata("success", "Unit updated successfully");
        return redirect()->to(base_url('return'));
    }
    public function returnsTbl()
    {
        $dbDetails = array(
            "host" => $this->db->hostname,
            "user" => $this->db->username,
            "pass" => $this->db->password,
            "db" => $this->db->database,
        );

        $table = "returns_details";
        $primaryKey = "id";

        $columns = array(
            array(
                "db" => "id",
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
                "db" => "fault_type",
                "dt" => 4,
            ),
            array(
                "db" => "clientname",
                "dt" => 5,
            ),
            array(
                "db" => "status",
                "dt" => 6,
            ),

            array(
                "db" => "id",
                "dt" => 7,
                "formatter" => function ($id, $row) {
                    return "<div class='btn-group'>
                    <button class='btn btn-sm btn-success viewReturn'
      data-toggle='modal' data-target='#viewReturn'>View</button> &nbsp;&nbsp;
      <button class='btn btn-sm btn-info editReturn'
      data-toggle='modal' data-target='#editReturn'>Edit</button> &nbsp;&nbsp;
      <button class='btn btn-sm btn-danger delReturn'>Remove</button>
                         </div>";
                }
            ),
        );
        echo json_encode(
            \SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }
}
