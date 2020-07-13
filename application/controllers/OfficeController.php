<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OfficeController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('TemplateOffice', NULL, 'template');
	}

	public function index()
	{
		$data['title']   = 'Office';
		$data['content'] = 'main/index';
		$data['vitamin'] = 'main/index_vitamin';
		$data['tgl_obj'] = new DateTime('now');
		$this->template->template($data);
	}

	public function json_m1($tgl)
	{
		$tgl           = urldecode($tgl);
		$explode       = explode(' ', $tgl);
		$tgl_obj       = new DateTime($explode[1].'-'.$explode[0].'-01');
		$tgl_obj_start = new DateTime($explode[1].'-'.$explode[0].'-01');
		$tgl_obj_end   = new DateTime($explode[1].'-'.$explode[0].'-01');

		$start    = $tgl_obj_start->modify('first day of this month');
		$end      = $tgl_obj_end->modify('last day of this month');
		$end->modify('+ 1 day');
		$interval = new DateInterval('P1D');
		$period   = new DatePeriod($start, $interval, $end);

		foreach ($period as $dt) {
			$where = ['date' => $dt->format('Y-m-d')];
			$arr   = $this->mcore->get('kikukawa', 'date, eff', $where, 'date', 'ASC');
			if($arr->num_rows() == 0){
				$eff = 0;
			}else{
				$eff = $arr->row()->eff;
			}
		    $data[] = [
				'tanggal' => $dt->format('Y-m-d'),
				'y'       => $dt->format('Y'),
				'm'       => $dt->format('m'),
				'd'       => $dt->format('d'),
				'eff'     => (float)$eff,
			];
		}

		echo json_encode($data);
	}

	public function json_m2($tgl)
	{
		$tgl           = urldecode($tgl);
		$explode       = explode(' ', $tgl);
		$tgl_obj       = new DateTime($explode[1].'-'.$explode[0].'-01');
		$tgl_obj_start = new DateTime($explode[1].'-'.$explode[0].'-01');
		$tgl_obj_end   = new DateTime($explode[1].'-'.$explode[0].'-01');

		$start    = $tgl_obj_start->modify('first day of this month');
		$end      = $tgl_obj_end->modify('last day of this month');
		$end->modify('+ 1 day');
		$interval = new DateInterval('P1D');
		$period   = new DatePeriod($start, $interval, $end);

		foreach ($period as $dt) {
			$where = ['date' => $dt->format('Y-m-d')];
			$arr   = $this->mcore->get('ncb3', 'date, eff', $where, 'date', 'ASC');
			if($arr->num_rows() == 0){
				$eff = 0;
			}else{
				$eff = $arr->row()->eff;
			}
		    $data[] = [
				'tanggal' => $dt->format('Y-m-d'),
				'y'       => $dt->format('Y'),
				'm'       => $dt->format('m'),
				'd'       => $dt->format('d'),
				'eff'     => (float)$eff,
			];
		}

		echo json_encode($data);
	}

	public function json_m3($tgl)
	{
		$tgl           = urldecode($tgl);
		$explode       = explode(' ', $tgl);
		$tgl_obj       = new DateTime($explode[1].'-'.$explode[0].'-01');
		$tgl_obj_start = new DateTime($explode[1].'-'.$explode[0].'-01');
		$tgl_obj_end   = new DateTime($explode[1].'-'.$explode[0].'-01');

		$start    = $tgl_obj_start->modify('first day of this month');
		$end      = $tgl_obj_end->modify('last day of this month');
		$end->modify('+ 1 day');
		$interval = new DateInterval('P1D');
		$period   = new DatePeriod($start, $interval, $end);

		foreach ($period as $dt) {
			$where = ['date' => $dt->format('Y-m-d')];
			$arr   = $this->mcore->get('ncb6', 'date, eff', $where, 'date', 'ASC');
			if($arr->num_rows() == 0){
				$eff = 0;
			}else{
				$eff = $arr->row()->eff;
			}
		    $data[] = [
				'tanggal' => $dt->format('Y-m-d'),
				'y'       => $dt->format('Y'),
				'm'       => $dt->format('m'),
				'd'       => $dt->format('d'),
				'eff'     => (float)$eff,
			];
		}

		echo json_encode($data);
	}

	public function json_montly($tahun)
	{
		$tahun         = urldecode($tahun);
		$tgl_obj       = new DateTime($tahun.'-01-01');
		$tgl_obj_start = new DateTime($tahun.'-01-01');
		$tgl_obj_end   = new DateTime($tahun.'-12-31');

		$interval = new DateInterval('P1M');
		$period   = new DatePeriod($tgl_obj_start, $interval, $tgl_obj_end);

		$kikukawa_array = [];
		$ncb3_array     = [];
		$ncb6_array     = [];

		foreach ($period as $dt) {
			$where = ['MONTH(date)' => $dt->format('m'), 'YEAR(date)' => $dt->format('Y')];
			$arr   = $this->mcore->get('monthly', 'kikukawa, ncb3, ncb6', $where, 'MONTH(date)', 'ASC');
			
			if($arr->num_rows() == 0){
				$kikukawa = 0;
				$ncb3 = 0;
				$ncb6 = 0;
			}else{
				$kikukawa = $arr->row()->kikukawa;
				$ncb3     = $arr->row()->ncb3;
				$ncb6     = $arr->row()->ncb3;

				if($kikukawa == 0){ $kikukawa = 0; }
				if($ncb3 == 0){ $ncb3 = 0; }
				if($ncb6 == 0){ $ncb6 = 0; }
			}

		    $nested_kikukawa = [
				'month' => $dt->format('M'),
				'year'  => $dt->format('Y'),
				'eff'   => (float)$kikukawa,
			];

			$nested_ncb3 = [
				'month' => $dt->format('M'),
				'year'  => $dt->format('Y'),
				'eff'   => (float)$ncb3,
			];

			$nested_ncb6 = [
				'month' => $dt->format('M'),
				'year'  => $dt->format('Y'),
				'eff'   => (float)$ncb6,
			];

			array_push($kikukawa_array, $nested_kikukawa);
			array_push($ncb3_array, $nested_ncb3);
			array_push($ncb6_array, $nested_ncb6);
		}

		$data = compact('kikukawa_array', 'ncb3_array', 'ncb6_array');

		echo json_encode($data);
	}

}

/* End of file OfficeController.php */
/* Location: ./application/controllers/OfficeController.php */