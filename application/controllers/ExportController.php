<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExportController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('TemplateAdmin', null, 'template');
	}

	public function index()
	{
		$data['title']   = 'Export Excel';
		$data['content'] = 'export/index';
		$data['vitamin'] = 'export/index_vitamin';
		$this->template->template($data);
	}

}

/* End of file ExportController.php */
/* Location: ./application/controllers/ExportController.php */