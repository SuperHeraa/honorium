<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	// public function __construct()
	// {
	// 	parent::__construct();
	// 	$this->load->library('form_validation');
	// }
	public function index()
	{

		$this->_rules();

		if ($this->form_validation->run() == false) {
			$this->load->view('login');
		} else {

			//lolos validasi
			$this->_login();
		}
	}

	private function _login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$remember = $this->input->post('remember_me');
		$cek_data = $this->db->get_where('tb_pegawai', ['username' => $username])->row_array();

		if ($cek_data) {
			//user ada di databse
			//lalu cek kesamaan password
			if (password_verify($password, $cek_data['password'])) {
				//password benar

				// jika remember me dicentang
				if ($remember != null) {
					setcookie("userId", $username, time() + (10 * 355 * 24 * 60 * 60));
					setcookie("userPass", $password, time() + (10 * 355 * 24 * 60 * 60));
				} else {
					setcookie("userId", "");
					setcookie("userPass", "");
				}

				if ($cek_data['hak_akses'] == 1) {
					// jika hak akses admin
					$data = [
						'id_pegawai' => $cek_data['id_pegawai'],
						'hak_akses'	=> $cek_data['hak_akses'],
						'username'	=> $cek_data['nama_pegawai'],
						'image'	=> $cek_data['image']
					];
					$this->session->set_userdata($data);
					redirect('admin/dashboard');
				} elseif ($cek_data['hak_akses'] == 2) {
					//jika hak akses bukan admin
					$datapegawai = [
						'id_pegawai' => $cek_data['id_pegawai'],
						'hak_akses' => $cek_data['hak_akses'],
						'username'	=> $cek_data['username']
					];
					$this->session->set_userdata($datapegawai);
					redirect('pegawai/dashboard');
				} else {
					redirect('welcome');
				}
			} else {
				//password salah
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Password Anda Salah!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		  		</div>');
				redirect('welcome');
			}
		} else {
			//user tdak ada di database
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			Username tidak terdaftar!
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		  	</div>');
			redirect('welcome');
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('welcome');
	}

	public function blocked()
	{
		$this->load->view('blocked');
	}
}
