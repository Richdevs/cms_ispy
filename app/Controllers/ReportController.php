<?php
namespace App\Controllers;

use app\Models\instReportModel;
use Config\Database;
require_once 'public/assets/vendor/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportController extends BaseController{
    public function __Construct()
    {
        $this->db = Database::connect();
    }
    public function index()
        {
            $rows['changes']=$this->db->table('transfers')->where('date(created_at)=curdate()')->countAllResults();
            $rows['count'] = $this->db->table('installation')->where('date(created_at)=curdate()')->countAllResults();
            $rows['users']=$this->db->table('users')->countAllResults();
            $rows['returns']=$this->db->table('returns')->countAllResults();
            $this->piechart();
            return view('admin_template/reports/report',$rows);
        }
        public function export(){
            $data=$this->db->table('inst_report')->where('date(created_at)=date(date_sub(now(),interval 1 day))')->get();
            $file_name='DailyInstallation.xlsx';
            $spreadsheet= new Spreadsheet();
            $sheet=$spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1','REGNO');
            $sheet->setCellValue('B1','UNITMODEL');
            $sheet->setCellValue('C1','SERIAL');
            $sheet->setCellValue('D1','SIMCARD');
            $sheet->setCellValue('E1','MAKE');
            $sheet->setCellValue('F1','COLOR');
            $sheet->setCellValue('G1','CLIENT');
            $sheet->setCellValue('H1','INSTALL DATE');

            $count=2;
            foreach ($data->getResult() as $row){
                $sheet->setCellValue('A'.$count,$row->regno);
                $sheet->setCellValue('B'.$count,$row->device_type);
                $sheet->setCellValue('C'.$count,$row->device_serial);
                $sheet->setCellValue('D'.$count,$row->simcard);
                $sheet->setCellValue('E'.$count,$row->make);
                $sheet->setCellValue('F'.$count,$row->color);
                $sheet->setCellValue('G'.$count,$row->clientname);
                $sheet->setCellValue('H'.$count,$row->created_at);
                $count++;
            }
            $writer=new Xlsx($spreadsheet);
            $writer->save($file_name);
            header("Content-Type:application/vnd.ms-excel");
            header('Content-disposition:attachment;filename="'.basename($file_name).'"');
            header('Expires: 0');
            header('Cache-Control:must-revalidate');
            header('pragma: public');
            flush();
            readfile($file_name);
            exit();

        }
        public function piechart(){
            $builder=$this->db->table('returns_details');
            $query=$builder->select("fault_type, COUNT(fault_type) as count")
                ->groupBy('fault_type')->get();
            $record=$query->getResult();
            $faults=[];
            foreach ($record as $row){
                $faults[]=array(
                    'fault_type'=>$row->fault_type,
                    'count'=>$row->count
                );
            }
            $data['faults']=($faults);

            return view('admin_template/reports/report', $data);
        }

    }