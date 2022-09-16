<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use app\Models\instModel;

require_once 'public/assets/vendor/vendor/autoload.php';

use App\Models\transviewModel;
// Import Excel Package
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ChangesController extends BaseController
{

	public function setcolumn($changes)
	{
		// $change= new transModel();

		//$changes= $change->findAll();
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		foreach ($changes as $val) {
			if ($val['change_type'] == 'DOWNGRADE' || 'UPGRADE') {

				$column = "SUBSCRIPTION";
			}
			if ($val['change_type'] == 'UNIT-CHANGE') {
				$column = "UNIT";
			}
			if ($val['change_type'] == 'CLIENT-CHANGE') {

				$column = "CLIENT";
			}

			return $column;
		}
	}

	public function downloadExcelReport()
	{
		$change = new transviewModel();

		$changes = $change->findAll();

		$fileName = 'ISPY TECHNICAL CHANGES REPORT.xlsx'; // File is to create

		$spreadsheet = new Spreadsheet();



		$sheet = $spreadsheet->getActiveSheet();
		$rows =2; 
		$crows=1;
	   // $sheet->setCellValue('A'.$crows, 'ID');
		$sheet->setCellValue('B'.$crows, 'REGISTRATION');
		$sheet->setCellValue('C'.$crows, '[OLD]' . '-' . $this->setcolumn($changes));
		$sheet->setCellValue('D'.$crows, '[NEW]' . '-' . $this->setcolumn($changes));
		$sheet->setCellValue('E'.$crows, 'DONE BY');
		$sheet->setCellValue('F'.$crows, 'DATE');
	  



		foreach ($changes as $val) {
			$sheet->setCellValue('A'.$crows, 'ID');
			$sheet->setCellValue('A' . $rows, $val['refno']);
            
			$sheet->setCellValue('B' . $rows, $val['regno']);

			$sheet->setCellValue('C' . $rows, $val['change_from']);

			$sheet->setCellValue('D' . $rows, $val['change_to']);

			$sheet->setCellValue('E' . $rows, $val['userName']);

			$sheet->setCellValue('F' . $rows, $val['created_at']);
			$rows++;
			$crows=+ 1;
		}

		$writer = new Xlsx($spreadsheet);

		// file inside /public folder
		$filepath = $fileName;

		$writer->save($filepath);

		header("Content-Type: application/vnd.ms-excel");
		header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');

		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filepath));
		flush(); // Flush system output buffer
		readfile($filepath);

		exit;
	}
}
