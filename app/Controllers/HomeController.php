<?php

namespace App\Controllers;

use App\Models\transModel;
use App\Models\unitModel;
use Config\Database;


class HomeController extends BaseController
{
    public function __Construct(){
        $this->db = Database::connect();
    }
    public function index()
    {
        $rows['count'] = $this->db->table('removals')->countAllResults();
        $rows['down'] = $this->db->table('accessories')->where(["accname" => 'RF-READER'])->countAllResults();
        $rows['changes'] = $this->db->table('transfers')->where(["change_type" => 'UNIT-CHANGE'])->countAllResults();
        //$builder=$this->db->table('archive_installation');
        $rows['archive']=$this->db->table('archive_installation')->countAllResults();
        $model = new unitModel();
        $rows['num'] = $model->countAll();


        $this->lineChart();
        //$this->donutChart();
        return view('admin_template/home', $rows);

    }
    public function lineChart(){
        $builder = $this->db->table('archive_installation');
        $query = $builder->select("COUNT(created_at) as count, YEAR(created_at) as year")->
        groupBy('year')->get();

        $record = $query->getResult();
        $installations = [];
        foreach($record as $row) {
            $installations[] = array(
                'year'   => $row->year,
                'count' => $row->count
            );
        }
        $builder=$this->db->table('accessories');
        $query=$builder->select("accname, COUNT(accname) as count")
            ->groupBy('accname')->get();
        $record=$query->getResult();
        $changes=[];
        foreach ($record as $row){
            $changes[]=array(
                'accname'=>$row->accname,
                'count'=>$row->count
            );
        }
        $data['transfer']=($changes);
        //return view('admin_template/home',$data);

        $data['installation'] = ($installations);
        return view('admin_template/home', $data);
    }

}