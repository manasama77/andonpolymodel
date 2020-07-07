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

		$where = [
			'date >=' => $fromObj->format('Y-m-d'),
			'date <=' => $toObj->format('Y-m-d')
		];

		$arr_m1 = $this->mcore->get('kikukawa', '*', $where, 'date', 'ASC');
		$arr_m2 = $this->mcore->get('ncb3', '*', $where, 'date', 'ASC');
		$arr_m3 = $this->mcore->get('ncb6', '*', $where, 'date', 'ASC');

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

		$e->getActiveSheet()->getColumnDimension('I')->setWidth(2);

		$e->getActiveSheet()->getColumnDimension('J')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('K')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('L')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('M')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('N')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('O')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('P')->setWidth(14);

		$e->getActiveSheet()->getColumnDimension('Q')->setWidth(2);

		$e->getActiveSheet()->getColumnDimension('R')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('S')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('T')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('U')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('V')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('W')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('X')->setWidth(14);

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

		$e->getActiveSheet()->getStyle('B2:H2')->applyFromArray($style);
		$e->getActiveSheet()->mergeCells('B2:H2');
		$e->getActiveSheet()->setCellValue('B2', 'KIKUKAWA');

		$e->getActiveSheet()->getStyle('J2:P2')->applyFromArray($style);
		$e->getActiveSheet()->mergeCells('J2:P2');
		$e->getActiveSheet()->setCellValue('J2', 'NCB3');

		$e->getActiveSheet()->getStyle('R2:X2')->applyFromArray($style);
		$e->getActiveSheet()->mergeCells('R2:X2');
		$e->getActiveSheet()->setCellValue('R2', 'NCB6');

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

		$e->getActiveSheet()->getStyle('B3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('B3', 'Date');
		$e->getActiveSheet()->getStyle('C3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('C3', 'Cutting');
		$e->getActiveSheet()->getStyle('D3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('D3', 'Dandori');
		$e->getActiveSheet()->getStyle('E3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('E3', 'Man Activity');
		$e->getActiveSheet()->getStyle('F3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('F3', 'Idle');
		$e->getActiveSheet()->getStyle('G3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('G3', 'Alarm');
		$e->getActiveSheet()->getStyle('H3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('H3', 'Efficiency');

		$e->getActiveSheet()->getStyle('J3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('J3', 'Date');
		$e->getActiveSheet()->getStyle('K3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('K3', 'Cutting');
		$e->getActiveSheet()->getStyle('L3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('L3', 'Dandori');
		$e->getActiveSheet()->getStyle('M3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('M3', 'Man Activity');
		$e->getActiveSheet()->getStyle('N3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('N3', 'Idle');
		$e->getActiveSheet()->getStyle('O3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('O3', 'Alarm');
		$e->getActiveSheet()->getStyle('P3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('P3', 'Efficiency');

		$e->getActiveSheet()->getStyle('R3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('R3', 'Date');
		$e->getActiveSheet()->getStyle('S3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('S3', 'Cutting');
		$e->getActiveSheet()->getStyle('T3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('T3', 'Dandori');
		$e->getActiveSheet()->getStyle('U3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('U3', 'Man Activity');
		$e->getActiveSheet()->getStyle('V3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('V3', 'Idle');
		$e->getActiveSheet()->getStyle('W3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('W3', 'Alarm');
		$e->getActiveSheet()->getStyle('X3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('X3', 'Efficiency');

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
		foreach ($arr_m1->result() as $key) {
			$date    = $key->date;
			$cutting = $this->toHHMM($key->cutting);
			$dandori = $this->toHHMM($key->dandori);
			$man     = $this->toHHMM($key->man);
			$idle    = $this->toHHMM($key->idle);
			$alarm   = $this->toHHMM($key->alarm);
			$eff     = number_format($key->eff, 2);

			$e->getActiveSheet()->getStyle("B".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('B'.$row, $date);

			$e->getActiveSheet()->getStyle("C".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('C'.$row, $cutting);

			$e->getActiveSheet()->getStyle("D".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('D'.$row, $dandori);

			$e->getActiveSheet()->getStyle("E".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('E'.$row, $man);

			$e->getActiveSheet()->getStyle("F".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('F'.$row, $idle);

			$e->getActiveSheet()->getStyle("G".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('G'.$row, $alarm);

			$e->getActiveSheet()->getStyle("H".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('H'.$row, $eff);

			$row++;
		}

		$row = 4;
		foreach ($arr_m2->result() as $key) {
			$date    = $key->date;
			$cutting = $this->toHHMM($key->cutting);
			$dandori = $this->toHHMM($key->dandori);
			$man     = $this->toHHMM($key->man);
			$idle    = $this->toHHMM($key->idle);
			$alarm   = $this->toHHMM($key->alarm);
			$eff     = number_format($key->eff, 2);

			$e->getActiveSheet()->getStyle("J".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('J'.$row, $date);

			$e->getActiveSheet()->getStyle("K".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('K'.$row, $cutting);

			$e->getActiveSheet()->getStyle("L".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('L'.$row, $dandori);

			$e->getActiveSheet()->getStyle("M".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('M'.$row, $man);

			$e->getActiveSheet()->getStyle("N".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('N'.$row, $idle);

			$e->getActiveSheet()->getStyle("O".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('O'.$row, $alarm);

			$e->getActiveSheet()->getStyle("P".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('P'.$row, $eff);

			$row++;
		}

		$row = 4;
		foreach ($arr_m3->result() as $key) {
			$date    = $key->date;
			$cutting = $this->toHHMM($key->cutting);
			$dandori = $this->toHHMM($key->dandori);
			$man     = $this->toHHMM($key->man);
			$idle    = $this->toHHMM($key->idle);
			$alarm   = $this->toHHMM($key->alarm);
			$eff     = number_format($key->eff, 2);

			$e->getActiveSheet()->getStyle("R".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('R'.$row, $date);

			$e->getActiveSheet()->getStyle("S".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('S'.$row, $cutting);

			$e->getActiveSheet()->getStyle("T".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('T'.$row, $dandori);

			$e->getActiveSheet()->getStyle("U".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('U'.$row, $man);

			$e->getActiveSheet()->getStyle("V".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('V'.$row, $idle);

			$e->getActiveSheet()->getStyle("W".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('W'.$row, $alarm);

			$e->getActiveSheet()->getStyle("X".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('X'.$row, $eff);

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
		$tglObj = new DateTime($my."-01");

		$nama_file = 'Excel Monthly '.$my;

		$where = [
			'MONTH(date)' => $tglObj->format('m'),
			'YEAR(date)'  => $tglObj->format('Y'),
		];

		$arr_m1 = $this->mcore->get('kikukawa', '*', $where, 'date', 'ASC');
		$arr_m2 = $this->mcore->get('ncb3', '*', $where, 'date', 'ASC');
		$arr_m3 = $this->mcore->get('ncb6', '*', $where, 'date', 'ASC');

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
		->setKeywords("export,andon,monthly")
		->setCategory("andon");

		$e->createSheet(0);
		$e->setActiveSheetIndex(0);
		$e->getActiveSheet()->setTitle("Monthly");

		$e->getActiveSheet()->getColumnDimension('A')->setWidth(2);

		$e->getActiveSheet()->getColumnDimension('B')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('C')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('D')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('E')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('F')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('G')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('H')->setWidth(14);

		$e->getActiveSheet()->getColumnDimension('I')->setWidth(2);

		$e->getActiveSheet()->getColumnDimension('J')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('K')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('L')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('M')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('N')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('O')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('P')->setWidth(14);

		$e->getActiveSheet()->getColumnDimension('Q')->setWidth(2);

		$e->getActiveSheet()->getColumnDimension('R')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('S')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('T')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('U')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('V')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('W')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('X')->setWidth(14);

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

		$e->getActiveSheet()->getStyle('B2:H2')->applyFromArray($style);
		$e->getActiveSheet()->mergeCells('B2:H2');
		$e->getActiveSheet()->setCellValue('B2', 'KIKUKAWA');

		$e->getActiveSheet()->getStyle('J2:P2')->applyFromArray($style);
		$e->getActiveSheet()->mergeCells('J2:P2');
		$e->getActiveSheet()->setCellValue('J2', 'NCB3');

		$e->getActiveSheet()->getStyle('R2:X2')->applyFromArray($style);
		$e->getActiveSheet()->mergeCells('R2:X2');
		$e->getActiveSheet()->setCellValue('R2', 'NCB6');

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

		$e->getActiveSheet()->getStyle('B3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('B3', 'Date');
		$e->getActiveSheet()->getStyle('C3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('C3', 'Cutting');
		$e->getActiveSheet()->getStyle('D3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('D3', 'Dandori');
		$e->getActiveSheet()->getStyle('E3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('E3', 'Man Activity');
		$e->getActiveSheet()->getStyle('F3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('F3', 'Idle');
		$e->getActiveSheet()->getStyle('G3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('G3', 'Alarm');
		$e->getActiveSheet()->getStyle('H3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('H3', 'Efficiency');

		$e->getActiveSheet()->getStyle('J3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('J3', 'Date');
		$e->getActiveSheet()->getStyle('K3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('K3', 'Cutting');
		$e->getActiveSheet()->getStyle('L3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('L3', 'Dandori');
		$e->getActiveSheet()->getStyle('M3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('M3', 'Man Activity');
		$e->getActiveSheet()->getStyle('N3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('N3', 'Idle');
		$e->getActiveSheet()->getStyle('O3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('O3', 'Alarm');
		$e->getActiveSheet()->getStyle('P3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('P3', 'Efficiency');

		$e->getActiveSheet()->getStyle('R3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('R3', 'Date');
		$e->getActiveSheet()->getStyle('S3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('S3', 'Cutting');
		$e->getActiveSheet()->getStyle('T3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('T3', 'Dandori');
		$e->getActiveSheet()->getStyle('U3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('U3', 'Man Activity');
		$e->getActiveSheet()->getStyle('V3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('V3', 'Idle');
		$e->getActiveSheet()->getStyle('W3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('W3', 'Alarm');
		$e->getActiveSheet()->getStyle('X3')->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('X3', 'Efficiency');

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
		foreach ($arr_m1->result() as $key) {
			$date    = $key->date;
			$cutting = $this->toHHMM($key->cutting);
			$dandori = $this->toHHMM($key->dandori);
			$man     = $this->toHHMM($key->man);
			$idle    = $this->toHHMM($key->idle);
			$alarm   = $this->toHHMM($key->alarm);
			$eff     = number_format($key->eff, 2);

			$e->getActiveSheet()->getStyle("B".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('B'.$row, $date);

			$e->getActiveSheet()->getStyle("C".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('C'.$row, $cutting);

			$e->getActiveSheet()->getStyle("D".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('D'.$row, $dandori);

			$e->getActiveSheet()->getStyle("E".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('E'.$row, $man);

			$e->getActiveSheet()->getStyle("F".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('F'.$row, $idle);

			$e->getActiveSheet()->getStyle("G".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('G'.$row, $alarm);

			$e->getActiveSheet()->getStyle("H".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('H'.$row, $eff);

			$row++;
		}

		$row = 4;
		foreach ($arr_m2->result() as $key) {
			$date    = $key->date;
			$cutting = $this->toHHMM($key->cutting);
			$dandori = $this->toHHMM($key->dandori);
			$man     = $this->toHHMM($key->man);
			$idle    = $this->toHHMM($key->idle);
			$alarm   = $this->toHHMM($key->alarm);
			$eff     = number_format($key->eff, 2);

			$e->getActiveSheet()->getStyle("J".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('J'.$row, $date);

			$e->getActiveSheet()->getStyle("K".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('K'.$row, $cutting);

			$e->getActiveSheet()->getStyle("L".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('L'.$row, $dandori);

			$e->getActiveSheet()->getStyle("M".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('M'.$row, $man);

			$e->getActiveSheet()->getStyle("N".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('N'.$row, $idle);

			$e->getActiveSheet()->getStyle("O".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('O'.$row, $alarm);

			$e->getActiveSheet()->getStyle("P".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('P'.$row, $eff);

			$row++;
		}

		$row = 4;
		foreach ($arr_m3->result() as $key) {
			$date    = $key->date;
			$cutting = $this->toHHMM($key->cutting);
			$dandori = $this->toHHMM($key->dandori);
			$man     = $this->toHHMM($key->man);
			$idle    = $this->toHHMM($key->idle);
			$alarm   = $this->toHHMM($key->alarm);
			$eff     = number_format($key->eff, 2);

			$e->getActiveSheet()->getStyle("R".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('R'.$row, $date);

			$e->getActiveSheet()->getStyle("S".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('S'.$row, $cutting);

			$e->getActiveSheet()->getStyle("T".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('T'.$row, $dandori);

			$e->getActiveSheet()->getStyle("U".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('U'.$row, $man);

			$e->getActiveSheet()->getStyle("V".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('V'.$row, $idle);

			$e->getActiveSheet()->getStyle("W".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('W'.$row, $alarm);

			$e->getActiveSheet()->getStyle("X".$row)->applyFromArray($style);
			$e->getActiveSheet()->setCellValue('X'.$row, $eff);

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