<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UploadController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$config['upload_path']      = 'public/img/';
		$config['allowed_types']    = 'gif|jpg|png|jpeg';
		$config['file_ext_tolower'] = TRUE;
		$config['overwrite']        = TRUE;
		$config['encrypt_name']     = TRUE;
		$config['remove_spaces']    = TRUE;


		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('image')) {
			$data['code'] = 500;
			$data['msg']  = $this->upload->display_errors();
		} else {
			$image_name = $this->upload->data('file_name');
			$exec = $this->mcore->store('slide_ext', ['image' => $image_name]);
			if ($exec) {
				$data['code'] = 200;
				$data['msg']  = 'Upload Berhasil';
			} else {
				$data['code'] = 500;
				$data['msg']  = 'Proses upload gagal, tidak terhubung dengan database';
			}
		}

		echo json_encode($data);
	}

	public function destroy()
	{
		$id = $this->input->post('id');
		$count = $this->mcore->count('slide_ext', ['id' => $id]);

		if ($count == 0) {
			$data['code'] = 404;
			$data['msg'] = 'Data tidak ditemukan atau telah terhapus';
		} else {
			$exec = $this->mcore->delete('slide_ext', ['id' => $id]);

			if ($exec) {
				$data['code'] = 200;
				$data['msg'] = 'Hapus Data Berhasil';
			} else {
				$data['code'] = 500;
				$data['msg'] = 'Proses hapus gagal, tidak terhubung dengan database';
			}
		}

		echo json_encode($data);
	}
}
        
/* End of file  UploadController.php */
