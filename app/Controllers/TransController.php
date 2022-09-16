<?php

namespace App\Controllers;
use App\Models\clientModel;
use app\Models\instModel;
use App\Models\transModel;
use App\Models\transviewModel;
use App\Models\unitModel;
use http\Env\Response;
use Config\Database;

class TransController extends BaseController
{
    public function __Construct()
    {
        require_once APPPATH . 'ThirdParty/ssp.class.php';
        $this->db=Database::connect();
        
    }
    public function index(){
        $model=new transviewModel();
        $data['transfer']=$model->findAll();
        return view('admin_template/installations/transfer',$data);
    }
    public function update(){
        helper(['form','url']);
        if($this->request->getMethod()==='post') {
            $trans = new transModel();
            $session = session();
            $id=$this->request->getVar("idinstallation");
            $subscr=["subscription" => $this->request->getVar("subscription")
                ];
            $data =[
                "idinstallation" => $this->request->getVar("idinstallation"),
                "change_from" => $this->request->getVar("sSubscr"),
                "change_to" => $this->request->getVar("subscription"),
                "change_type" => $this->request->getVar("changeType"),
                "userid" => $this->request->getVar("userid")
            ];

            if ($trans->save($data) === false) {
                $session->setFlashdata("fail","Subscription update failed");
                return view('admin_template/installations/transfer');

            } else {
                $this->updateUnit($id,$subscr);
                $session->setFlashdata("success","Subscription updated");
                return redirect()->to(base_url('transfer'));
            }
        }
        $this->index();
            return view('admin_template/installations/transfer');

    }

public function updateUnit($id,$data){
    //$session = session(); //load session
    $db = Database::connect();
    $builder=$db->table('installation');
    $builder->where('idinstallation',$id);
    $builder->update($data);
    // $model = new unitModel();
    // $model->update($id,$data);

}

public function unitChange(){
    helper(['url']);
    if($this->request->getMethod()==='post') {
        $trans = new transModel();
        $session = session();
        $idinst=$this->request->getVar("idinstallation");
        $unitdata=["device_serial" => $this->request->getVar("newserial"),
            "device_type"=>$this->request->getVar("unitype")];
        $data =[
            "idinstallation" => $this->request->getVar("idinstallation"),
            "change_from" => $this->request->getVar("devserial"),
            "change_to" => $this->request->getVar("newserial"),
            "change_type" => $this->request->getVar("changeType"),
            "userid" => $this->request->getVar("userid")
        ];

        if ($trans->save($data) === false) {
            $session->setFlashdata("fail","Unit Change failed");
            return view('admin_template/installations/tranfer');

        } else {
            $this->updateUnit($idinst,$unitdata);
            $session->setFlashdata("success","Unit updated");
            return redirect()->to(base_url('transfer'));
        }
    }
    $this->index();
    return view('admin_template/installations/transfer');

}
//this method gets clientname from client model.
    public function getname($id){
        $model=new clientModel();
        $data=$model->find($id);
        return $data['clientname'];
    }
    public function clientChange(){
        helper(['url']);
        if($this->request->getMethod()==='post') {
            $trans = new transModel();
            $session = session();

            $idinst=$this->request->getVar("idinstallation");
            $idclient=["idclient" => $this->request->getVar("idclient")];
            $data =[
                "idinstallation" => $this->request->getVar("idinstallation"),
                "change_from" =>$this->getname($this->request->getVar("client")),
                "change_to" => $this->getname($this->request->getVar("idclient")),
                "change_type" => $this->request->getVar("changeType"),
                "userid" => $this->request->getVar("userid")
            ];

            if ($trans->save($data) === false) {
                $session->setFlashdata("fail","Subscription update failed");
                return view('admin_template/installations/transfer');

            } else {
                $this->updateUnit($idinst,$idclient);
                $session->setFlashdata("success","Subscription updated");
                return redirect()->to(base_url('transfer'));
            }
        }
        $this->index();
        return view('admin_template/installations/transfer');

    }
    public function transrecords($id){
        
        $model=new transviewModel();
        $data['change'] = $model->where('refno', $id)->find();
       
    
  return $this->response->setJSON($data['change']);
    
    }

    public function transferTbl()
    {
        $dbDetails = array(
            "host" => $this->db->hostname,
            "user" => $this->db->username,
            "pass" => $this->db->password,
            "db" => $this->db->database,
        );

        $table = "transview";
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
                "db" => "change_from",
                "dt" => 4,
            ),
            array(
                "db" => "change_to",
                "dt" => 5,
            ),
            array(
                "db" => "change_type",
                "dt" => 6,
            ),
            array(
                "db" => "userName",
                "dt" => 7,
            ),
            array(
                "db" => "created_at",
                "dt" => 8,
            ),
        
            array(
                "db" => "refno",
                "dt" =>9,
                "formatter" => function ($idclient, $row) {
                    return "<div class='btn-group'>
                    <button class='btn btn-success viewChanges' data-toggle='modal' data-target='#viewChange'>View</a>
                              
                         </div>";
                }
            ),
        );
        echo json_encode(
            \SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }
}