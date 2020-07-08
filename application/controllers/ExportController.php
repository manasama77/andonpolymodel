<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExportController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('TemplateAdmin', null, 'template');
		$this->load->library('phpexcel');
	}

	public function index()
	{
		$data['title']   = 'Export Excel';
		$data['content'] = 'export/index';
		$data['vitamin'] = 'export/index_vitamin';
		$this->template->template($data);
	}

	public function export_daily($from = NULL, $to = NULL)
	{
		$fromObj = new DateTime($from);
		$toObj   = new DateTime($to);

		$nama_file = 'Excel Daily '.$from.' - '.$to;

		$m1 = [];
		$m2 = [];
		$m3 = [];

		$e             = new PHPExcel();
		$cacheMethod   = PHPExcel_CachedObjectStorageFactory::cache_to_discISAM;
		$cacheSettings = array('dir' => base_url());
		PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

		$e->getProperties()
		->setCreator("Toyota - Andon APP")
		->setLastModifiedBy("Toyota - Andon APP")
		->setTitle($nama_file)
		->setSubject("")
		->setDescription("")
		->setKeywords("export,andon,daily")
		->setCategory("andon");

		$e->createSheet(0);
		$e->setActiveSheetIndex(0);
		$e->getActiveSheet()->setTitle("Daily");

		$e->getActiveSheet()->getColumnDimension('A')->setWidth(2);

		$e->getActiveSheet()->getColumnDimension('B')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('C')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('D')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('E')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('F')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('G')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('H')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('I')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('J')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('K')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('L')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('M')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('N')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('O')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('P')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('Q')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('R')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('S')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('T')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('U')->setWidth(14);

		$style = [
			'alignment' => [
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical'   => PHPExcel_Style_Alignment::VERTICAL_TOP
			],
			'font' => [
				'bold' => TRUE,
				'size' => '14'
			],
			'borders' => [
				'allborders' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => ['rgb' => '000000'],
				],
			]
		];

		$e->getActiveSheet()->getStyle('B2:B3')->applyFromArray($style);
		$e->getActiveSheet()->mergeCells('B2:B3');
		$e->getActiveSheet()->setCellValue('B2', 'DATE');

		$e->getActiveSheet()->getStyle('C2:C3')->applyFromArray($style);
		$e->getActiveSheet()->mergeCells('C2:C3');
		$e->getActiveSheet()->setCellValue('C2', 'PLAN');

		$e->getActiveSheet()->getStyle('D2:I2')->applyFromArray($style);
		$e->getActiveSheet()->mergeCells('D2:I2');
		$e->getActiveSheet()->setCellValue('D2', 'KIKUKAWA');

		$e->getActiveSheet()->getStyle('J2:O2')->applyFromArray($style);
		$e->getActiveSheet()->mergeCells('J2:O2');
		$e->getActiveSheet()->setCellValue('J2', 'NCB3');

		$e->getActiveSheet()->getStyle('P2:U2')->applyFromArray($style);
		$e->getActiveSheet()->mergeCells('P2:U2');
		$e->getActiveSheet()->setCellValue('P2', 'NCB6');

		$style = [
			'alignment' => [
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
				'vertical'   => PHPExcel_Style_Alignment::VERTICAL_TOP
			],
			'font' => [
				'bold' => TRUE,
				'size' => '12'
			],
			'borders' => [
				'allborders' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => ['rgb' => '000000'],
				],
			]
		];

		$e->getActiveSheet()->getStyle('D3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('D3', 'Cutting');
		$e->getActiveSheet()->getStyle('E3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('E3', 'Dandori');
		$e->getActiveSheet()->getStyle('F3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('F3', 'Man Activity');
		$e->getActiveSheet()->getStyle('G3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('G3', 'Idle');
		$e->getActiveSheet()->getStyle('H3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('H3', 'Alarm');
		$e->getActiveSheet()->getStyle('I3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('I3', 'Efficiency');

		$e->getActiveSheet()->getStyle('J3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('J3', 'Cutting');
		$e->getActiveSheet()->getStyle('K3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('K3', 'Dandori');
		$e->getActiveSheet()->getStyle('L3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('L3', 'Man Activity');
		$e->getActiveSheet()->getStyle('M3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('M3', 'Idle');
		$e->getActiveSheet()->getStyle('N3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('N3', 'Alarm');
		$e->getActiveSheet()->getStyle('O3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('O3', 'Efficiency');

		$e->getActiveSheet()->getStyle('P3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('P3', 'Cutting');
		$e->getActiveSheet()->getStyle('Q3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('Q3', 'Dandori');
		$e->getActiveSheet()->getStyle('R3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('R3', 'Man Activity');
		$e->getActiveSheet()->getStyle('S3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('S3', 'Idle');
		$e->getActiveSheet()->getStyle('T3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('T3', 'Alarm');
		$e->getActiveSheet()->getStyle('U3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('U3', 'Efficiency');

		$style = [
			'alignment' => [
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
				'vertical'   => PHPExcel_Style_Alignment::VERTICAL_TOP
			],
			'font' => [
				'bold' => FALSE,
				'size' => '11'
			],
			'borders' => [
				'allborders' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => ['rgb' => '000000'],
				],
			]
		];

		$row = 4;
		$toObj->modify('+ 1 day');
		$interval = new DateInterval('P1D');
		$period   = new DatePeriod($fromObj, $interval, $toObj);
		foreach ($period as $dt) {
			$where = ['date' => $dt->format('Y-m-d')];

			$e->getActiveSheet()->getStyle("B".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('B'.$row, $dt->format('Y-m-d'));

			$arr_plan = $this->mcore->get('planning', '*', $where, 'date', 'ASC');
			if($arr_plan->num_rows() == 1){
				foreach ($arr_plan->result() as $key) {
					$time = $key->time;

					$e->getActiveSheet()->getStyle("C".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('C'.$row, $time);
				}
			}else{
				$e->getActiveSheet()->getStyle("C".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('C'.$row, '');
			}

			$arr_m1 = $this->mcore->get('kikukawa', '*', $where, 'date', 'ASC');
			if($arr_m1->num_rows() == 1){
				foreach ($arr_m1->result() as $key) {
					$date    = $key->date;
					$cutting = $this->toHHMM($key->cutting);
					$dandori = $this->toHHMM($key->dandori);
					$man     = $this->toHHMM($key->man);
					$idle    = $this->toHHMM($key->idle);
					$alarm   = $this->toHHMM($key->alarm);
					$eff     = number_format($key->eff, 2);

					$e->getActiveSheet()->getStyle("D".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('D'.$row, $cutting);

					$e->getActiveSheet()->getStyle("E".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('E'.$row, $dandori);

					$e->getActiveSheet()->getStyle("F".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('F'.$row, $man);

					$e->getActiveSheet()->getStyle("G".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('G'.$row, $idle);

					$e->getActiveSheet()->getStyle("H".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('H'.$row, $alarm);

					$e->getActiveSheet()->getStyle("I".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('I'.$row, $eff);
				}
			}else{
				$e->getActiveSheet()->getStyle("D".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('D'.$row, '');

				$e->getActiveSheet()->getStyle("E".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('E'.$row, '');

				$e->getActiveSheet()->getStyle("F".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('F'.$row, '');

				$e->getActiveSheet()->getStyle("G".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('G'.$row, '');

				$e->getActiveSheet()->getStyle("H".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('H'.$row, '');

				$e->getActiveSheet()->getStyle("I".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('I'.$row, '');
			}

			$arr_m2 = $this->mcore->get('ncb3', '*', $where, 'date', 'ASC');
			if($arr_m2->num_rows() == 1){
				foreach ($arr_m2->result() as $key) {
					$date    = $key->date;
					$cutting = $this->toHHMM($key->cutting);
					$dandori = $this->toHHMM($key->dandori);
					$man     = $this->toHHMM($key->man);
					$idle    = $this->toHHMM($key->idle);
					$alarm   = $this->toHHMM($key->alarm);
					$eff     = number_format($key->eff, 2);

					$e->getActiveSheet()->getStyle("J".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('J'.$row, $cutting);

					$e->getActiveSheet()->getStyle("K".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('K'.$row, $dandori);

					$e->getActiveSheet()->getStyle("L".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('L'.$row, $man);

					$e->getActiveSheet()->getStyle("M".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('M'.$row, $idle);

					$e->getActiveSheet()->getStyle("N".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('N'.$row, $alarm);

					$e->getActiveSheet()->getStyle("O".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('O'.$row, $eff);
				}
			}else{
				$e->getActiveSheet()->getStyle("J".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('J'.$row, '');

				$e->getActiveSheet()->getStyle("K".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('K'.$row, '');

				$e->getActiveSheet()->getStyle("L".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('L'.$row, '');

				$e->getActiveSheet()->getStyle("M".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('M'.$row, '');

				$e->getActiveSheet()->getStyle("N".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('N'.$row, '');

				$e->getActiveSheet()->getStyle("O".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('O'.$row, '');
			}

			$arr_m3 = $this->mcore->get('ncb6', '*', $where, 'date', 'ASC');
			if($arr_m2->num_rows() == 1){
				foreach ($arr_m3->result() as $key) {
					$date    = $key->date;
					$cutting = $this->toHHMM($key->cutting);
					$dandori = $this->toHHMM($key->dandori);
					$man     = $this->toHHMM($key->man);
					$idle    = $this->toHHMM($key->idle);
					$alarm   = $this->toHHMM($key->alarm);
					$eff     = number_format($key->eff, 2);

					$e->getActiveSheet()->getStyle("P".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('P'.$row, $cutting);

					$e->getActiveSheet()->getStyle("Q".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('Q'.$row, $dandori);

					$e->getActiveSheet()->getStyle("R".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('R'.$row, $man);

					$e->getActiveSheet()->getStyle("S".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('S'.$row, $idle);

					$e->getActiveSheet()->getStyle("T".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('T'.$row, $alarm);

					$e->getActiveSheet()->getStyle("U".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('U'.$row, $eff);
				}	
			}else{
				$e->getActiveSheet()->getStyle("P".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('P'.$row, '');

				$e->getActiveSheet()->getStyle("Q".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('Q'.$row, '');

				$e->getActiveSheet()->getStyle("R".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('R'.$row, '');

				$e->getActiveSheet()->getStyle("S".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('S'.$row, '');

				$e->getActiveSheet()->getStyle("T".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('T'.$row, '');

				$e->getActiveSheet()->getStyle("U".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('U'.$row, '');
			}

			$row++;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Cache-Control: max-age=0');
		header('Content-Disposition: attachment;filename="'.$nama_file.'.xlsx"');
		$objWriter = PHPExcel_IOFactory::createWriter($e, 'Excel2007');
		$objWriter->save('php://output');

		$e->disconnectWorksheets();
		unset($e);
	}

	public function export_monthly($my = NULL)
	{
		$fromObj = new DateTime($my."-01");
		$toObj   = new DateTime($my."-01");
		$toObj->modify('last day of this month');

		$nama_file = 'Excel Monthly '.$my;

		$m1 = [];
		$m2 = [];
		$m3 = [];

		$e             = new PHPExcel();
		$cacheMethod   = PHPExcel_CachedObjectStorageFactory::cache_to_discISAM;
		$cacheSettings = array('dir' => base_url());
		PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

		$e->getProperties()
		->setCreator("Toyota - Andon APP")
		->setLastModifiedBy("Toyota - Andon APP")
		->setTitle($nama_file)
		->setSubject("")
		->setDescription("")
		->setKeywords("export,andon,daily")
		->setCategory("andon");

		$e->createSheet(0);
		$e->setActiveSheetIndex(0);
		$e->getActiveSheet()->setTitle("Daily");

		$e->getActiveSheet()->getColumnDimension('A')->setWidth(2);

		$e->getActiveSheet()->getColumnDimension('B')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('C')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('D')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('E')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('F')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('G')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('H')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('I')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('J')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('K')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('L')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('M')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('N')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('O')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('P')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('Q')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('R')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('S')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('T')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('U')->setWidth(14);

		$style = [
			'alignment' => [
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical'   => PHPExcel_Style_Alignment::VERTICAL_TOP
			],
			'font' => [
				'bold' => TRUE,
				'size' => '14'
			],
			'borders' => [
				'allborders' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => ['rgb' => '000000'],
				],
			]
		];

		$e->getActiveSheet()->getStyle('B2:B3')->applyFromArray($style);
		$e->getActiveSheet()->mergeCells('B2:B3');
		$e->getActiveSheet()->setCellValue('B2', 'DATE');

		$e->getActiveSheet()->getStyle('C2:C3')->applyFromArray($style);
		$e->getActiveSheet()->mergeCells('C2:C3');
		$e->getActiveSheet()->setCellValue('C2', 'PLAN');

		$e->getActiveSheet()->getStyle('D2:I2')->applyFromArray($style);
		$e->getActiveSheet()->mergeCells('D2:I2');
		$e->getActiveSheet()->setCellValue('D2', 'KIKUKAWA');

		$e->getActiveSheet()->getStyle('J2:O2')->applyFromArray($style);
		$e->getActiveSheet()->mergeCells('J2:O2');
		$e->getActiveSheet()->setCellValue('J2', 'NCB3');

		$e->getActiveSheet()->getStyle('P2:U2')->applyFromArray($style);
		$e->getActiveSheet()->mergeCells('P2:U2');
		$e->getActiveSheet()->setCellValue('P2', 'NCB6');

		$style = [
			'alignment' => [
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
				'vertical'   => PHPExcel_Style_Alignment::VERTICAL_TOP
			],
			'font' => [
				'bold' => TRUE,
				'size' => '12'
			],
			'borders' => [
				'allborders' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => ['rgb' => '000000'],
				],
			]
		];

		$e->getActiveSheet()->getStyle('D3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('D3', 'Cutting');
		$e->getActiveSheet()->getStyle('E3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('E3', 'Dandori');
		$e->getActiveSheet()->getStyle('F3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('F3', 'Man Activity');
		$e->getActiveSheet()->getStyle('G3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('G3', 'Idle');
		$e->getActiveSheet()->getStyle('H3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('H3', 'Alarm');
		$e->getActiveSheet()->getStyle('I3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('I3', 'Efficiency');

		$e->getActiveSheet()->getStyle('J3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('J3', 'Cutting');
		$e->getActiveSheet()->getStyle('K3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('K3', 'Dandori');
		$e->getActiveSheet()->getStyle('L3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('L3', 'Man Activity');
		$e->getActiveSheet()->getStyle('M3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('M3', 'Idle');
		$e->getActiveSheet()->getStyle('N3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('N3', 'Alarm');
		$e->getActiveSheet()->getStyle('O3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('O3', 'Efficiency');

		$e->getActiveSheet()->getStyle('P3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('P3', 'Cutting');
		$e->getActiveSheet()->getStyle('Q3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('Q3', 'Dandori');
		$e->getActiveSheet()->getStyle('R3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('R3', 'Man Activity');
		$e->getActiveSheet()->getStyle('S3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('S3', 'Idle');
		$e->getActiveSheet()->getStyle('T3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('T3', 'Alarm');
		$e->getActiveSheet()->getStyle('U3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('U3', 'Efficiency');

		$style = [
			'alignment' => [
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
				'vertical'   => PHPExcel_Style_Alignment::VERTICAL_TOP
			],
			'font' => [
				'bold' => FALSE,
				'size' => '11'
			],
			'borders' => [
				'allborders' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => ['rgb' => '000000'],
				],
			]
		];

		$row = 4;
		$toObj->modify('+ 1 day');
		$interval = new DateInterval('P1D');
		$period   = new DatePeriod($fromObj, $interval, $toObj);
		foreach ($period as $dt) {
			$where = ['date' => $dt->format('Y-m-d')];

			$e->getActiveSheet()->getStyle("B".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('B'.$row, $dt->format('Y-m-d'));

			$arr_plan = $this->mcore->get('planning', '*', $where, 'date', 'ASC');
			if($arr_plan->num_rows() == 1){
				foreach ($arr_plan->result() as $key) {
					$time = $key->time;

					$e->getActiveSheet()->getStyle("C".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('C'.$row, $time);
				}
			}else{
				$e->getActiveSheet()->getStyle("C".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('C'.$row, '');
			}

			$arr_m1 = $this->mcore->get('kikukawa', '*', $where, 'date', 'ASC');
			if($arr_m1->num_rows() == 1){
				foreach ($arr_m1->result() as $key) {
					$date    = $key->date;
					$cutting = $this->toHHMM($key->cutting);
					$dandori = $this->toHHMM($key->dandori);
					$man     = $this->toHHMM($key->man);
					$idle    = $this->toHHMM($key->idle);
					$alarm   = $this->toHHMM($key->alarm);
					$eff     = number_format($key->eff, 2);

					$e->getActiveSheet()->getStyle("D".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('D'.$row, $cutting);

					$e->getActiveSheet()->getStyle("E".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('E'.$row, $dandori);

					$e->getActiveSheet()->getStyle("F".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('F'.$row, $man);

					$e->getActiveSheet()->getStyle("G".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('G'.$row, $idle);

					$e->getActiveSheet()->getStyle("H".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('H'.$row, $alarm);

					$e->getActiveSheet()->getStyle("I".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('I'.$row, $eff);
				}
			}else{
				$e->getActiveSheet()->getStyle("D".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('D'.$row, '');

				$e->getActiveSheet()->getStyle("E".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('E'.$row, '');

				$e->getActiveSheet()->getStyle("F".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('F'.$row, '');

				$e->getActiveSheet()->getStyle("G".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('G'.$row, '');

				$e->getActiveSheet()->getStyle("H".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('H'.$row, '');

				$e->getActiveSheet()->getStyle("I".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('I'.$row, '');
			}

			$arr_m2 = $this->mcore->get('ncb3', '*', $where, 'date', 'ASC');
			if($arr_m2->num_rows() == 1){
				foreach ($arr_m2->result() as $key) {
					$date    = $key->date;
					$cutting = $this->toHHMM($key->cutting);
					$dandori = $this->toHHMM($key->dandori);
					$man     = $this->toHHMM($key->man);
					$idle    = $this->toHHMM($key->idle);
					$alarm   = $this->toHHMM($key->alarm);
					$eff     = number_format($key->eff, 2);

					$e->getActiveSheet()->getStyle("J".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('J'.$row, $cutting);

					$e->getActiveSheet()->getStyle("K".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('K'.$row, $dandori);

					$e->getActiveSheet()->getStyle("L".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('L'.$row, $man);

					$e->getActiveSheet()->getStyle("M".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('M'.$row, $idle);

					$e->getActiveSheet()->getStyle("N".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('N'.$row, $alarm);

					$e->getActiveSheet()->getStyle("O".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('O'.$row, $eff);
				}
			}else{
				$e->getActiveSheet()->getStyle("J".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('J'.$row, '');

				$e->getActiveSheet()->getStyle("K".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('K'.$row, '');

				$e->getActiveSheet()->getStyle("L".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('L'.$row, '');

				$e->getActiveSheet()->getStyle("M".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('M'.$row, '');

				$e->getActiveSheet()->getStyle("N".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('N'.$row, '');

				$e->getActiveSheet()->getStyle("O".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('O'.$row, '');
			}

			$arr_m3 = $this->mcore->get('ncb6', '*', $where, 'date', 'ASC');
			if($arr_m2->num_rows() == 1){
				foreach ($arr_m3->result() as $key) {
					$date    = $key->date;
					$cutting = $this->toHHMM($key->cutting);
					$dandori = $this->toHHMM($key->dandori);
					$man     = $this->toHHMM($key->man);
					$idle    = $this->toHHMM($key->idle);
					$alarm   = $this->toHHMM($key->alarm);
					$eff     = number_format($key->eff, 2);

					$e->getActiveSheet()->getStyle("P".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('P'.$row, $cutting);

					$e->getActiveSheet()->getStyle("Q".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('Q'.$row, $dandori);

					$e->getActiveSheet()->getStyle("R".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('R'.$row, $man);

					$e->getActiveSheet()->getStyle("S".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('S'.$row, $idle);

					$e->getActiveSheet()->getStyle("T".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('T'.$row, $alarm);

					$e->getActiveSheet()->getStyle("U".$row)->applyFromArray($style);
					$e->getActiveSheet()->setCellValue('U'.$row, $eff);
				}	
			}else{
				$e->getActiveSheet()->getStyle("P".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('P'.$row, '');

				$e->getActiveSheet()->getStyle("Q".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('Q'.$row, '');

				$e->getActiveSheet()->getStyle("R".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('R'.$row, '');

				$e->getActiveSheet()->getStyle("S".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('S'.$row, '');

				$e->getActiveSheet()->getStyle("T".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('T'.$row, '');

				$e->getActiveSheet()->getStyle("U".$row)->applyFromArray($style);
				$e->getActiveSheet()->setCellValue('U'.$row, '');
			}

			$row++;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Cache-Control: max-age=0');
		header('Content-Disposition: attachment;filename="'.$nama_file.'.xlsx"');
		$objWriter = PHPExcel_IOFactory::createWriter($e, 'Excel2007');
		$objWriter->save('php://output');

		$e->disconnectWorksheets();
		unset($e);
	}

	function toHHMM($sec)
	{
		$seconds = round($sec);
		$output  = sprintf('%02d:%02d', ($seconds/ 3600),($seconds/ 60 % 60));
		return $output;
	}

}

/* End of file ExportController.php */
/* Location: ./application/controllers/ExportController.php */