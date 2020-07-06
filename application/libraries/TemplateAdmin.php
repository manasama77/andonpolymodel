<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TemplateAdmin
{
	protected $ci;

	public function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->model('M_core', 'mcore');
	}

	public function template($data)
	{
		$this->render_view($data);
	}

	public function render_view($data)
	{
		$data['pp']   = base_url().'public/images/avatars/avatar2.png';
		$data['uri2'] = $this->ci->uri->segment(2);
		$data['uri3'] = $this->ci->uri->segment(3);
		$data['uri4'] = $this->ci->uri->segment(4);

		if(file_exists(APPPATH.'views/admin/'.$data['content'].'.php')){
			$this->ci->load->view('layouts/admin/template', $data, FALSE);
		}else{
			show_404();
		}
	}

}

/* End of file TemplateAdmin.php */
/* Location: ./application/libraries/TemplateAdmin.php */
