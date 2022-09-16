<?php

namespace App\Controllers;
require_once 'public/assets/vendor/vendor/autoload.php';
use App\Models\archiveModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Config\Database;

class DeviceExportController extends BaseController
{
    public function __Construc(){
        $this->db = Database::connect();
    }
    public function exportUnit(){
        $model=new archiveModel();
        $data=$model->findAll();
        $from=$this->request->getPost('datefrom');
        $to=$this->request->getpost('dateto');
       
        $file_name='TotalUnits.xlsx';
        $spreadsheet= new Spreadsheet();
        $sheet=$spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1','#');
        $sheet->setCellValue('B1','REGNO');
        $sheet->setCellValue('C1','UNITMODEL');
        $sheet->setCellValue('D1','SERIAL');
        $sheet->setCellValue('E1','SIMCARD');
        $sheet->setCellValue('F1','MAKE');
        $sheet->setCellValue('G1','COLOR');
        $sheet->setCellValue('H1','CLIENT');
        $sheet->setCellValue('J1','SUBSCRIPTION');
        $sheet->setCellValue('K1','INSTALLATION DATE');
        $count=2;
        foreach ($data as $row){
            $sheet->setCellValue('A'.$count,$row['idinstallation']);
            $sheet->setCellValue('B'.$count,$row['regno']);
            $sheet->setCellValue('C'.$count,$row['device_type']);
            $sheet->setCellValue('D'.$count,$row['device_serial']);
            $sheet->setCellValue('E'.$count,$row['simcard']);
            $sheet->setCellValue('F'.$count,$row['make']);
            $sheet->setCellValue('G'.$count,$row['color']);
            $sheet->setCellValue('H'.$count,$row['clientname']);
            $sheet->setCellValue('J'.$count,$row['subscription']);
            $sheet->setCellValue('K'.$count,$row['createdat']);
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
}
