<?php

namespace App\Controllers;

use App\Models\clientModel;
use App\Models\returns_viewModel;
use App\Models\returnsModel;
use CodeIgniter\Session\Session;
use Config\Database;


class ClientController extends BaseController
{
    public function __Construct()
    {
        require_once APPPATH . 'ThirdParty/ssp.class.php';
        $this->db = Database::connect();
    }

    public function index()
    {
        $model = new clientModel();
        $data['cdata'] = $model->findAll();
        return view('admin_template/clients', $data);
    }
    //    public function getclient(){
    //        $model=new clientModel();
    //        $data['cdata']=$model->findAll();
    //        return view('admin_template/clients', $data);
    //
    //    }


    public function insert()
    {
        helper(['url']);
        if ($this->request->getMethod() === 'post') {
            //$cmodel =new clientModel();
            $model = new clientModel();
            $session = session(); //load session service
            $data = [
                "clientname" => $this->request->getVar("clientname"),
                "contactperson" => $this->request->getVar("contactperson"),
                "phone" => $this->request->getVar("phone"),
                "email" => $this->request->getVar("email")
            ];
            $rules = [
                'clientname' => 'required|min_length[5]',
                'contactperson' => 'required',
                'phone' => 'required',
                'email' => 'required|valid_email'
            ];
            $model->setValidationRules($rules);
            $errors = [
                'clientname' => [
                    'required' => 'Name is required',
                    'min_length' => 'minimum length of name should be 5 chars'
                ],
                'contactperson' => [
                    'required' => ' Contact person\'s name is required'
                ],
                'phone' => [
                    'required' => 'Phone is required',
                ],
                'email' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Email is not valid'
                ]
            ];

            $model->setValidationMessages($errors);


            if ($model->save($data) === false) {
                //$this->index();
                return view('admin_template/clients', [
                    $this->index(),
                    'errors' => $model->errors()
                ]);
            } else {
                $session->setFlashdata("success", "Client added successfully");
                return redirect()->to(base_url('client'));
            }
        }
        $this->index();
        return view('admin_template/clients');
    }

    public function edit($idclient)
    {
        $model = new clientModel();
        $data['client'] = $model->find($idclient);
        $data['cdata'] = $this->index();
        //return view('admin_template/clients',$data);
        return $this->response->setJSON($data['client']);
    }

    public function Update($idclient)
    {
        $model = new clientModel();
        $session = Session();
        $data = [
            "clientname" => $this->request->getVar("clientname"),
            "contactperson" => $this->request->getVar("contactperson"),
            "phone" => $this->request->getVar("phone"),
            "email" => $this->request->getVar("email")
        ];
        if ($model->update($idclient, $data) == true) {
            $session->setFlashdata("success", "Client update successfully");
            return redirect()->to(base_url('client'));
        };

        $session->setFlashdata("success", "Client update successfully");
        return redirect()->to(base_url('client'));
    }
    public function del($id)
    {
        $model = new clientModel();
        $session = Session();
        $data['cdata'] = $this->index();
        // $model->where('idclient', $id)->delete();
        if ($model->delete($id) == true) {
            $session->setFlashdata("Success", "Client deleted Successfully");
            return view('admin_template/clients', $data);
        }
        // $data['cdata'] = $this->index();

        return redirect()->to(base_url('client'));
    }

    
    public function clientsTbl()
    {
        $dbDetails = array(
            "host" => $this->db->hostname,
            "user" => $this->db->username,
            "pass" => $this->db->password,
            "db" => $this->db->database,
        );

        $table = "clients";
        $primaryKey = "idclient";

        $columns = array(
            array(
                "db" => "idclient",
                "dt" => 0,
            ),
            array(
                "db" => "clientname",
                "dt" => 1,
            ),
            array(
                "db" => "contactperson",
                "dt" => 2,
            ),
            array(
                "db" => "phone",
                "dt" => 3,
            ),
            array(
                "db" => "email",
                "dt" => 4,
            ),
            array(
                "db" => "created_at",
                "dt" => 5,
            ),
            
            array(
                "db" => "idclient",
                "dt" =>6 ,
                "formatter" => function ($idclient, $row) {
                    return "<div class='btn-group'>
                    <button class='btn btn-sm btn-info viewClient'
                    data-toggle='modal' data-target='#viewClient'>View</button> &nbsp;
                    <button class='btn btn-sm btn-danger delClient'
                    >Delete</button>
                         </div>";
                }
            ),
        );
        echo json_encode(
            \SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }
}
