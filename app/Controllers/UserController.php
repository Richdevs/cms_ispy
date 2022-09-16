<?php

namespace App\Controllers;

use App\Models\userModel;
use CodeIgniter\Session\Session;
use Config\Database;

class UserController extends BaseController
{
    public function __Construct()
    {
        require_once APPPATH . 'ThirdParty/ssp.class.php';
        $this->db = Database::connect();
    }

    public function index()
    {
        $data = [];
        helper(['form']);
        if ($this->request->getMethod() == 'post') {

            $rules = [
                'email' => 'required|valid_email',
                'pwd' => 'required|min_length[5]|validateUser[email,pwd]',
            ];

            $errors = [
                'email' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Enter a valid email'
                ],
                'pwd' => [
                    'required' => 'Password cannot be empty',
                    'min_length' => 'minimum length of password should be 5 chars',
                    'validateUser' => 'Email or Password don\'t match'
                ]
            ];
            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
            } else {
                $model = new UserModel();

                $user = $model->where('email', $this->request->getVar('email'))
                    ->first();

                $this->setUserSession($user);

                return redirect()->to('home');
            }
            echo view('admin_template/auth/login', $data);
        }

        return view('admin_template/auth/login');
    }
    private function setUserSession($user)
    {
        $data = [
            'userid' => $user['userid'],
            'userName' => $user['userName'],
            'email' => $user['email'],
            'isLoggedIn' => true
        ];

        session()->set($data);
        return true;
    }


    public function getData()
    {
        $model = new userModel();
        $data['userData'] = $model->findAll();
        return view('admin_template/users/users', $data);
    }


    public function insert()
    {
        helper(['url']);
        if ($this->request->getMethod() == 'post') {
            $model = new userModel();
            $session = session(); //load session service
            $data = [
                "userName" => $this->request->getVar("userName"),
                "email" => $this->request->getVar("email"),
                "slocation" => $this->request->getVar("slocation"),
                "designation" => $this->request->getVar("designation"),
                "pwd" => $this->request->getVar("pwd"),
                "cpwd" => $this->request->getVar("cpwd")
            ];
            $rules = [
                'userName' => 'required|min_length[5]|max_length[100]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'slocation' => 'required',
                'designation' => 'required',
                'pwd' => 'required|min_length[5]|alpha_numeric',
                'cpwd' => 'required|matches[pwd]'
            ];
            $model->setValidationRules($rules);
            $errors = [
                'userName' => [
                    'required' => 'Name is required',
                    'min_length' => 'minimum length of name should be 5 chars',
                    'max_length' => 'maximum length of name should be 5 chars'
                ],
                'email' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Enter a valid email',
                    'is_unique' => 'Email already exists'
                ],
                'slocation' => [
                    'required' => 'Location not selected',
                ],
                'designation' => [
                    'required' => 'Designation not selected',
                ],
                'pwd' => [
                    'required' => 'Password cannot be empty',
                    'min_length' => 'minimum length of password should be 5 chars',
                    'alpha_numeric' => 'password should contain alpha-numeric characters'
                ],
                'cpwd' => [
                    'required' => 'Confirm password cannot be empty',
                    'matches' => ' Confirm password does not match'
                ]
            ];
            $model->setValidationMessages($errors);

            $isdata = $this->getData();

            if ($model->save($data) === false) {
                return view(
                    'admin_template/users/users',
                    [$isdata, 'errors' => $model->errors()]
                );
            } else {
                $session->setFlashdata("success", "User added successfully");
                return redirect()->to(base_url('user'));
            }
        }

        return view('admin_template/users/users');
    }
    public function edit($userid)
    {
        $data['UserData'] = $this->getData();
        $model = new userModel();
        $data['user'] = $model->find($userid);

        return $this->response->setJSON($data['user']);
        //return view('admin_template/users/users',$data);
    }
    public function delete($id)
    {
        // $id = $this->request->getVar("refno");
        $session = session(); //load session

        $model = new userModel();
        $model->delete($id);
        $session->setFlashdata("success", "User removed");

        return redirect()->to(base_url('user'));
    }

    public function update()
    {

        $session = session(); //load session
        $id = $this->request->getVar("userId");
        $data = [
            "userName" => $this->request->getVar("userName"),
            "email" => $this->request->getVar("email"),
            "slocation" => $this->request->getVar("slocation"),
            "designation" => $this->request->getVar("designation"),
            "pwd" => $this->request->getVar("pwd"),
            "cpwd" => $this->request->getVar("cpwd")
        ];
        $model = new userModel();
        $model->update($id, $data);
        $session->setFlashdata("success", "User updated successfully");
        return redirect()->to(base_url('user'));
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }

    public function usersTbl()
    {
        $dbDetails = array(
            "host" => $this->db->hostname,
            "user" => $this->db->username,
            "pass" => $this->db->password,
            "db" => $this->db->database,
        );

        $table = "users";
        $primaryKey = "userid";

        $columns = array(

            array(
                "db" => "userid",
                "dt" => 0,
            ),
            array(
                "db" => "userName",
                "dt" => 1,
            ),
            array(
                "db" => "email",
                "dt" => 2,
            ),
            array(
                "db" => "slocation",
                "dt" => 3,
            ),
            array(
                "db" => "designation",
                "dt" => 4,
            ),
            array(
                "db" => "created_at",
                "dt" => 5,
            ),

            array(
                "db" => "userid",
                "dt" => 6,
                "formatter" => function ($idclient, $row) {
                    return "<div class='btn-group'>
                    <button class='btn btn-sm btn-info editUser'
                    data-toggle='modal' data-target='#editUserProfile'>Edit</button> &nbsp;&nbsp;
                    <button class='btn btn-sm btn-danger delUser'>Remove</button>
                    </div>";
                }
            ),
        );
        echo json_encode(
            \SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }
}
            