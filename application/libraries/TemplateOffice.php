<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TemplateOffice
{
	protected $ci;
	public $cookie_name = 'andon';

	public function __construct()
	{
		$this->ci = &get_instance();
		$this->ci->load->model('M_core', 'mcore');
		$this->ci->load->helper(['cookie', 'string']);
	}

	public function template($data)
	{
		$ck = $this->check_cookies();

		if ($ck == TRUE) {
			$this->render_view($data);
		} else {
			delete_cookie('andon');
			$cs = $this->check_session();

			if ($cs == TRUE) {
				$this->render_view($data);
			} else {
				$this->reject();
			}
		}
	}

	public function check_cookies()
	{
		$cookies = get_cookie($this->cookie_name);

		if ($cookies == NULL) {
			return FALSE;
		} else {
			$arr     = $this->ci->mcore->get('admin', '*', ['cookies' => $cookies], NULL, 'ASC', NULL, NULL);

			if ($arr->num_rows() == 0) {
				return FALSE;
			}

			$id         = $arr->row()->id;
			$username   = $arr->row()->username;
			$remember   = $arr->row()->remember;
			$cookies_db = $arr->row()->cookies;

			if ($remember == '1') {
				if ($cookies == $cookies_db) {
					$this->reset_session($id, $username);
					return TRUE;
				} else {
					return FALSE;
				}
			} else {
				return FALSE;
			}
		}
	}

	public function check_session()
	{
		$id       = $this->ci->session->userdata(SESS . 'id');
		$username = $this->ci->session->userdata(SESS . 'username');

		$arr     = $this->ci->mcore->get('admin', '*', ['id' => $id], NULL, 'ASC', NULL, NULL);

		if ($arr->num_rows() == 0) {
			return FALSE;
		}

		if ($id && $username) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function render_view($data)
	{
		if (file_exists(APPPATH . 'views/office/' . $data['content'] . '.php')) {
			$this->ci->load->view('layouts/office/template', $data, FALSE);
		} else {
			show_404();
		}
	}

	public function reject()
	{
		redirect('logout');
		exit;
	}

	public function reset_session($id, $username)
	{
		$this->ci->session->set_userdata(SESS . 'id', $id);
		$this->ci->session->set_userdata(SESS . 'username', $username);
	}
}

/* End of file TemplateAdmin.php */
/* Location: ./application/libraries/TemplateAdmin.php */
