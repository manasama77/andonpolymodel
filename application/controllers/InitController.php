<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InitController extends CI_Controller
{

	public function index()
	{
		$data[] = [
			'username' => 'Oasis',
			'password' => password_hash('oasis', PASSWORD_BCRYPT)
		];

		$data[] = [
			'username' => 'kikukawa',
			'password' => password_hash('kikukawa', PASSWORD_BCRYPT)
		];

		$data[] = [
			'username' => 'ncb3',
			'password' => password_hash('ncb3', PASSWORD_BCRYPT)
		];

		$data[] = [
			'username' => 'ncb6',
			'password' => password_hash('ncb6', PASSWORD_BCRYPT)
		];

		$this->mcore->store_batch('admin', $data);
	}

	public function check($username, $password)
	{
		$where = ['username' => $username];
		$arr = $this->mcore->get('admin', '*', $where, NULL, 'ASC');
		if ($arr->num_rows() == 1) {
			if (password_verify($password, $arr->row()->password)) {
				echo "benar";
			} else {
				echo "salah";
			}
		} else {
			echo "username tidak ditemukan";
		}
	}
}

/* End of file InitController.php */
/* Location: ./application/controllers/InitController.php */
