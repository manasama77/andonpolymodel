<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MachineController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('TemplateOffice', NULL, 'template');
	}

	public function index($machine)
	{
		if ($machine == 'kikukawa') {
			$data['title']   = 'Kikukawa';
			$data['content'] = 'kikukawa/index';
			$data['vitamin'] = 'kikukawa/index_vitamin';
		} elseif ($machine == 'ncb3') {
			$data['title']   = 'NCB3';
			$data['content'] = 'ncb3/index';
			$data['vitamin'] = 'ncb3/index_vitamin';
		} elseif ($machine == 'ncb6') {
			$data['title']   = 'NCB6';
			$data['content'] = 'ncb6/index';
			$data['vitamin'] = 'ncb6/index_vitamin';
		}

		$data['tgl_obj'] = new DateTime('now');

		$arr_slide_ext = $this->mcore->get('slide_ext', '*');

		$data['total_slides'] = $arr_slide_ext->num_rows();
		$data['data_slides']  = $arr_slide_ext->result();
		$this->template->template($data);
	}
}

/* End of file MachineController.php */
/* Location: ./application/controllers/MachineController.php */
