<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PlanningController extends CI_Controller {

	public $table1 = 'planning_kikukawa';
	public $table2 = 'planning_ncb3';
	public $table3 = 'planning_ncb6';

	public function __construct()
	{
		parent::__construct();
		$this->load->library('TemplateAdmin', null, 'template');
		$this->load->library('Cale1', NULL, 'cale1');
		$this->load->library('Cale2', NULL, 'cale2');
		$this->load->library('Cale3', NULL, 'cale3');
	}

	public function index()
	{
		$data['title']   = 'Planning';
		$data['content'] = 'planning/index';
		$data['vitamin'] = 'planning/index_vitamin';
		$this->template->template($data);
	}

	public function update1()
	{
		$exec = TRUE;
		foreach ($this->input->post() as $key => $val) {
			if($key != 'active_date'){
				if(strlen($val) == 5){
					$where_c = [
						'date' => $key,
					];
					$c = $this->mcore->count($this->table1, $where_c);

					if($c == 0){
						$data = [
							'date' => $key,
							'time' => $val,
						];
						$exec = $this->mcore->store($this->table1, $data);
					}else{
						$data = [
							'time' => $val,
						];
						$where = [
							'date' => $key,
						];
						$exec = $this->mcore->update($this->table1, $data, $where);
					}


				}
			}
		}

		if($exec){
			$return = ['code' => 200];
		}else{
			$return = ['code' => 500];
		}

		echo json_encode($return);
	}

	public function update2()
	{
		$exec = TRUE;
		foreach ($this->input->post() as $key => $val) {
			if($key != 'active_date'){
				if(strlen($val) == 5){
					$where_c = [
						'date' => $key,
					];
					$c = $this->mcore->count($this->table2, $where_c);

					if($c == 0){
						$data = [
							'date' => $key,
							'time' => $val,
						];
						$exec = $this->mcore->store($this->table2, $data);
					}else{
						$data = [
							'time' => $val,
						];
						$where = [
							'date' => $key,
						];
						$exec = $this->mcore->update($this->table2, $data, $where);
					}


				}
			}
		}

		if($exec){
			$return = ['code' => 200];
		}else{
			$return = ['code' => 500];
		}

		echo json_encode($return);
	}

	public function update3()
	{
		$exec = TRUE;
		foreach ($this->input->post() as $key => $val) {
			if($key != 'active_date'){
				if(strlen($val) == 5){
					$where_c = [
						'date' => $key,
					];
					$c = $this->mcore->count($this->table3, $where_c);

					if($c == 0){
						$data = [
							'date' => $key,
							'time' => $val,
						];
						$exec = $this->mcore->store($this->table3, $data);
					}else{
						$data = [
							'time' => $val,
						];
						$where = [
							'date' => $key,
						];
						$exec = $this->mcore->update($this->table3, $data, $where);
					}


				}
			}
		}

		if($exec){
			$return = ['code' => 200];
		}else{
			$return = ['code' => 500];
		}

		echo json_encode($return);
	}

	public function init_calendar1()
	{
		$bulan = $this->input->get('monthcal1');
		$tahun = $this->input->get('yearcal1');
		
		$data['calendar'] = $this->cale1->show();
		
		# DEBUG ONLY
		// $this->load->view('admin/planning/render_calendar', $data, FALSE);
		# DEBUG ONLY
		
		$render = $this->load->view('admin/planning/render_calendar1', $data, TRUE);
		echo $render;
	}

	public function init_calendar2()
	{
		$bulan = $this->input->get('monthcal2');
		$tahun = $this->input->get('yearcal2');
		
		$data['calendar'] = $this->cale2->show();
		
		# DEBUG ONLY
		// $this->load->view('admin/planning/render_calendar', $data, FALSE);
		# DEBUG ONLY
		
		$render = $this->load->view('admin/planning/render_calendar2', $data, TRUE);
		echo $render;
	}

	public function init_calendar3()
	{
		$bulan = $this->input->get('monthcal3');
		$tahun = $this->input->get('yearcal3');
		
		$data['calendar'] = $this->cale3->show();
		
		# DEBUG ONLY
		// $this->load->view('admin/planning/render_calendar', $data, FALSE);
		# DEBUG ONLY
		
		$render = $this->load->view('admin/planning/render_calendar3', $data, TRUE);
		echo $render;
	}

}

/* End of file PlanningController.php */
/* Location: ./application/controllers/PlanningController.php */