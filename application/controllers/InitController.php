<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InitController extends CI_Controller {

	public function index()
	{
		$data[] = [
			'username' => 'office',
			'password' => password_hash('office', PASSWORD_BCRYPT)
		];

		$data[] = [
			'username' => 'm1',
			'password' => password_hash('m1', PASSWORD_BCRYPT)
		];

		$data[] = [
			'username' => 'm2',
			'password' => password_hash('m2', PASSWORD_BCRYPT)
		];

		$data[] = [
			'username' => 'm3',
			'password' => password_hash('m3', PASSWORD_BCRYPT)
		];

		$this->mcore->store_batch('admin', $data);
		
	}

	public function check($username, $password)
	{
		$where = ['username' => $username];
		$arr = $this->mcore->get('admin', '*', $where, NULL, 'ASC');
		if($arr->num_rows() == 1){
			if(password_verify($password, $arr->row()->password)){
				echo "benar";
			}else{
				echo "salah";
			}
		}else{
			echo "username tidak ditemukan";
		}

	}

}

/* End of file InitController.php */
/* Location: ./application/controllers/InitController.php */