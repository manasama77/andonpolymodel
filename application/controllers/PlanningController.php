<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PlanningController extends CI_Controller {

	public $table = 'planning';

	public function __construct()
	{
		parent::__construct();
		$this->load->library('TemplateAdmin', null, 'template');
		$this->load->library('Cale', NULL, 'cale');
	}

	public function index()
	{
		$data['title']   = 'Planning';
		$data['content'] = 'planning/index';
		$data['vitamin'] = 'planning/index_vitamin';
		$this->template->template($data);
	}

	public function update()
	{
		echo '<pre>'.print_r($this->input->post(), 1).'</pre>';

		foreach ($this->input->post() as $key => $val) {
			if($key != 'active_date'){
				if(strlen($val) == 5){
					$where_c = [
						'date' => $key,
					];
					$c = $this->mcore->count($this->table, $where_c);

					if($c == 0){
						$data = [
							'date' => $key,
							'time' => $val,
						];
						$this->mcore->store($this->table, $data);
					}else{
						$data = [
							'time' => $val,
						];
						$where = [
							'date' => $key,
						];
						$this->mcore->update($this->table, $data, $where);
					}


				}
			}
		}

		redirect('planning');
	}

	public function init_calendar()
	{
		$bulan = $this->input->get('bulan');
		$tahun = $this->input->get('tahun');
		
		$data['calendar'] = $this->cale->show();
		
		# DEBUG ONLY
		// $this->load->view('admin/planning/render_calendar', $data, FALSE);
		# DEBUG ONLY
		
		$render = $this->load->view('admin/planning/render_calendar', $data, TRUE);
		echo $render;
	}

}

/* End of file PlanningController.php */
/* Location: ./application/controllers/PlanningController.php */